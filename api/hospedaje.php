<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../src/Config/Database.php';
use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

if ($db) {

    try {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'POST' || $method === 'PUT') {
            // Get data
            $input = file_get_contents("php://input");
            $data = json_decode($input);

            // Fallback to $_POST if request is FormData (json_decode returns null)
            if (!$data && !empty($_POST)) {
                // Convert array to object
                $data = (object) $_POST;
            }

            // Allow update via POST if id is provided
            if (isset($data->id)) {
                $query = "UPDATE hospedajes SET 
                            checkin_time = :checkin_time,
                            checkout_time = :checkout_time,
                            telefono = :telefono,
                            pagina_web = :pagina_web,
                            nombre = :nombre,
                            ubicacion = :ubicacion,
                            descripcion = :descripcion,
                            tipo = :tipo,
                            precio_noche = :precio_noche,
                            capacidad = :capacidad,
                            servicios = :servicios,
                            imagenes = :imagenes
                          WHERE id = :id";

                $stmt = $db->prepare($query);

                // Bind params
                $stmt->bindParam(':id', $data->id);
                $stmt->bindParam(':checkin_time', $data->checkin_time);
                $stmt->bindParam(':checkout_time', $data->checkout_time);
                $stmt->bindParam(':telefono', $data->telefono);
                $stmt->bindParam(':pagina_web', $data->pagina_web);
                $stmt->bindParam(':nombre', $data->nombre);
                $stmt->bindParam(':ubicacion', $data->ubicacion);
                $stmt->bindParam(':descripcion', $data->descripcion);
                $stmt->bindParam(':tipo', $data->tipo);
                $stmt->bindParam(':precio_noche', $data->precio_noche);
                $stmt->bindParam(':capacidad', $data->capacidad);

                // Handle JSON fields
                $servicios = is_array($data->servicios) ? json_encode($data->servicios) : $data->servicios;
                $imagenes = is_array($data->imagenes) ? json_encode($data->imagenes) : $data->imagenes;

                $stmt->bindParam(':servicios', $servicios);
                $stmt->bindParam(':imagenes', $imagenes);

                if ($stmt->execute()) {
                    echo json_encode(["message" => "Hospedaje actualizado correctamente"]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Error al actualizar"]);
                }
            } else {
                http_response_code(400);
                echo json_encode(["message" => "Falta ID para actualizar"]);
            }

        } else {
            // GET Request Handling
            $id = isset($_GET['id']) ? intval($_GET['id']) : null;

            if ($id) {
                // Fetch single hospedaje by ID
                $query = "SELECT h.*, (SELECT COUNT(*) FROM calificaciones c WHERE c.hospedaje_id = h.id) as total_reviews 
                         FROM hospedajes h WHERE h.id = :id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $item = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($item) {
                    // Decode JSON fields
                    if (isset($item['servicios']) && is_string($item['servicios'])) {
                        $decoded = json_decode($item['servicios']);
                        $item['servicios'] = $decoded !== null ? $decoded : [];
                    }
                    if (isset($item['imagenes']) && is_string($item['imagenes'])) {
                        $decoded = json_decode($item['imagenes']);
                        // Handle double encoded JSON
                        if (is_string($decoded)) {
                            $decoded = json_decode($decoded);
                        }
                        $item['imagenes'] = (is_array($decoded) || is_object($decoded)) ? $decoded : [];
                    }
                    echo json_encode($item);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Hospedaje no encontrado"]);
                }
            } else {
                // Fetch all hospedajes
                $query = "SELECT h.*, (SELECT COUNT(*) FROM calificaciones c WHERE c.hospedaje_id = h.id) as total_reviews 
                         FROM hospedajes h ORDER BY h.nombre ASC";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Decode JSON fields for each item
                foreach ($items as &$item) {
                    if (isset($item['servicios']) && is_string($item['servicios'])) {
                        $decoded = json_decode($item['servicios']);
                        $item['servicios'] = $decoded !== null ? $decoded : [];
                    }
                    if (isset($item['imagenes']) && is_string($item['imagenes'])) {
                        $decoded = json_decode($item['imagenes']);
                        // Handle double encoded JSON
                        if (is_string($decoded)) {
                            $decoded = json_decode($decoded);
                        }
                        $item['imagenes'] = (is_array($decoded) || is_object($decoded)) ? $decoded : [];
                    }
                }

                echo json_encode($items);
            }
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error: " . $e->getMessage()]);
    }
} else {
    http_response_code(500);
    echo json_encode(["message" => "Error de conexión a BD"]);
}
