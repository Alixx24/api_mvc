
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8" />
    <title>فرم ثبت نام</title>
</head>
<body>
    <h2>ثبت نام کاربر جدید</h2>
    <form method="POST" action="registerPostView">
        <label for="username">نام کاربری:</label><br />
        <input type="text" id="username" name="username" required /><br /><br />

        <label for="email">ایمیل:</label><br />
        <input type="email" id="email" name="email" required /><br /><br />

        <label for="password">رمز عبور:</label><br />
        <input type="password" id="password" name="password" required /><br /><br />

        <button type="submit">ثبت نام</button>
    </form>
</body>
</html>
