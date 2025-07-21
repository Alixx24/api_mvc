<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // اگر کاربر لاگین نکرده بود، می‌فرستیمش صفحه لاگین
    header('Location: login-form');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8" />
    <title>صفحه محدود به کاربران لاگین شده</title>
</head>
<body>
    <h1>خوش آمدید، <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <p>این صفحه فقط برای کاربران لاگین شده قابل مشاهده است.</p>
</body>
</html>
