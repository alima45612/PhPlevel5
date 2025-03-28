<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>


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
</main>



</body>
</html>

<?php include 'includes/footer.php'; ?>