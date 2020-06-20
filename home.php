<?php
session_start();
include('functions.php');
check_session_id();

//DB接続の設定
$pdo = connect_to_db();

$user_id = $_SESSION["user_id"];

//sql作成＆準備&実行
$sql = 'SELECT * FROM users_table WHERE user_id = :user_id';

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

//iconの定義
$icon = $record["image"];

// データ取得SQL作成
$sql = "SELECT t2.user_id AS from_name,t3.user_id AS to_name,text,t1.created_at AS time from post AS t1 left join users_table AS t2 on t1.from_player = t2.id left join users_table AS t3 on  t1.player = t3.id";
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
// var_dump($status);
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
        // var_dump($record);
        // exit();
        $output .= "<div class=post_box>";
        $output .= "<h4>From {$record["from_name"]} <br> ---> {$record["to_name"]}</h4>";
        $output .= "<td>{$record["text"]}</td>";
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/home.css">
    <title>ホーム画面</title>
</head>

<body>
    <header>
        <div id="header">
            <div id="setting">
                <a href="setting.php"><?= $icon ?></a>
            </div>
            <div id="logo">
                <img src="img/logo.png" alt="">
            </div>
            <div id="logout">
                <a href="logout.php"><img src="img/logout.png" alt=""></a>
            </div>
        </div>
    </header>
    <form action="result.php" method="POST">
        <div class="searchForm">
            <input class="searchForm-input" type="text" name="result">
            <button class="searchForm-submit" type="submit"></button>
        </div>
    </form>
    <?= $output ?>
    <div class="post">
        <a href="post.php">
            <img src="img/post.png" alt="">
        </a>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        swal("<?= $_SESSION['user_id'] ?>さん、こんにちは！");
    </script>
</body>

</html>