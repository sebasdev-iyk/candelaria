<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include_once '../src/Config/Database.php';
use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

if (!$db) {
    http_response_code(500);
    echo json_encode(["message" => "Error de conexión a BD"]);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Helper function to generate simple token
function generateToken($clientId)
{
    return base64_encode($clientId . ':' . time() . ':' . bin2hex(random_bytes(16)));
}

// Helper function to validate token
function validateToken($token, $db)
{
    if (!$token)
        return null;

    $decoded = base64_decode($token);
    $parts = explode(':', $decoded);

    if (count($parts) < 3)
        return null;

    $clientId = intval($parts[0]);

    // Verify client exists
    $stmt = $db->prepare("SELECT id, nombre, email, telefono FROM clientes WHERE id = :id");
    $stmt->bindParam(':id', $clientId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Get Authorization header
function getAuthHeader()
{
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}

if ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if ($action === 'register') {
        // Validate required fields
        if (!isset($data->nombre) || !isset($data->email) || !isset($data->telefono) || !isset($data->password)) {
            http_response_code(400);
            echo json_encode(["message" => "Datos incompletos. Se requiere: nombre, email, telefono, password"]);
            exit();
        }

        try {
            // Check if email already exists
            $checkStmt = $db->prepare("SELECT id FROM clientes WHERE email = :email");
            $checkStmt->bindParam(':email', $data->email);
            $checkStmt->execute();

            if ($checkStmt->fetch()) {
                http_response_code(409);
                echo json_encode(["message" => "Este correo electrónico ya está registrado"]);
                exit();
            }

            // Hash password
            $passwordHash = password_hash($data->password, PASSWORD_DEFAULT);

            // Insert new client
            $stmt = $db->prepare("INSERT INTO clientes (nombre, email, telefono, password_hash) VALUES (:nombre, :email, :telefono, :password_hash)");

            $nombre = htmlspecialchars(strip_tags($data->nombre));
            $email = filter_var($data->email, FILTER_SANITIZE_EMAIL);
            $telefono = htmlspecialchars(strip_tags($data->telefono));

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':password_hash', $passwordHash);

            if ($stmt->execute()) {
                $clientId = $db->lastInsertId();
                $token = generateToken($clientId);

                http_response_code(201);
                echo json_encode([
                    "message" => "Registro exitoso",
                    "token" => $token,
                    "cliente" => [
                        "id" => $clientId,
                        "nombre" => $nombre,
                        "email" => $email,
                        "telefono" => $telefono
                    ]
                ]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Error al registrar usuario"]);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Error de base de datos: " . $e->getMessage()]);
        }

    } elseif ($action === 'login') {
        // Validate required fields
        if (!isset($data->email) || !isset($data->password)) {
            http_response_code(400);
            echo json_encode(["message" => "Se requiere email y password"]);
            exit();
        }

        try {
            $stmt = $db->prepare("SELECT id, nombre, email, telefono, password_hash FROM clientes WHERE email = :email");
            $stmt->bindParam(':email', $data->email);
            $stmt->execute();

            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($cliente && password_verify($data->password, $cliente['password_hash'])) {
                $token = generateToken($cliente['id']);

                unset($cliente['password_hash']);

                echo json_encode([
                    "message" => "Login exitoso",
                    "token" => $token,
                    "cliente" => $cliente
                ]);
            } else {
                http_response_code(401);
                echo json_encode(["message" => "Credenciales incorrectas"]);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Error de base de datos: " . $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Acción no válida"]);
    }

} elseif ($method == 'GET') {
    if ($action === 'profile' || $action === 'validate') {
        $authHeader = getAuthHeader();

        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            http_response_code(401);
            echo json_encode(["message" => "Token no proporcionado", "authenticated" => false]);
            exit();
        }

        $cliente = validateToken($matches[1], $db);

        if ($cliente) {
            echo json_encode([
                "authenticated" => true,
                "cliente" => $cliente
            ]);
        } else {
            http_response_code(401);
            echo json_encode(["message" => "Token inválido", "authenticated" => false]);
        }
    } elseif ($action === 'reservaciones') {
        // Get reservations for logged-in user
        $authHeader = getAuthHeader();

        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            http_response_code(401);
            echo json_encode(["message" => "Token no proporcionado"]);
            exit();
        }

        $cliente = validateToken($matches[1], $db);

        if (!$cliente) {
            http_response_code(401);
            echo json_encode(["message" => "Token inválido"]);
            exit();
        }

        try {
            $stmt = $db->prepare("
                SELECT r.*, h.nombre as habitacion_nombre, ho.nombre as hospedaje_nombre
                FROM reservaciones r
                JOIN habitaciones h ON r.habitacion_id = h.id
                JOIN hospedajes ho ON r.hospedaje_id = ho.id
                WHERE r.cliente_id = :cliente_id
                ORDER BY r.created_at DESC
            ");
            $stmt->bindParam(':cliente_id', $cliente['id'], PDO::PARAM_INT);
            $stmt->execute();

            $reservaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($reservaciones);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Error: " . $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Acción no válida"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Método no permitido"]);
}
