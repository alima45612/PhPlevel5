<?php

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
$db = 'booknest';
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



?>

<?php include 'includes/footer.php'; ?>