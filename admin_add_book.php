
<?php include 'includes/header.php'; ?>

<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
include 'includes/config.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    try {
        $sql = "INSERT INTO books (title, author, genre, price, description) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $author, $genre, $price, $description]);
        $success = "Book added successfully!";
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}
?>

<h2>Add New Book</h2>

<?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST">
    <label>Title: <input type="text" name="title" required></label><br>
    <label>Author: <input type="text" name="author" required></label><br>
    <label>Genre: <input type="text" name="genre"></label><br>
    <label>Price: <input type="number" step="0.01" name="price" required></label><br>
    <label>Description: <textarea name="description"></textarea></label><br>
    <button type="submit">Add Book</button>
</form>

<p><a href="admin_management.php">Back to Admin Dashboard</a></p>
<p><a href="logout.php">Logout</a></p>

<?php include 'includes/footer.php'; ?>
