<?php
// var_dump($_POST);
// exit();

// 関数ファイル読み込み
include('functions.php');

//データ受け取り
$player = $_POST['player'];
var_dump($player);
exit();

//DB接続
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT*FROM post WHERE player LIKE $player%';
// var_dump($sql);
// exit();

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
// var_dump($stmt);
// exit();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    // exit();
} else {
    // 正常にSQLが実行された場合は指定の11レコードを取得
    // fetch()関数でSQLで取得したレコードを取得できる
    $record = $stmt->fetchALL(PDO::FETCH_ASSOC);
}
var_dump($record);
exit();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>検索結果画面</title>
</head>

<body>
    <header>
        <img src="img/logo.png" alt="">
    </header>
    <form action="read.php" method="POST">
        <div class="searchForm">
            <input class="searchForm-input" type="text" name="player">
            <button class="searchForm-submit" type="submit"></button>
        </div>
    </form>

</body>

</html>