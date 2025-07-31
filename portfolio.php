<?php
require 'db.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$id]);
$user = $stmt->fetch();

$stmt2 = $pdo->prepare('SELECT * FROM portfolios WHERE user_id = ?');
$stmt2->execute([$id]);
$portfolio = $stmt2->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Portfolio của <?php echo htmlspecialchars($user['username']); ?></title>
</head>
<body>
<h2>Portfolio của <?php echo htmlspecialchars($user['username']); ?></h2>
<?php if ($portfolio): ?>
    <p>Tên: <?php echo htmlspecialchars($portfolio['fullname']); ?></p>
    <p>Giới thiệu: <?php echo htmlspecialchars($portfolio['bio']); ?></p>
    <p>Kỹ năng: <?php echo htmlspecialchars($portfolio['skills']); ?></p>
    <p>Dự án: <?php echo htmlspecialchars($portfolio['projects']); ?></p>
<?php else: ?>
    <p>Chưa tạo portfolio</p>
<?php endif; ?>
</body>
</html>
