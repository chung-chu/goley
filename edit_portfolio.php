<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare('SELECT * FROM portfolios WHERE user_id = ?');
$stmt->execute([$user_id]);
$portfolio = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $skills = $_POST['skills'] ?? '';
    $projects = $_POST['projects'] ?? '';
    if ($portfolio) {
        $stmt = $pdo->prepare('UPDATE portfolios SET fullname=?, bio=?, skills=?, projects=? WHERE user_id=?');
        $stmt->execute([$fullname, $bio, $skills, $projects, $user_id]);
    } else {
        $stmt = $pdo->prepare('INSERT INTO portfolios (user_id, fullname, bio, skills, projects) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$user_id, $fullname, $bio, $skills, $projects]);
    }
    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa portfolio</title>
</head>
<body>
<h2>Sửa Portfolio</h2>
<form method="POST">
    Họ tên: <input name="fullname" value="<?php echo htmlspecialchars($portfolio['fullname'] ?? ''); ?>"><br>
    Giới thiệu: <textarea name="bio"><?php echo htmlspecialchars($portfolio['bio'] ?? ''); ?></textarea><br>
    Kỹ năng: <input name="skills" value="<?php echo htmlspecialchars($portfolio['skills'] ?? ''); ?>"><br>
    Dự án: <input name="projects" value="<?php echo htmlspecialchars($portfolio['projects'] ?? ''); ?>"><br>
    <button type="submit">Lưu</button>
</form>
</body>
</html>
