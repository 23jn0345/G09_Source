<?php
session_start();

// セッションからユーザーIDを取得し、JSONで返す
//チェックボックスの処理など、javascriptからphpのセッションを見るときに使う
$response = array(
    'isLoggedIn' => isset($_SESSION['member']),
    'redirectUrl' => './login.php'  // ログイン画面のURL
);

header('Content-Type: application/json');
echo json_encode($response);