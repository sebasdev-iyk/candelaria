<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../src/Config/Database.php';

use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

if ($db) {
    try {
        // Get pagination parameters
        $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
        $pageSize = isset($_GET['pageSize']) ? max(1, min(1000, (int) $_GET['pageSize'])) : 10;
        $searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
        $categoryFilter = isset($_GET['category']) ? trim($_GET['category']) : '';

        // Build query with search and category filters
        $baseQuery = "FROM candela_list";
        $params = [];
        $conditions = [];

        if (!empty($searchQuery)) {
            $conditions[] = "(conjunto LIKE :search OR categoria LIKE :search2 OR descripcion LIKE :search3)";
            $params[':search'] = '%' . $searchQuery . '%';
            $params[':search2'] = '%' . $searchQuery . '%';
            $params[':search3'] = '%' . $searchQuery . '%';
        }

        if (!empty($categoryFilter)) {
            $conditions[] = "categoria = :category";
            $params[':category'] = $categoryFilter;
        }

        if (!empty($conditions)) {
            $baseQuery .= " WHERE " . implode(" AND ", $conditions);
        }

        // Get total count
        $countQuery = "SELECT COUNT(*) as total " . $baseQuery;
        $stmt = $db->prepare($countQuery);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        $totalResult = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = (int) $totalResult['total'];

        // Calculate pagination
        $totalPages = ceil($total / $pageSize);
        $offset = ($page - 1) * $pageSize;

        // Get paginated data
        $dataQuery = "SELECT * " . $baseQuery . " ORDER BY orden_concurso ASC, conjunto ASC LIMIT :limit OFFSET :offset";
        $stmt = $db->prepare($dataQuery);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $pageSize, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $danzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return response with pagination metadata
        echo json_encode([
            'data' => $danzas,
            'pagination' => [
                'page' => $page,
                'pageSize' => $pageSize,
                'total' => $total,
                'totalPages' => $totalPages,
                'hasPrev' => $page > 1,
                'hasNext' => $page < $totalPages
            ]
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error al obtener danzas: " . $e->getMessage()]);
    }
} else {
    http_response_code(500);
    echo json_encode(["message" => "No se pudo conectar a la base de datos."]);
}
