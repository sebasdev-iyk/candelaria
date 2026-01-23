<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "Starting debug...<br>";

$dbPath = '../src/Config/Database.php';
echo "Checking DB Path: " . (file_exists($dbPath) ? "EXISTS" : "MISSING") . "<br>";
include_once $dbPath;

$mwPath = '../includes/supabase-middleware.php';
echo "Checking Middleware Path: " . (file_exists($mwPath) ? "EXISTS" : "MISSING") . "<br>";
include_once $mwPath;

echo "Classes loaded. Connecting DB...<br>";
use Config\Database;
$database = new Database();
$db = $database->connect('mipuno_candelaria');

if (!$db) {
    die("DB Connection failed");
}
echo "DB Connected.<br>";

// Test Auth (simulated, or just skip if we want to test DB query first)
// Let's print the token if it exists
$token = isset($_COOKIE['sb-access-token']) ? $_COOKIE['sb-access-token'] : 'NONE';
echo "Cookie Token: " . substr($token, 0, 10) . "...<br>";

echo "Done.";
?>