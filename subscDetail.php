<?php 
    require_once 'DAO/subscDAO.php';

session_start();

    $isFavorite =false;

    if(isset($_GET['subid'])){
        $subID=$_GET['subid'];
        $subscDAO=new subscDAO();
        $subsc=$subscDAO->get_subsc($subID);
        if(!empty($_SESSION['member'])){
            $userID = (int)$_SESSION['member']->ID;
            $isFavorite = $subscDAO->is_favorite($userID,$subID);
            
        }
    }
    /*
    if(isset($_GET['favorite'])){
        $favorite=$_GET['favorite'];
       if($favorite==1){
        $subscDAO=new subscDAO();
        $subscDAO->add_favorite();
        
       }
       
    }*/
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">

    <title>サブスク詳細</title>
    <link rel="stylesheet" href="css/subscDetail.css">
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
    <div class="result">
        <div class="content">
            
            <img src="images/<?= $subsc[0]['image'] ?>">
        </div>
        <h1><?= $subsc[0]['subname'] ?></h1>
        <ul>
        <li>支払い間隔:<?=$subsc[0]['date'] ?>日</li>
        <li>無料期間:<?=$subsc[0]['freedate'] ?>日</li>
        </ul>
    </div>
    <br>
    <div class="detail">
        <p><a href="<?=$subsc[0]['URL'] ?>">登録URL</a></p>
    </div>
    <div class="detail">

        <p><input type="checkbox" id="favorite" <?= $isFavorite ? 'checked' : ''?> value="<?= $subID ?>">お気に入り</p>
       
        <p><a href="<?="./inputContract.php?subid=$subID"?>">家計簿に登録</a></p>

    </div>
    <br>
    <p class="instruct"><?=$subsc[0]['setumei'] ?></p>
    </div>
    <script src="js/checkbox_favorite.js" ></script>

</body>

</html>