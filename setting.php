<?php
session_start();
include('functions.php');
check_session_id();

//DB接続
$pdo = connect_to_db();

$user_id = $_SESSION["user_id"];
// var_dump($user_id);
// exit();

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

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/setting.css">
    <title>設定画面</title>
</head>

<body>
    <header>
        <div id="logo">
            <a href="home.php"><img src="img/logo.png" alt=""></a>
        </div>
    </header>
    <form action="update.php" method="POST">
        <fieldset>
            <legend>マイページ</legend>
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
    </form>
</body>

</html>