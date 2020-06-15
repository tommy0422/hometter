<?php
session_start();
include("functions.php");
check_session_id();

// 送信データのチェック
// var_dump($_POST);
// exit();

// 送信データ受け取り
$user_id = $_POST["user_id"];
$password = $_POST["pass"];
$id = $_POST["id"];
// var_dump($user_id);
// exit();

// DB接続
$pdo = connect_to_db();

// UPDATE文を作成&実行
$sql = "UPDATE users_table SET user_id=:user_id, password=:password, updated_at=sysdate() WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
    header("Location:logout.php");
    exit();
}
