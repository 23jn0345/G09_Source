<?php
require_once 'DAO/DAO.php'; // DAOクラスを読み込む
require_once 'DAO/subscDAO.php';
try {
    // データベース接続を取得
    $dbh = DAO::get_db_connect();

    // フォーム入力値の取得
   
  
    $genres = isset($_GET['genres']) ? $_GET['genres'] : [];
  

    // ベースSQL
    


    

   
    
    $subscDAO=new subscDAO();
    if(isset($_GET['keyword']) && $_GET['keyword'] !== ''){
        $keyword = $_GET['keyword'];
        
        $results = $subscDAO->get_subsc_by_keyword($keyword);
        
      }else{
        $sql = "
        SELECT 
        subsc.SubID, -- SubID を追加
        subsc.SubName, 
        subsc.image, 
        subscplan.Price, 
        kikan.Kikanname AS intervalName
    FROM 
        subsc
    INNER JOIN subscplan ON subsc.SubID = subscplan.SubID
    INNER JOIN kikan ON subscplan.IntervalID = kikan.KikanID
    WHERE 1=1
    ";

    $params = [];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
            
        
        
    

   
   

} catch (PDOException $e) {
    echo "エラー: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>サブスク検索</title>
    <link rel="stylesheet" href="css/search.css">
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

    <form action="searchSubsc.php" method="GET">
     
        
        <div class="container">
        

        <h2>ジャンル</h2>
        
            <input type="checkbox" name="genres[]" value="1" <?= in_array('1', $genres) ? 'checked' : '' ?>> ジャンル１<br>
            <input type="checkbox" name="genres[]" value="2" <?= in_array('2', $genres) ? 'checked' : '' ?>> ジャンル２<br>
            <input type="checkbox" name="genres[]" value="3" <?= in_array('3', $genres) ? 'checked' : '' ?>> ジャンル３<br>
            <input type="checkbox" name="genres[]" value="4" <?= in_array('4', $genres) ? 'checked' : '' ?>> ジャンル４<br>
        

        </div>

    </form>
    
      <form action="subscSearch.php?keyword" method="GET">
        <p class="search">  検索 <input type="text" name="keyword" placeholder="検索キーワード" > 
        <input type="submit" value="検索">
      </form> 
    <?php if(isset($keyword) && $keyword !== '') : ?>
              検索結果 : <?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') ?>
          <?php endif;?></h2>
    <?php if ($results): ?>
        <?php foreach ($results as $result): ?>
            <div class="result">
                <div class="content">
                    <img src="images/<?= htmlspecialchars($result['image'], ENT_QUOTES, 'UTF-8') ?>" alt="画像">
                </div>
                <table border="1" class="content">
                    <tr>
                        <th colspan="2">
                        <?= htmlspecialchars($result['SubName'], ENT_QUOTES, 'UTF-8') ?>
                        <form action="subscDetail.php" method="POST">
    <input type="hidden" name="subid" value="<?= htmlspecialchars($result['SubID'], ENT_QUOTES, 'UTF-8') ?>">
    <input type="submit" value="詳細へ">
</form>
        </form>
                        </th>
                    </tr>
                    <tr>
                        <th>支払い間隔</th>
                        <td><?= htmlspecialchars($result['intervalName'], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                    <tr>
                        <th>料金</th>
                        <td><?= htmlspecialchars($result['Price'], ENT_QUOTES, 'UTF-8') ?>円</td>
                    </tr>
                </table>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>検索結果が見つかりませんでした。</p>
    <?php endif; ?>
</body>
</html>
