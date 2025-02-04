<?php
require_once "DAO/subscDAO.php";


if(session_status()===PHP_SESSION_NONE){
    session_start();
}
if(empty($_SESSION['member'])){
    header('Location:login.php');
    exit;
}else{
        $member=$_SESSION['member'];
        $subscDAO=new subscDAO();
        $favorite_list= $subscDAO->get_favorite_by_id($member->ID);
    }
    if($_SERVER['REQUEST_METHOD']==='POST'){
        if(isset($_POST['delete'])){
            $subID=$_POST['SubID'];
            $subscDAO=new subscDAO();
            $subscDAO->delete_favorite($member->ID,$subID);
            echo "お気に入りを解除しました";
    }
    }
       


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">

    <title>お気に入り一覧</title>
    <link rel="stylesheet" href="css/recommend.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <header>
        <h1>サブスル</h1>
        <nav>
            <ul>
                <li><a href="home.php">家計簿閲覧</a></li>
                <li><a href="subscSearch.php">サブスク検索</a></li>
                <li><a href="usingSubsc.php">利用中のサブスク</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="title">
        <h1>お気に入り一覧</h1>
    </div>

    <?php if(empty($favorite_list)) : ?>
    <p>お気に入りのサブスクはありません</p>
    <?php else: ?>
        
        <?php foreach($favorite_list as $favorite) : ?>

 
 
    
        <table class="table1">

            <tr>
                <form action="subscDetail.php" method="GET">
                <th scope="col"> <a href="subscDetail.php?SubID=<? $favorite['SubID'] ?>">詳細</button></th>
        </form>
                <th scope="col">サブスク名</th>
                <th scope="col">料金</th>
                <th scope="col">無料期間</th>
                <th scope="col">説明</th>
            </tr>
            <td scope="row"><img src="images/<?=$favorite['image'] ?> "></th>
            
            <td><?=$favorite['SubName'] ?></td>
            <td><?=$favorite['Price'] ?></td>
            <td><?=$favorite['freedate'] ?></td>
            <td><?=$favorite['Setumei'] ?></td>
            <form action="" method="POST">
                <input type="hidden" value="<? $favorite['SubID'] ?>">
            <td><button type="submit" name="delete">解除</button></td>
        </form>
     
   

    
            </tr>
        </table>
        <?php endforeach ?>
      <?php endif ?>
    





</body>

</html>