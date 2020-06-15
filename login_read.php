<?php
// var_dump($_POST);
// exit();

session_start();

// 外部ファイル読み込み
include('functions.php');
// DB接続します
$pdo = connect_to_db();
// データ受け取り
$user_id = $_POST['player'];
$password = $_POST['pass'];
// データ取得SQL作成&実行
$sql = 'SELECT * FROM users_table WHERE user_id=:user_id AND password=:password AND is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();
// SQL実行時にエラーがある場合はエラーを表示して終了
if ($status == false) {
    echo json_encode(["error_msg" => "{$error[2]}"]);
}

// うまくいったらデータ（1レコード）を取得
$val = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザ情報が取得できない場合はメッセージを表示
if (!$val) {
    echo "<p>ログイン情報に誤りがあります。</p>";
    echo '<a href="login.php">login</a>';
    exit();
} else {
    // ログインできたら情報をsession領域に保存して一覧ページへ移動
    $_SESSION = array();
    // セッション変数を空にする
    $_SESSION["session_id"] = session_id();
    $_SESSION["user_id"] = $val["user_id"];
    $_SESSION["is_admin"] = $val["is_admin"];

    if ($_SESSION['is_admin'] == 1) {
        header("Location:manage_home.php");
        exit();
    } else {
        header("Location:home.php");
        exit();
    }
}
