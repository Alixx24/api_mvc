<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>نمایش پست‌ها</title>
</head>
<body>
    <h1>پست‌ها</h1>
    <?php foreach ($posts as $post): ?>
        <div style="border:1px solid #ccc; margin-bottom:10px; padding:10px;">
            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
            <p><?php echo nl2br(htmlspecialchars($post['body'])); ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
