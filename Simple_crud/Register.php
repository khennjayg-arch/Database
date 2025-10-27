<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body { font-family: Arial; margin: 50px; }
        form { width: 300px; }
        input { width: 100%; padding: 8px; margin: 5px 0; }
        input[type=submit] { width: 105%; cursor: pointer; }
        a { text-decoration: none; }
    </style>
</head>
<body>

<h2>Register Account</h2>

<?php
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $conn->query("SELECT * FROM logs WHERE email='$email'");
    if ($check->num_rows > 0) {
        echo "<p style='color:red;'>Email already registered!</p>";
    } else {
        $conn->query("INSERT INTO logs (name, email, password) VALUES ('$name', '$email', '$password')");
        echo "<p style='color:green;'>Registration successful! <a href='login.php'>Login here</a></p>";
    }
}
?>

<form method="POST" action="">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" name="register" value="Register">
</form>

<p>Already have an account? <a href="login.php">Login here</a></p>

</body>
</html>