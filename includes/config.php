<?php
session_start();
// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
$db = 'booklets';
$host = 'localhost';
$user = 'root';
$pass = 'root';
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');

} catch (Exception $e) {
    die( 'Could not connect to the database: ' . $e->getMessage());
}

/*$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
*/
?>


