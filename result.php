<?php
// var_dump($_POST);
// exit();

// 関数ファイル読み込み
include('functions.php');

//データ受け取り
$result = $_POST['result'];
// var_dump($result);
// exit();

//DB接続
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM post WHERE player LIKE "%' . $result . '%"';
// var_dump($sql);
// exit();

// SQL準備&実行
$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':result', $result, PDO::PARAM_INT);
$status = $stmt->execute();
// var_dump($stmt);
// exit();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    // fetchAll()関数でSQLで取得したレコードを配列で取得できる
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
    $output = "";
    // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
    // `.=`は後ろに文字列を追加する，の意味
    foreach ($result as $record) {
        $output .= "<div class>";
        $output .= "<h4>{$record["player"]}</h4>";
        $output .= "<td>{$record["text"]}</td>";
        $output .= "</div>";
        $output .= "<hr>";
    }

    // var_dump($record);
    // exit();

    // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
    // 今回は以降foreachしないので影響なし
    unset($record);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <style>
        h1 {
            text-align: center;
        }
    </style>
    <title>検索結果画面</title>
</head>

<body>
    <header>
        <a href="home.php"><img src="img/logo.png" alt=""></a>
    </header>
    <h1>検索結果</h1>
    <hr>
    <?= $output ?>
</body>

</html>