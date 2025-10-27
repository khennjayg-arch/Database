<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial; margin: 50px; }
        form { width: 300px; }
        input { width: 100%; padding: 8px; margin: 5px 0; }
        input[type=submit] { width: 105%; cursor: pointer; }
        a { text-decoration: none; }
    </style>
</head>
<body>

<h2>Login</h2>

<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM logs WHERE email='$email'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['name'];
            header("Location: index.php");
            exit();
        } else {
            echo "<p style='color:red;'>Incorrect password!</p>";
        }
    } else {
        echo "<p style='color:red;'>Email not found!</p>";
    }
}
?>

<form method="POST" action="">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" name="login" value="Login">
</form>

<p>Don’t have an account? <a href="register.php">Register here</a></p>

</body>
</html>