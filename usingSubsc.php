<?php
require_once "DAO/usingsubscDAO.php";
require_once 'DAO/MemberDAO.php';
if(session_status()===PHP_SESSION_NONE){
    session_start();
}
if(empty($_SESSION['member'])){
    header('Location:login.php');
    exit;
}


else{
  $member=$_SESSION['member'];
$usingsubscDAO =new usingsubscDAO();
$using_list=$usingsubscDAO->get_using_by_id($member->ID);
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">

  <title>利用中のサブスク一覧</title>
  <link rel="stylesheet" href="css/usingSubsc.css">
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

  
  <p class="title">利用中のサブスク</p>
  <button class="reco_button" onclick="location.href='recommend.php'">お気に入り一覧</button></p>
  <div class="result">
    <div class="content">
    <?php if(empty($using_list)) : ?>
    <p>利用中のサブスクはありません</p>
    <?php else: ?>
        <?php foreach($using_list as $using) : ?>
          
          <table class="table1">
           
        <th scope="col"><?= $using['SubName'] ?>
       
        <th scope="col">支払い間隔</th>
        <th scope="col">料金</th>
        </tr>
             
        <td scope="row"> <img src="images/<?= $using['image'] ?>"></td>
        <td><?= $using['date'] ?>日</td>
        <td><?= $using['Price'] ?>円</td>
        
        <th><button class="planbutton" onclick="location.href='changePlan.php?subID=<?php echo urlencode($using['SubID']); ?>'">変更・解除</button></th>
     
    </table>
    <br>
  </div>
        </div>
<?php endforeach; ?>
<?php endif ?>
</body>

</html>