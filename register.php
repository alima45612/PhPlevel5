<?php include 'includes/config_users.php'; ?>
<?php include 'includes/header.php'; ?>


<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //require 'config.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$username, $email, $password])) {
            echo "<p>Registration successful!</p>";
        } else {
            echo "<p>Error inserting data.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BookNest</title>

</head>
<body>
<main>
    <header>
        <h1>Register to BookNest</h1>
        <p>A small independent bookstore that is expanding its operations to include online sales </p>
    </header>

    <h2>Create an Account</h2>

    
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button>
    </form>

    
    <p>Already have an account? <a href="login.php">Login here</a></p>
    <p>Admin login <a href="admin_login.php"> Login here</a></p>
</main>



</body>
</html>

<?php include 'includes/footer.php'; ?>