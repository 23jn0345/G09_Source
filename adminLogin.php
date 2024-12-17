<?php 
require_once './DAO/AdminDAO.php';
$managerid='';
$errs=[];
session_start();
if(!empty($_SESSION['manager'])){
    header('Location:.php');
    exit;
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    $managerid=$_POST['ID'];
    $password=$_POST['password'];
    if($managerid==''){
        $errs[]='IDを入力してください';
    }
    
    if($password===''){
        $errs[]='パスワードを入力してください';
    }
    if(empty($errs)){

    
    $AdminDAO=new AdminDAO();
    $manager=$AdminDAO->get_member($managerid,$password);
    if($manager !==false){
        session_regenerate_id(true);
        $_SESSION['manager']=$manager;
        header('Location:manageUser.php');
        exit;
    }
    else{
        $errs[]='ログインIDまたはパスワードに誤りがあります。';
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
        <form action="" method="POST">
        <p>管理者ID<br>
            <input type="text" name="ID" size="50px" required class="text"></p>
        <p>管理者パスワード<br>
        <input type="password" name="password" size="50px" required class="text">
        </p>
        

        <div class="btn">
        <input type="submit" value="ログイン"><br>
       </div>
       </form>
       
        </body>
</html>