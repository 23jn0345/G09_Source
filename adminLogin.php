<?php 
require_once './DAO/adminDAO.php';
$managerid='';
$errs=[];
session_start();
if(!empty($_SESSION['manager'])){
    header('Location:manageUser.php');
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
        $manager=$AdminDAO->get_admin($managerid,$password);
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
            <?php foreach($errs as $e) : ?>
                        <spam style="color:red"><?= $e ?></span>
                        <br>
                        <?php endforeach; ?>

            <div class="btn">
            <button type="submit">ログイン</button><br>
            </div>
            
        </form>
    </body>
</html>