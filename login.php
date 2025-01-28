<?php 
require_once 'DAO/MemberDAO.php';
$name='';
$errs=[];
session_start();
if(!empty($_SESSION['member'])){
    header('Location:home.php');
    exit;
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name=$_POST['name'];
    $password=$_POST['password'];
   
    if($name==''){
        $errs[]='IDを入力してください';
    }
    
    if($password===''){
        $errs[]='パスワードを入力してください';
    }
    if(empty($errs)){

    
        $memberDAO=new MemberDAO();
        $member=$memberDAO->get_member($name,$password);
        if($member !==false){
            session_regenerate_id(true);
            $_SESSION['member']=$member;
            header('Location:home.html');
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
   
        <title>login</title>
<link rel="stylesheet" href="css/login.css">
    </head>
    <body>
        <h1>ログイン</h1>
        <form action="" method="POST">
        <p>ユーザーID<br>
            <input type="text" name="name" size="50px" required autofocus class="text"></p>
        <p>パスワード<br>
        <input type="password" name="password" size="50px" required class="text">
        </p>
        <?php foreach($errs as $e) : ?>
            <span style="color:red"><?=$e ?></span>
            <br>
            <?php endforeach; ?>
            
            <input type="submit" value="ログイン" class="btn"><br>
            </div>
        </form>
          
        <button onclick="location.href='newRegistration.php'" class="btn">新規登録</button>
        </div>
       
       
        </body>
</html>