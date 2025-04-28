<?php include 'includes/config_users.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email, created_at FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<main>
    <h1>Welcome, <?= htmlspecialchars($user['username']) ?>!</h1>
    <p>Email: <?= htmlspecialchars($user['email']) ?></p>
    <p>Member since: <?= $user['created_at'] ?></p>
    <p><a href="logout.php">Logout</a></p>
</main>

<?php include 'includes/footer.php'; ?>
