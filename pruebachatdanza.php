<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Diagnóstico de Chatbot - Danzas</h1>";

require_once __DIR__ . '/chatbot/config/config.php';
require_once __DIR__ . '/chatbot/api/DatabaseService.php';

// Bypass private methods for testing
class TestDatabaseService extends DatabaseService
{
    public function publicSearchDances($term)
    {
        // Use reflection to access private method if needed, or just copy the logic for testing
        // Since we are inside a child class, we can access protected methods, but searchDances is private.
        // So we have to use reflection.

        $reflection = new ReflectionClass('DatabaseService');
        $method = $reflection->getMethod('searchDances');
        $method->setAccessible(true);
        return $method->invoke($this, $term);
    }

    public function testKeywords($msg)
    {
        $reflection = new ReflectionClass('DatabaseService');
        $method = $reflection->getMethod('containsKeywords');
        $method->setAccessible(true);
        $isDanza = $method->invoke($this, mb_strtolower($msg, 'UTF-8'), ['danza', 'baile', 'conjunto', 'traje']);
        return $isDanza;
    }

    public function getTableCount($table)
    {
        try {
            // Need access to pdo, which is private. Use reflection property.
            $reflection = new ReflectionClass('DatabaseService');
            $prop = $reflection->getProperty('pdo');
            $prop->setAccessible(true);
            $pdo = $prop->getValue($this);

            $stmt = $pdo->query("SELECT COUNT(*) FROM $table");
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function rawSearch($term)
    {
        try {
            $reflection = new ReflectionClass('DatabaseService');
            $prop = $reflection->getProperty('pdo');
            $prop->setAccessible(true);
            $pdo = $prop->getValue($this);

            $sql = "SELECT id, conjunto, categoria, descripcion FROM candela_list WHERE LOWER(conjunto) LIKE ? OR LOWER(descripcion) LIKE ? LIMIT 5";
            $stmt = $pdo->prepare($sql);
            $term = "%" . strtolower($term) . "%";
            $stmt->execute([$term, $term]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}

try {
    $service = new TestDatabaseService();

    // 1. Check Table
    echo "<h2>1. Estado de la Tabla 'candela_list'</h2>";
    echo "Total registros: " . $service->getTableCount('candela_list') . "<br>";

    // 2. Test specific queries
    $queries = [
        "que morenadas hay",
        "aque hora pasa diablada bellavista",
        "diablada",
        "morenada"
    ];

    echo "<h2>2. Prueba de Detección de Intención</h2>";
    echo "<table border='1' cellpadding='5'><tr><th>Frase</th><th>¿Detectado como Danza?</th></tr>";
    foreach ($queries as $q) {
        $detected = $service->testKeywords($q) ? '<span style="color:green">SÍ</span>' : '<span style="color:red">NO</span>';
        echo "<tr><td>'$q'</td><td>$detected</td></tr>";
    }
    echo "</table>";

    echo "<h2>3. Prueba de Búsqueda Raw (SQL Directo)</h2>";
    $searchTerms = ["morenada", "bellavista", "diablada"];
    foreach ($searchTerms as $term) {
        echo "<h3>Buscando '$term':</h3>";
        $results = $service->rawSearch($term);
        if (empty($results)) {
            echo "Sin resultados.";
        } else {
            echo "<pre>" . print_r($results, true) . "</pre>";
        }
    }

    echo "<h2>4. Prueba de Método searchDances (del Service)</h2>";
    // Nota: searchDances usa el mensaje completo como término de búsqueda si no lo limpiamos.
    // El código actual pasa $messageLower a searchDances.
    foreach ($queries as $q) {
        echo "<h3>Input: '$q'</h3>";
        $res = $service->publicSearchDances($q);
        echo "<pre>" . print_r($res, true) . "</pre>";
    }

} catch (Exception $e) {
    echo "Error Fatal: " . $e->getMessage();
}
