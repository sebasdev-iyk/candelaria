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

function validateToken($token, $db)
{
    if (!$token)
        return null;
    $decoded = base64_decode($token);
    $parts = explode(':', $decoded);
    if (count($parts) < 3)
        return null;
    $clientId = intval($parts[0]);
    $stmt = $db->prepare("SELECT id, nombre FROM clientes WHERE id = :id");
    $stmt->bindParam(':id', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    $auth = getAuthHeader();
    if (!$auth || !preg_match('/Bearer\s(\S+)/', $auth, $matches)) {
        http_response_code(401);
        echo json_encode(["message" => "No autorizado"]);
        exit();
    }

    $user = validateToken($matches[1], $db);
    if (!$user) {
        http_response_code(401);
        echo json_encode(["message" => "Token inválido"]);
        exit();
    }

    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->hospedaje_id) || !isset($data->puntuacion)) {
        http_response_code(400);
        echo json_encode(["message" => "Faltan datos (hospedaje_id, puntuacion)"]);
        exit();
    }

    $hospedaje_id = intval($data->hospedaje_id);
    $puntuacion = intval($data->puntuacion);
    $comentario = isset($data->comentario) ? trim($data->comentario) : '';

    if ($puntuacion < 1 || $puntuacion > 5) {
        http_response_code(400);
        echo json_encode(["message" => "Puntuación debe ser entre 1 y 5"]);
        exit();
    }

    // Check if already rated
    $checkQuery = "SELECT id FROM calificaciones WHERE cliente_id = :cid AND hospedaje_id = :hid";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->bindValue(':cid', $user['id']);
    $checkStmt->bindValue(':hid', $hospedaje_id);
    $checkStmt->execute();
    if ($checkStmt->fetch()) {
        http_response_code(409);
        echo json_encode(["message" => "Ya has calificado este hospedaje"]);
        exit();
    }

    try {
        // Insert rating
        $query = "INSERT INTO calificaciones (cliente_id, hospedaje_id, puntuacion, comentario) VALUES (:cid, :hid, :pts, :com)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':cid', $user['id']);
        $stmt->bindParam(':hid', $hospedaje_id);
        $stmt->bindParam(':pts', $puntuacion);
        $stmt->bindParam(':com', $comentario);
        $stmt->execute();

        // Update Average
        $avgQuery = "UPDATE hospedajes SET calificacion = (SELECT AVG(puntuacion) FROM calificaciones WHERE hospedaje_id = :hid) WHERE id = :hid";
        $avgStmt = $db->prepare($avgQuery);
        $avgStmt->bindParam(':hid', $hospedaje_id);
        $avgStmt->execute();

        echo json_encode(["message" => "Calificación guardada"]);

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error DB: " . $e->getMessage()]);
    }

} elseif ($method == 'GET') {
    $hospedaje_id = isset($_GET['hospedaje_id']) ? intval($_GET['hospedaje_id']) : 0;
    if (!$hospedaje_id) {
        http_response_code(400);
        echo json_encode(["message" => "ID hospedaje requerido"]);
        exit();
    }

    try {
        // Get reviews
        $query = "SELECT c.*, cl.nombre as cliente_nombre FROM calificaciones c 
                 JOIN clientes cl ON c.cliente_id = cl.id 
                 WHERE c.hospedaje_id = :hid 
                 ORDER BY c.created_at DESC";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':hid', $hospedaje_id);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Calculate average
        $total = count($items);
        $sum = 0;
        foreach ($items as $i)
            $sum += intval($i['puntuacion']);
        $avg = $total > 0 ? $sum / $total : 0;

        echo json_encode([
            "promedio" => $avg,
            "total_reviews" => $total,
            "reviews" => $items
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error DB: " . $e->getMessage()]);
    }
}
