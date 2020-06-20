<?php
// var_dump($_POST);
// exit();

session_start();
include('functions.php');
check_session_id();

//DB接続の設定
$pdo = connect_to_db();

//ユーザーIDの定義
$user_id = $_SESSION["user_id"];
// var_dump($user_id);
// exit();

//投稿するユーザーの情報を取得
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
$user_id = $record['id'];
// var_dump($user_id);
// exit();

//データ受け取り
$player = $_POST['player'];
$text = $_POST['text'];

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
    !isset($_POST['player']) || $_POST['player'] == '' ||
    !isset($_POST['text']) || $_POST['text'] == ''
) {
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
}

//sql準備&実行(褒めた人がユーザーに存在するかどうか確認する)
$sql = 'SELECT * FROM users_table WHERE user_id = :player';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':player', $player, PDO::PARAM_STR);
$status = $stmt->execute();

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

$player = $record['id'];
// var_dump($player);
// exit();

// データ登録SQL作成
$sql = 'INSERT INTO post(id, from_player, player, text, created_at) VALUES(NULL, :user_id ,:player, :text, sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':player', $player, PDO::PARAM_STR);
$stmt->bindValue(':text', $text, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:home.php");
    exit();
}
