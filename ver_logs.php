<?php
// ver_logs.php - View Debug Logs safely
// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Locate log file (Sibling of 'candelaria' directory)
$logFile = __DIR__ . '/../logs/app_debug.log';

// Handle Clear Action
if (isset($_POST['clear'])) {
    file_put_contents($logFile, "--- Log Cleared at " . date('Y-m-d H:i:s') . " ---\n");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Read Log
$content = "Log file not found at: $logFile";
if (file_exists($logFile)) {
    $content = file_get_contents($logFile);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Logs - Candelaria</title>
    <style>
        body {
            font-family: monospace;
            background: #1a1a1a;
            color: #00ff00;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
        }

        h1 {
            margin: 0;
            font-size: 1.2rem;
            color: #fff;
        }

        .btn {
            background: #d32f2f;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 4px;
            font-family: sans-serif;
            font-weight: bold;
        }

        .btn:hover {
            background: #b71c1c;
        }

        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
            background: #111;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #333;
            max-height: 80vh;
            overflow-y: auto;
        }

        .refresh {
            background: #1976d2;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>System Logs (
            <?= basename($logFile) ?>)
        </h1>
        <div>
            <button onclick="location.reload()" class="btn refresh">Actualizar</button>
            <form method="POST" style="display:inline;">
                <button type="submit" name="clear" class="btn">Limpiar Logs</button>
            </form>
        </div>
    </div>

    <pre id="log-content"><?= htmlspecialchars($content) ?></pre>

    <script>
        // Auto-scroll to bottom
        const pre = document.getElementById('log-content');
        pre.scrollTop = pre.scrollHeight;
    </script>
</body>

</html>