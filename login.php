<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <title>ログイン画面</title>
    <link rel="stylesheet" type="text/css" href="css/login.css" media="all" />
</head>

<body>
    <div class="logo"><img src="img/logo.png" alt=""></div>
    <h1>Welcome to hometter</h1>
    <div id="form">
        <p class="form-title">ログイン</p>
        <form action="login_read.php" method="POST">
            <p>@から始まるID</p>
            <p class="id"><input type="text" name="player" /></p>
            <p>Password</p>
            <p class="pass"><input type="password" name="pass" /></p>
            <p class="check"><input type="checkbox" name="checkbox" />パスワードを保存</p>
            <p class="submit"><input type="submit" value="Login" /></p>
            <a href="register.php">新規登録の方はこちら</a>
        </form>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>