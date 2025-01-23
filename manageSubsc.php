<?php
    require_once './DAO/manageSubscDAO.php';

    $subscDAO = new manageSubscDAO;
    $subsc_list = $subscDAO->get_subsc();
    
    if(isset($_GET['keyword']) && $_GET['keyword'] !== ''){
      $keyword = $_GET['keyword'];
      $subsc_list = $subscDAO->get_subsc_by_keyword($keyword);
    }

    

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">

    <title>サブスク管理</title>
    <link rel="stylesheet" href="css/manageSubsc.css">
    
</head>

<body>
    <?php include "adminHeader.php"; ?>
    <div class="title">
        <h1>サブスク管理</h1>
    </div>
    <button onclick="location.href='subscRegistration.php'" class="regi">新しいサブスクの登録</button><br>
    <form action="managesubsc.php?keyword" method="GET">
        <p ID="input">  検索 <input type="text" size="50px" name="keyword"> 
        <input type="submit" value="検索">
    </form> 

    <?php if(isset($keyword) && $keyword !== '') : ?>
              検索結果 : <?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') ?>
    <?php else :?>
        <br>
    <?php endif;?></h2>

    <?php foreach($subsc_list as $subsc) : ?>
    <div class="result">
        <table border="1">
            <tr>
                <th rowspan="4"><img src="images/<?= $subsc->image ?>"></th>
                <th colspan="2"><?= $subsc->subName ?></th>
                <td rowspan="4" align ="center" ><button onclick="location.href='subscUpdate.php'">編集</button></td>
            </tr>
            <br>
            <?php $data_list = $subscDAO->get_subscdata($subsc->subId); ?>
            <tr>
                <th>料金/支払いスパン</th>
                <?php foreach($data_list as $data) : ?>
                    <td><?= $data->price?>円/<?= $data->intervalDate ?>日</td>
                <?php endforeach?>
            </tr>
            <tr>
                <th>無料期間</th>
                <?php foreach($data_list as $data) : ?>
                    <td><?= $data->freetimedate?>日</td>
                <?php endforeach?>
            </tr>
            <tr>
                <th>ジャンル</th>
                <td><?= $subsc->genreName?></td>
            </tr>

        </table>
    </div>
    <?php endforeach ?>


</body>

</html>