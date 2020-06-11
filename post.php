<?php
session_start();
include("functions.php");
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/post.css">
    <title>投稿画面</title>
</head>

<body>
    <header>
        <a href="home.php"><img src="img/logo.png" alt=""></a>
    </header>
    <form action="create.php" method="POST">
        <div class="box">
            <table>
                <div id="name">
                    <tr>
                        <td valign="top"> @褒めたい人</td>
                        <td><input type="text" name="player"></td>
                    </tr>
                </div>
                <div id="great">
                    <tr>
                        <td valign="top">褒め言葉</td>
                        <td><textarea name="text" id="" cols="30" rows="10"></textarea></td>
                    </tr>
                </div>
            </table>
            <div class="button">
                <button>褒める</button>
            </div>
        </div>
</body>

</html>