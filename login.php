<?php
session_start();
include 'includes/config_users.php';
include 'includes/header.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Correct login
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: account.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<main>
    <h1>Login at My BookStore</h1>
    <p>Login to view all of our books available here.</p>

    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <label>Email:
            <input type="email" name="email" required>
        </label><br>
        <label>Password:
            <input type="password" name="password" required>
        </label><br>
        <button type="submit">Login</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>
