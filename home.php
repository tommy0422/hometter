<?php
session_start();
include('functions.php');
check_session_id();

//DB接続の設定
$pdo = connect_to_db();

//ユーザーIDの定義
$user_id = $_SESSION["user_id"];
// var_dump($user_id);
// exit();

//データの取得
$sql = 'SELECT * FROM users_table WHERE user_id = :user_id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は指定の11レコードを取得
    // fetch()関数でSQLで取得したレコードを取得できる
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($record);
    // exit();
}

//ユーザーIDの再定義
$user_id = $record['user_id'];
// var_dump($user_id);
// exit();

// データ取得SQL作成
$sql = 'SELECT * FROM post';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

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
        $output .= "<div class=post_box>";
        $output .= "<h4>From {$user_id} <br> ---> {$record["player"]}</h4>";
        $output .= "<td>{$record["text"]}</td>";
        $output .= "</div>";
        $output .= "<hr>";
    }

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
                <a href="setting.php"><img src="img/setting.png" alt=""></a>
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