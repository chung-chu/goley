<?php
require 'db.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        $error = 'Username đã tồn tại';
    } else {
        $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $stmt->execute([$username, md5($password)]);
        header('Location: index.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
</head>
<body>
<h2>Đăng ký</h2>
<form method="POST">
    Username: <input name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Đăng ký</button>
</form>
<p><?php echo $error; ?></p>
</body>
</html>
