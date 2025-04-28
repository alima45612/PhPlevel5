<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<?php

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Book ID is required.");
}

try {
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: admin_view_book.php");
    exit;
} catch (PDOException $e) {
    die("Error deleting book: " . $e->getMessage());
}

