<?php 
require_once 'DAO/subscDAO.php';
$subscDAO=new subscDAO();

if(isset($_POST['subID'])){
    $subsc=$subscDAO->get_subsc($_POST['subID']);
}
//test
$subsc=$subscDAO->get_subsc('20002');

$image=$subsc[0]['image'];
$name=$subsc[0]['subname'];
$favorite = 0;
if(isset($_POST['favorite'])){
    $favorite = $_POST['favorite'];
}
if($favorite==1){
    $subscDAO->add_favorite();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">

    <title>サブスク詳細</title>
    <link rel="stylesheet" href="css/changePlan.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <header>

    <h1>サブスル</h1>
        <nav>
            <ul>
                <li><a href="home.html">家計簿閲覧</a></li>
                <li><a href="subscSearch.html">サブスク検索</a></li>
                <li><a href="usingSubsc.html">利用中のサブスク</a></li>
            </ul>
        </nav>
    </header>


    <div class="result">
        <div class="content">
            <img src="<?=$image ?>">
        </div>
        <h1><?=$name ?></h1>
        <div class="contract">
            <p>現在の契約</p>
            <ul>
                <li>支払い間隔:<?=$subsc[0]['date'] ?>日</li>
                <li>無料期間:<?=$subsc[0]['freedate'] ?>日</li>
            </ul>
        </div>
    </div>
    <div class="url">
        <p><a href="<?=$subsc[0]['URL']  ?>">登録URL</a></p>
    </div>

    <br>
    <div class="detail">
    <form method="POST" action="">
        <p><input type="checkbox" name="favorite" value="1">お気に入り</p>
</form>
        <p><button onclick="location.href='usingSubsc.html'">登録解除</button></p>
    </div>
    
    <br>
    
    <p class="instruct"><?=$subsc[0]['setumei']  ?></p>
    
    <br>
    <div class="change">
        <h2>変更内容</h2>
        <div class="flex">
            <div class="content">
                <from method="POST" action="">
                <p>支払い間隔 <select name="year">
                        <option value="<?=$subsc[0]['date'] ?>">日</option>
                    </select></p>
                <p>金額
                    <input type="text" name="ID" size="50px" required class="text">
                </p>
            </div>
            <button onclick="location.href='usingSubsc.html'">変更内容を反映</button>
        </div>
    </div>
</body>

</html>