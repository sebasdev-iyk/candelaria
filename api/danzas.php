<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../src/Config/Database.php';

use Config\Database;

$time_start = microtime(true);
$database = new Database();
$db = $database->connect('mipuno_candelaria');

if ($db) {
    // Profiling Start
    $time_connected = microtime(true);

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

        // Timer: Before Count
        $time_before_count = microtime(true);

        // Get total count
        $countQuery = "SELECT COUNT(*) as total " . $baseQuery;
        $stmt = $db->prepare($countQuery);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        $totalResult = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = (int) $totalResult['total'];

        // Timer: After Count
        $time_after_count = microtime(true);

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

        // Timer: After Data
        $time_after_data = microtime(true);

        // Calculate Metrics
        $metric_db_connect = ($time_connected - $time_start) * 1000; // ms
        $metric_sql_count = ($time_after_count - $time_before_count) * 1000; // ms
        $metric_sql_data = ($time_after_data - $time_after_count) * 1000; // ms
        $metric_php_total = ($time_after_data - $time_start) * 1000; // ms

        // Diagnosis Logic
        $diagnosis = [];

        // Caso A: DB Connection High
        if ($metric_db_connect > 100) {
            $diagnosis[] = [
                "case" => "Caso A",
                "symptom" => "DB Conexión es alto (>100ms)",
                "guilty" => "CONFIRMADO: Latencia de Red entre Web y DB.",
                "solution" => "Usar conexión persistente o mover DB a local."
            ];
        }

        // Caso B: SQL Slow
        if ($metric_sql_count > 200 || $metric_sql_data > 200) {
            $diagnosis[] = [
                "case" => "Caso B",
                "symptom" => "SQL Count o Data altos (>200ms)",
                "guilty" => "CONFIRMADO: Base de Datos Lenta (Full Table Scan).",
                "solution" => "El LIKE %...% en campos TEXT está matando el CPU de la DB."
            ];
        }

        // Caso D: Boot High (Inferred if total is high but parts are low)
        $php_overhead = $metric_php_total - ($metric_db_connect + $metric_sql_count + $metric_sql_data);
        if ($php_overhead > 100) {
            $diagnosis[] = [
                "case" => "Caso D",
                "symptom" => "php_boot_ms es alto",
                "guilty" => "Servidor Web Sobrecargado.",
                "solution" => "Plesk/Apache está tardando en arrancar."
            ];
        }

        // Return response with pagination metadata and debug info
        echo json_encode([
            'data' => $danzas,
            'pagination' => [
                'page' => $page,
                'pageSize' => $pageSize,
                'total' => $total,
                'totalPages' => $totalPages,
                'hasPrev' => $page > 1,
                'hasNext' => $page < $totalPages
            ],
            'debug' => [
                'metrics' => [
                    'db_connect_ms' => round($metric_db_connect, 2),
                    'sql_count_ms' => round($metric_sql_count, 2),
                    'sql_data_ms' => round($metric_sql_data, 2),
                    'php_processing_ms' => round($php_overhead, 2),
                    'php_total_ms' => round($metric_php_total, 2)
                ],
                'diagnosis' => $diagnosis
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
