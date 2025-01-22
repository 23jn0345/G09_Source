<?php
require_once "DAO/usingsubscDAO.php";
require_once 'DAO/MemberDAO.php';
if(session_status()===PHP_SESSION_NONE){
    session_start();
}
if(empty($_SESSION['member'])){
    header('Location:login.php');
    exit;
    $member=$_SESSION['member'];
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['add'])){
        $name=$_POST['subName'];
        
        $usingsubscDAO=new CartDAO();
        $usingsubscDAO->subscribe($member->ID,$subID);
        /*
    }else if(isset($_POST['change'])){
        $subID=$_POST['subID'];
        $usingsubscDAO=new  usingsubscDAO();
        $usingsubscDAO->update($member->ID,$subID);
        */
    }else if(isset($_POST['delete'])){
        $subID=$_POST['subID'];
        $usingsubscDAO=new usingsubscDAO();
        $usingsubscDAO->delete($member->ID,$subID);
}
header("Location:" . $_SERVER['PHP_SELF']);
exit;
}
$usingsubscDAO =new usingsubscDAO();
$using_list=$usingsubscDAO->get_using_by_memberid($member->ID);
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

  <form action="" method="GET">
    <p><br>
      検索 <input type="text" name="Search" size=75px class="text"></p>
  </form>
  
  <button class="reco_button" onclick="location.href='recommend.php'">お気に入り一覧</button></p>
  <div class="result">
    <div class="content">
    <?php if(empty($using_list)) : ?>
    <p>利用中のサブスクはありません</p>
    <?php else: ?>
        <?php foreach($using_list as $using) : ?>
          <table border="1" class="content">
            <tr>
                <td>
                 <img src="<?= $using->image ?>">
              </td>
    
    
      <tr>
        <form action ="changePlan.php" method="POST" value="<?= $using->subID ?>">
        <th colspan="2"><?= $using->name ?><button onclick="location.href='changePlan.php'">変更・解除</button></th>
        </form>
      </tr>
      <tr>
        <th scope="row">支払い間隔</th>
        <td><?= $using->date ?></td>
      </tr>
      <tr>
        <th scope="row">料金</th>
        <td><?= $using->price ?></td>
      </tr>
    </table>
    <br>
  </div>
  
<?php endforeach; ?>
</body>

</html>