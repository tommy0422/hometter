<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>登録画面</title>
</head>

<body>
    <div id="form">
        <p class="form-title">新規会員登録</p>
        <form action="register_read.php" method="POST">
            <p>@から始まるID</p>
            <p class="id"><input type="text" name="player" /></p>
            <p>Password</p>
            <p class="pass"><input type="text" name="pass" /></p>
            <p class="submit"><input type="submit" value="Register" /></p>
            <a href="login.php">◀︎ 戻る</a>
        </form>
    </div>
</body>

</html>