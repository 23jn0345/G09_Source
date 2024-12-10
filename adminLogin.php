<?php 
require_once 'DAO/adminDAO.php';
$adminid='';
$errs=[];
session_start();
if(!empty($_SESSION['admin'])){
    header('Location:manageUser.php');
    exit;
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    $adminid=$_POST['ID'];
    $password=$_POST['password'];
   
    if($adminid==''){
        $errs[]='管理者IDを入力してください';
    }
    
    if($password===''){
        $errs[]='パスワードを入力してください';
    }
    if(empty($errs)){

    
    $adminDAO=new adminDAO();
    $admin=$adminDAO->get_admin($adminid,$password);
    if($member !==false){
        session_regenerate_id(true);
        $_SESSION['admin']=$admin;
        header('Location:manageUser.php');
        exit;
    }
    else{
        $errs[]='IDまたはパスワードに誤りがあります。';
    }
}
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
<meta charset="utf-8">
   
        <title>管理者ログイン</title>
<link rel="stylesheet" href="css/adminiLogin.css">
    </head>
    <body>
        <h1>管理者ログイン</h1>
        <form>
        <p>管理者ID<br>
            <input type="text" name="ID" size="50px" required class="text"></p>
        <p>管理者パスワード<br>
        <input type="password" name="password" size="50px" required class="text">
        </p>
        </form>

        <div class="btn">
        <button onclick="location.href='manageUser.html'">ログイン</button><br>
       </div>
       
       
        </body>
</html>