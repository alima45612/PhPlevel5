<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
// Database connection
$host = 'localhost';
$dbname = 'book_catalogue';
$username = 'root';
$password = 'root';
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Set up query for filtering or searching books
$whereClauses = [];
$params = [];

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    $whereClauses[] = "(title LIKE :search OR author LIKE :search OR genre LIKE :search)";
    $params[':search'] = $search;
}

if (isset($_GET['genre']) && !empty($_GET['genre'])) {
    $genre = $_GET['genre'];
    $whereClauses[] = "genre = :genre";
    $params[':genre'] = $genre;
}

$query = "SELECT * FROM books";

if (count($whereClauses) > 0) {
    $query .= " WHERE " . implode(' AND ', $whereClauses);
}

$stmt = $conn->prepare($query);
$stmt->execute($params);

$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['review']) && isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];
    $user_name = htmlspecialchars($_POST['user_name']);
    $review = htmlspecialchars($_POST['review']);
    $rating = (int)$_POST['rating'];

    if ($rating >= 1 && $rating <= 5) {
        // Insert the review into the database
        $insertReviewQuery = "INSERT INTO reviews (book_id, user_name, review, rating) VALUES (:book_id, :user_name, :review, :rating)";
        $stmt = $conn->prepare($insertReviewQuery);
        $stmt->execute([
            ':book_id' => $book_id,
            ':user_name' => $user_name,
            ':review' => $review,
            ':rating' => $rating
        ]);
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Books</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Book Catalogue</h1>
        <form method="GET" action="browse.php">
            <input type="text" name="search" placeholder="Search books..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <select name="genre">
                <option value="">Select Genre</option>
                <option value="Fiction" <?= isset($_GET['genre']) && $_GET['genre'] == 'Fiction' ? 'selected' : '' ?>>Fiction</option>
                <option value="Non-fiction" <?= isset($_GET['genre']) && $_GET['genre'] == 'Non-fiction' ? 'selected' : '' ?>>Non-fiction</option>
                <option value="Science" <?= isset($_GET['genre']) && $_GET['genre'] == 'Science' ? 'selected' : '' ?>>Science</option>
                <option value="Dystopian" <?= isset($_GET['genre']) && $_GET['genre'] == 'Dystopian' ? 'selected' : '' ?>>Dystopian</option>
                <option value="Fantasy" <?= isset($_GET['genre']) && $_GET['genre'] == 'Fantasy' ? 'selected' : '' ?>>Fantasy</option>
                <option value="Thriller" <?= isset($_GET['genre']) && $_GET['genre'] == 'Thriller' ? 'selected' : '' ?>>Thriller</option>
            </select>
            <button type="submit">Search</button>
        </form>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Published Year</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($books) > 0): ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?= htmlspecialchars($book['title']) ?></td>
                            <td><?= htmlspecialchars($book['author']) ?></td>
                            <td><?= htmlspecialchars($book['genre']) ?></td>
                            <td><?= htmlspecialchars($book['published_year']) ?></td>
                            <td><?= htmlspecialchars($book['description']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No books found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>





<?php include 'includes/footer.php'; ?>