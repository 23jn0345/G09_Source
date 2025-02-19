<?php
require_once 'DAO/MemberDAO.php';
require_once 'DAO/subscDAO.php';


session_start();

// JSONレスポンスを返すことを明示
header('Content-Type: application/json');

try {
    // セッションチェック
    if (!isset($_SESSION['member'])) {
        throw new Exception('ログインが必要です');
    }

    // POSTデータを取得
    $postData = json_decode(file_get_contents('php://input'), true);
    
    // subIDの取得と検証
    if (!isset($postData['subID'])) {
        throw new Exception('パラメータが不正です');
    }

    // 各変数の宣言と値の設定
    $subID = (int)$postData['subID'];
    $userID = (int)$_SESSION['member']->ID;
    $subscDAO=new subscDAO();
    // お気に入り登録メソッドを呼び出し
    $result = $subscDAO->delete_favorite($userID, $subID);



    // 成功レスポンスを返す
    
    echo json_encode([
        'success' => true,
        'message' => 'お気に入りに削除しました'
    ]);
    

} catch (Exception $e) {
    // エラーレスポンスを返す
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}