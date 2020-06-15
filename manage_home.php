<?php
session_start();
include('functions.php');
check_session_id();

//DB接続の設定
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM users_table WHERE is_admin = 0';

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
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
    $output = "";
    // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
    // `.=`は後ろに文字列を追加する，の意味
    foreach ($list as $record) {
        $output .= "<tr>";
        $output .= "<td>{$record['id']}</td>";
        $output .= "<td>{$record['user_id']}</td>";
        $output .= "<td>{$record['created_at']}</td>";
        $output .= "<td>{$record['updated_at']}</td>";
        $output .= "<td><a href = 'delete.php?id={$record["id"]}'><button>削除</button></a></td>";
        $output .= "<tr>";
    }
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/manage_home.css">
    <title>管理者画面</title>
</head>

<body>
    <header>
        <div id="header">
            <div id="logo">
                <img src="img/logo.png" alt="">
            </div>
            <div id="logout">
                <a href="logout.php"><img src="img/logout.png" alt=""></a>
            </div>
        </div>
    </header>
    <h2>hometter(管理者画面)</h2>
    <table>
        <tr>
            <th>id</th>
            <th>ユーザー名</th>
            <th>作成日</th>
            <th>更新日</th>
            <th>オプション</th>
        </tr>
        <?= $output ?>
    </table>
</body>

</html>