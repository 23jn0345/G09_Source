
<?php 
require_once 'DAO/subscDAO.php';

$subscDAO = new subscDAO(); 

if(isset($_GET['keyword'])){
$keyword=$_GET['keyword'];
$term_list=$subscDAO->get_term();
$subsc_list=$subscDAO->get_subsc_by_keyword($keyword);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">

  <title>サブスク検索</title>
  <link rel="stylesheet" href="css/search.css">
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

  
    <p><br>
    <form action="" method="GET">
    <input type="text" name="keyword" size=75px class="text" value="<?=@$keyword ?>"></p>
                
                <? htmlspecialchars($keyword,ENT_QUOTES,'UTF-8'); ?>
            <input type="submit" value="検索">
            <p><?php if(!empty($keyword)){  ?>
  <?= "検索結果：", htmlspecialchars(@$keyword,ENT_QUOTES,'UTF-8'); ?> 
 <?php } ?></p>
<?php foreach($subsc_list as $subsc) : ?>

      
  </form>
  <div class="result">
    <div class="content">
      <img src="netflix.png">
    </div>
    <table border="1" class="content">
      <tr>
        <th colspan="2"><?=$subsc->subName ?><button onclick="location.href='subscDetail.html'">詳細へ</button></th>
        
      </tr>
      <br>
      <tr>
        <th>支払い間隔</th>
        <td><?=$term_list->interval ?> </td>
      </tr>
      <tr>
        <th>料金</th>
        <td>890円</td>
      </tr>
    </table>
  </div>
  <?php endforeach ?>

  <div class="container">
    <form>

      <h2>支払い</h2>
        <div class="frequency">
          <input type="checkbox" id="week" />
          <label for="week">毎週</label><br>
          <input type="checkbox" id="month" />
          <label for="month">1カ月</label><br>
          <input type="checkbox" id="harf-year" />
          <label for="harf-year">半年</label><br>
          <input type="checkbox" id="year" />
          <label for="year">１年</label><br>
        </div>
        <br>
      <h2>ジャンル</h2>
      <div class="category">
        <input type="checkbox" id="1" />
        <label for="1">ジャンル１</label><br>
        <input type="checkbox" id="2" />
        <label for="2">ジャンル２</label><br>
        <input type="checkbox" id="3" />
        <label for="3">ジャンル３</label><br>
        <input type="checkbox" id="4" />
        <label for="3">ジャンル４</label><br>
      </div>
      <br>
      <h2>金額</h2>
      <div class="fee">
        <input type="checkbox" id="under500" />
        <label for="under500">５００円以下</label><br>
        <input type="checkbox" id="under1000" />
        <label for="under1000">５００～１０００円</label><br>
        <input type="checkbox" id="under3000" />
        <label for="under3000">１０００～３０００円</label><br>
        <input type="checkbox" id="under5000" />
        <label for="under5000">３０００～５０００円</label><br>
      </div>
      <br>
    </form>
  </div>
</body>

</html>