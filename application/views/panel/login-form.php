<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8" />
    <title>فرم ورود</title>
</head>
<body>
    <h2>ورود به سیستم</h2>
    <form method="POST" action="loginPost">
        <label for="username">نام کاربری:</label><br />
        <input type="text" id="username" name="username" required /><br /><br />

        <label for="password">رمز عبور:</label><br />
        <input type="password" id="password" name="password" required /><br /><br />

        <button type="submit">ورود</button>
    </form>
</body>
</html>
