<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once '../src/Config/Database.php';
use Config\Database;
$db = (new Database())->connect('mipuno_candelaria');

// Check ID 14 as referenced by user
$id = 14;
$stmt = $db->query("SELECT imagenes FROM hospedajes WHERE id=$id");
$res = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<h3>ID $id Raw Images JSON:</h3>";
file_put_contents('debug_out.txt', print_r($res['imagenes'], true));
echo "Done";
?>