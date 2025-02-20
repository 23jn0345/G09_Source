
<?php 
require_once 'DAO/DAO.php'; // DAOクラスを読み込む
require_once 'DAO/subscDAO.php';
$subscDAO = new subscDAO();

  // データベース接続を取得
  $dbh = DAO::get_db_connect();

  // フォーム入力値の取得
  $searchKeyword = isset($_GET['search']) ? trim($_GET['search']) : '';
  $genres = isset($_GET['genres']) ? $_GET['genres'] : [];

  // ベースSQL
  $sql = "
      SELECT 
      subsc.SubID, -- SubID を追加
      subsc.SubName, 
      subsc.image, 
      subscplan.Price, 
      kikan.date AS intervalName
  FROM 
      subsc
  INNER JOIN subscplan ON subsc.SubID = subscplan.SubID
  INNER JOIN kikan ON subscplan.IntervalID = kikan.KikanID
  WHERE 1=1
  ";

  //$params = [];
  
  //$stmt = $dbh->prepare($sql);
  //$stmt->execute($params);
  $results =$subscDAO->get_all_subsc();
  // キーワード検索
  if(isset($_GET['search']) && $_GET['search'] !== ''){
      $keyword = $_GET['search'];
      $results = $subscDAO->get_subsc_by_keyword($keyword);
    }
  if(isset($_GET['genres']) && $_GET['genres'] !== ''){
      $genre = $_GET['genres'];
      $results = $subscDAO->get_subsc_by_genre($genre);
  }
  if(isset($_GET['genres']) && $_GET['genres'] !== '' && isset($_GET['search']) && $_GET['search'] !== ''){
      $keyword = $_GET['search'];
      $genre = $_GET['genres'];
      $results = $subscDAO->get_subsc_by_keywordgenre($keyword,$genre);
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

    <form action="" method="GET">
        <input type="text" name="search" size="75" class="text" placeholder="検索キーワード" value="<?= htmlspecialchars($searchKeyword, ENT_QUOTES, 'UTF-8') ?>">

        <div class="container"> 
        <h2>ジャンル</h2>
            <input type="radio" name="genres" value="50001" > 動画配信<br>
            <input type="radio" name="genres" value="50002" > 音楽配信<br>
            <input type="radio" name="genres" value="50003" > 電子書籍<br>
            <input type="radio" name="genres" value="50004" > 食品<br>
        </div>
        <button type="submit">検索</button>
    </form>

    <h2>検索結果</h2>
    
    <?php if ($results): ?>
        <?php foreach ($results as $result): ?>
            <div class="result">
                <div class="content">
                    <img src="images/<?= $result->image?>" alt="画像">
        </div>
                <table border="1" class="content">
                    <tr>
                        <th colspan="2">
                        <?= $result->subname?>
                        <button onclick="location.href='subscDetail.php?subid=<?= $result->subID ?>'">詳細へ</button>
                        </th>
                    </tr>
                    <tr>
                        <th>支払い間隔</th>
                        <td><?= $result->date?>日</td>
                    </tr>
                    <tr>
                        <th>料金</th>
                        <td><?= $result->price?>円</td>
                    </tr>
                </table>
            </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>検索結果が見つかりませんでした。</p>
    <?php endif; ?>
</body>
</html>
