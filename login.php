<?php
session_start();

$valid_username = "admin";
$valid_password = "admin1234";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="icon" href="img\BLogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
<div class="loginPage">
    <div class="box">
        <div class="boxLogo">
            <img src="img/BLogo.jpg">
        </div>
        <?php if ($error): ?>
            <div style="color: red; text-align: center; margin-bottom: 10px;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">

            <input type="text" id="username" name="username" placeholder="Username" required autofocus>

            <input type="password" id="password" name="password" placeholder="Password" required>
            
            <input type="submit" value="Login">
        </form>
    </div>
</div>
</body>
</html>
