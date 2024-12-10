<?php 
require_once './helpers/MemberDAO.php';
$memberid='';
$errs=[];
session_start();
if(!empty($_SESSION['member'])){
    header('Location:.php');
    exit;
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    $memberid=$_POST['ID'];
    $password=$_POST['password'];
    if($memberid==''){
        $errs[]='メールアドレスを入力してください';
    }
    
    if($password===''){
        $errs[]='パスワードを入力してください';
    }
    if(empty($errs)){

    
    $memberDAO=new MemberDAO();
    $member=$memberDAO->get_member($email,$password);
    if($member !==false){
        session_regenerate_id(true);
        $_SESSION['member']=$member;
        header('Location:index.php');
        exit;
    }
    else{
        $errs[]='メールアドレスまたはパスワードに誤りがあります。';
    }
}
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
<meta charset="utf-8">
   
        <title>login</title>
<link rel="stylesheet" href="css/login.css">
    </head>
    <body>
        <h1>ログイン</h1>
        <form>
        <p>ユーザーID<br>
            <input type="text" name="ID" size="50px" required class="text"></p>
        <p>パスワード<br>
        <input type="password" name="password" size="50px" required class="text">
        </p>
        </form>

        <div class="btn">
        <button onclick="location.href='home.html'">ログイン</button><br>
        <button onclick="location.href='newRegistration.html'">新規登録</button>
        </div>
       
       
        </body>
</html>