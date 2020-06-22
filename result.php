<?php
// var_dump($_POST);
// exit();

session_start();
include('functions.php');
check_session_id();

//データ受け取り
$result = $_POST['result'];
// var_dump($result);
// exit();

//DB接続
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM users_table WHERE user_id LIKE "%' . $result . '%"';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':result', $result, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}

$to_name = $result["user_id"];
// var_dump($to_name);
// exit();

// データ取得SQL作成
$sql = "SELECT t2.user_id AS from_name,t3.user_id AS to_name,t2.image AS from_icon,t3.image AS to_icon,text,t1.created_at AS time from post AS t1 left join users_table AS t2 on t1.from_player = t2.id left join users_table AS t3 on  t1.player = t3.id WHERE t3.user_id = :to_name ORDER BY t1.created_at DESC";
// var_dump($sql);
// exit();

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':to_name', $to_name, PDO::PARAM_STR);
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
    // var_dump($result);
    // exit();
    $output = "";
    // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
    // `.=`は後ろに文字列を追加する，の意味
    foreach ($result as $record) {
        $output .= "<div class=post_box>";
        $output .= "<h4>";
        $output .= "From {$record["from_name"]} ";
        $output .= "<img class = icon src ={$record["from_icon"]}><br>";
        $output .= "--->{$record["to_name"]} ";
        $output .= "<img class = icon src ={$record["to_icon"]}>";
        $output .= "</h4>";
        $output .= "<td><p>{$record["text"]}</p></td>";
        $output .= "<p class= time>{$record["time"]}</p>";
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
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">
    <style>
        h1 {
            text-align: center;
            font-family: "M PLUS Rounded 1c";
        }
    </style>
    <title>検索結果画面</title>
</head>

<body>
    <header>
        <div id="logo">
            <a href="home.php"><img src="img/logo.png" alt=""></a>
        </div>
    </header>
    <h1>検索結果</h1>
    <hr>
    <?= $output ?>
</body>

</html>