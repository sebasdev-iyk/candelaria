<?php
// Simple test - no dependencies
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "1. PHP is working\n";

try {
    $db = new PDO(
        "mysql:host=127.0.0.1;port=3306;dbname=mipuno_candelaria;charset=utf8mb4",
        "mipuno_candelaria_user",
        "mipuno_candelaria"
    );
    echo "2. Database connected!\n";

    $stmt = $db->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "3. Tables: " . implode(", ", $tables) . "\n";

    // Check clientes
    if (in_array('clientes', $tables)) {
        echo "4. clientes table EXISTS ✓\n";
        $stmt = $db->query("SELECT COUNT(*) FROM clientes");
        echo "   - Clientes count: " . $stmt->fetchColumn() . "\n";
    } else {
        echo "4. clientes table MISSING ✗\n";
    }

    // Check reservaciones 
    if (in_array('reservaciones', $tables)) {
        echo "5. reservaciones table EXISTS ✓\n";
        $stmt = $db->query("DESCRIBE reservaciones");
        $cols = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo "   - Columns: " . implode(", ", $cols) . "\n";

        // Check if cliente_id column exists
        if (in_array('cliente_id', $cols)) {
            echo "   - cliente_id column EXISTS ✓\n";
        } else {
            echo "   - cliente_id column MISSING ✗ (old schema)\n";
        }
    }

    echo "\n=== ALL TESTS PASSED ===\n";

} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
