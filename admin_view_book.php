<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<?php

// Fetch all books
try {
    $stmt = $pdo->query("SELECT * FROM books ORDER BY id ASC");
    $books = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching books: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Books</title>
</head>
<body>

    <h1>All Books</h1>

    <p><a href="admin_management.php">Back to Admin Dashboard</a></p>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Published Year</th>
            <th>Price</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>

        <?php if ($books): ?>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book['id']) ?></td>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                    <td><?= htmlspecialchars($book['genre']) ?></td>
                    <td><?= htmlspecialchars($book['published_year']) ?></td>
                    <td><?= htmlspecialchars($book['price']) ?></td>
                    <td><?= htmlspecialchars($book['description']) ?></td>
                    <td>
                        <a href="edit_book.php?id=<?= $book['id'] ?>">Edit</a> |
                        <a href="delete_book.php?id=<?= $book['id'] ?>" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="8">No books found.</td></tr>
        <?php endif; ?>
    </table>

</body>
</html>

<?php include 'includes/footer.php'; ?>