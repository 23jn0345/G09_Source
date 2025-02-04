<?php 
require_once 'DAO/subscDAO.php';

$subscDAO=new subscDAO();
    if(isset($_GET['subID'])){
        $subID=$_GET['subID'];
       
        $subsc=$subscDAO->get_subsc($subID);
    }
    if(isset($_GET['favorite'])){
        $favorite=$_GET['favorite'];
       if($favorite==1){
        $subscDAO->add_favorite();
       }
       
    }

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
            <img src="imeges/<?= $subsc->image ?>">
        </div>
        <h1><?= $subsc->subName ?></h1>
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
        <form action="" method="GET">
        <p><input type="checkbox" name="favorite" value="1">お気に入り</p>
</form>
       
        
    </div>
    <br>
    <p class="instruct"><?=$subsc[0]['setumei'] ?></p>
    </div>
</body>

</html>