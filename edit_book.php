<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<?php


// Get book ID
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Book ID is required.");
}

// Fetch book details
try {
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->execute([$id]);
    $book = $stmt->fetch();

    if (!$book) {
        die("Book not found.");
    }
} catch (PDOException $e) {
    die("Error fetching book: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $published_year = $_POST['published_year'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    try {
        $sql = "UPDATE books SET title = ?, author = ?, genre = ?, published_year = ?, price = ?, description = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $author, $genre, $published_year, $price, $description, $id]);

        echo "Book updated successfully. <a href='admin_view_book.php'>Go back</a>";
        exit;
    } catch (PDOException $e) {
        die("Error updating book: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
</head>
<body>

<h1>Edit Book</h1>

<form method="POST">
    <p>Title: <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required></p>
    <p>Author: <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required></p>
    <p>Genre: <input type="text" name="genre" value="<?= htmlspecialchars($book['genre']) ?>" required></p>
    <p>Published Year: <input type="number" name="published_year" value="<?= htmlspecialchars($book['published_year']) ?>" required></p>
    <p>Price: <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($book['price']) ?>" required></p>
    <p>Description:<br><textarea name="description" rows="5" cols="50" required><?= htmlspecialchars($book['description']) ?></textarea></p>
    <button type="submit">Update Book</button>
</form>

<p><a href="admin_view_book.php">Cancel</a></p>

</body>
</html>

<?php include 'includes/footer.php'; ?>
