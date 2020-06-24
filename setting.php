<?php
session_start();
include('functions.php');
check_session_id();

//DB接続
$pdo = connect_to_db();

$user_id = $_SESSION["user_id"];

// データ取得SQL作成
$sql = 'SELECT * FROM users_table WHERE user_id = :user_id';

//sql実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($record);
    // exit();
}
if ($record["image"] != NULL) {
    $user_icon = $record["image"];
} else {
    $user_icon = "img/no_image.png";
}

//ここから承認欲求ポイント
$sql = "SELECT COUNT(player) FROM post LEFT OUTER JOIN  users_table ON post.player = users_table.id WHERE user_id = :user_id";

//sql実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $record2 = $stmt->fetch(PDO::FETCH_ASSOC);
    //     var_dump($record);
    //     exit();
}

$point = $record2;
// var_dump($point);
// exit();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Walter+Turncoat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    <link rel="stylesheet" href="css/setting.css">
    <title>設定画面</title>
</head>

<body>
    <header>
        <div id="logo">
            <a href="home.php"><img src="img/logo.png" alt=""></a>
        </div>
    </header>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Icon</legend>
            <figure class="icon_box">
                <img id="preview" src="<?= $user_icon ?>">
                <input class="icon" type="file" name="upfile" accept='image/*' capture="camera" onchange="previewImage(this);">
                <div id="button_box">
                    <button>更新</button>
                </div>
            </figure>
        </fieldset>
    </form>
    <form action="update.php" method="POST">
        <fieldset>
            <legend>My Information</legend>
            <div>
                新しい@名前: <input type="text" name="user_id" value="<?= $record["user_id"] ?>">
            </div>
            <div>
                新しいパスワード: <input type="text" name="pass" value="<?= $record["password"] ?>">
            </div>
            <div class="button">
                <button>変更</button>
            </div>
            <p>※変更するとログイン画面に戻ります.</p>
            <input type="hidden" name="id" value="<?= $record["id"] ?>">
        </fieldset>
        <fieldset class="point">
            <legend>Desire for approval</legend>
            <p id="point"><?= $point["COUNT(player)"] ?> point</p>
        </fieldset>
    </form>

    <script>
        function previewImage(obj) {
            var fileReader = new FileReader();
            fileReader.onload = (function() {
                document.getElementById('preview').src = fileReader.result;
            });
            fileReader.readAsDataURL(obj.files[0]);
        }
    </script>
</body>

</html>