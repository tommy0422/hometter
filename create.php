<?php
// var_dump($_POST);
// exit();

//関数ファイル読み込み
include("functions.php");

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

//DB接続
$pdo = connect_to_db();

// データ登録SQL作成
$sql = 'INSERT INTO post(id, player, text, created_at) VALUES(NULL, :player, :text, sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
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
