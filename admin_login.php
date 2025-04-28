<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_user = 'admin';
    $admin_pass = 'admin123'; 

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_management.php");
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<form method="POST">
    <h2>Admin Login</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Login</button>
</form>

<?php include 'includes/footer.php'; ?>
