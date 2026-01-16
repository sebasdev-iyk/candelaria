<?php
// Logger for Candelaria Client Side
// Save in: candelaria/includes/logger.php

if (!function_exists('custom_log')) {
    function custom_log($message)
    {
        // Try to log to a shared logs folder at ../../logs (sibling to candelaria folder)
        // If that fails, log to ./logs inside candelaria

        $logDirShared = __DIR__ . '/../../logs'; // httpdocs/logs assuming candelaria is in httpdocs/candelaria
        $logDirLocal = __DIR__ . '/../logs';     // candelaria/logs

        // Determine best directory
        $targetDir = $logDirShared;
        if (!is_dir($targetDir)) {
            // Try creating shared
            if (!@mkdir($targetDir, 0777, true)) {
                // Fallback to local
                $targetDir = $logDirLocal;
                if (!is_dir($targetDir)) {
                    @mkdir($targetDir, 0777, true);
                }
            }
        }

        $logFile = $targetDir . '/app_debug.log';

        $date = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
        $uri = $_SERVER['REQUEST_URI'] ?? 'UNKNOWN';

        $entry = "[$date] [CLIENT] [$ip] $uri - $message" . PHP_EOL;

        @file_put_contents($logFile, $entry, FILE_APPEND);
    }
}
?>