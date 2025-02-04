
<?php
require_once 'DAO/DAO.php'; // DAOクラスを読み込む

try {
    // データベース接続を取得
    $dbh = DAO::get_db_connect();

    // フォーム入力値の取得
    $searchKeyword = isset($_GET['search']) ? trim($_GET['search']) : '';
    $intervals = isset($_GET['intervals']) ? $_GET['intervals'] : [];
    $genres = isset($_GET['genres']) ? $_GET['genres'] : [];
    $priceRanges = isset($_GET['prices']) ? $_GET['prices'] : [];

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

    $params = [];

    // キーワード検索
    if (!empty($searchKeyword)) {
        $sql .= " AND subsc.SubName LIKE ?";
        $params[] = '%' . $searchKeyword . '%';
    }

    // 支払い間隔検索
    if (!empty($intervals)) {
        $placeholders = implode(',', array_fill(0, count($intervals), '?'));
        $sql .= " AND kikan.Kikanname IN ($placeholders)";
        $params = array_merge($params, $intervals);
    }

    // ジャンル検索
    if (!empty($genres)) {
        $placeholders = implode(',', array_fill(0, count($genres), '?'));
        $sql .= " AND subsc.GenreID IN ($placeholders)";
        $params = array_merge($params, $genres);
    }

    // 料金範囲検索
    if (!empty($priceRanges)) {
        $priceConditions = [];
        foreach ($priceRanges as $range) {
            if ($range == 'under500') {
                $priceConditions[] = "subscplan.Price < 500";
            } elseif ($range == 'under1000') {
                $priceConditions[] = "(subscplan.Price >= 500 AND subscplan.Price < 1000)";
            } elseif ($range == 'under3000') {
                $priceConditions[] = "(subscplan.Price >= 1000 AND subscplan.Price < 3000)";
            } elseif ($range == 'under5000') {
                $priceConditions[] = "(subscplan.Price >= 3000 AND subscplan.Price < 5000)";
            }
        }
        if (!empty($priceConditions)) {
            $sql .= " AND (" . implode(' OR ', $priceConditions) . ")";
        }
    }

    // クエリ実行
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <input type="text" name="search" size="75" class="text" placeholder="検索キーワード" value="<?= htmlspecialchars($searchKeyword, ENT_QUOTES, 'UTF-8') ?>">
        
        <h2>支払い</h2>
        <div class="container">
            <input type="checkbox" name="intervals[]" value="毎週" <?= in_array('毎週', $intervals) ? 'checked' : '' ?>> 毎週<br>
            <input type="checkbox" name="intervals[]" value="1カ月" <?= in_array('1カ月', $intervals) ? 'checked' : '' ?>> 1カ月<br>
            <input type="checkbox" name="intervals[]" value="半年" <?= in_array('半年', $intervals) ? 'checked' : '' ?>> 半年<br>
            <input type="checkbox" name="intervals[]" value="１年" <?= in_array('１年', $intervals) ? 'checked' : '' ?>> １年<br>
        

        <h2>ジャンル</h2>
        
            <input type="checkbox" name="genres[]" value="1" <?= in_array('1', $genres) ? 'checked' : '' ?>> ジャンル１<br>
            <input type="checkbox" name="genres[]" value="2" <?= in_array('2', $genres) ? 'checked' : '' ?>> ジャンル２<br>
            <input type="checkbox" name="genres[]" value="3" <?= in_array('3', $genres) ? 'checked' : '' ?>> ジャンル３<br>
            <input type="checkbox" name="genres[]" value="4" <?= in_array('4', $genres) ? 'checked' : '' ?>> ジャンル４<br>
        

        <h2>金額</h2>
        
            <input type="checkbox" name="prices[]" value="under500" <?= in_array('under500', $priceRanges) ? 'checked' : '' ?>> 500円以下<br>
            <input type="checkbox" name="prices[]" value="under1000" <?= in_array('under1000', $priceRanges) ? 'checked' : '' ?>> 500～1000円<br>
            <input type="checkbox" name="prices[]" value="under3000" <?= in_array('under3000', $priceRanges) ? 'checked' : '' ?>> 1000～3000円<br>
            <input type="checkbox" name="prices[]" value="under5000" <?= in_array('under5000', $priceRanges) ? 'checked' : '' ?>> 3000～5000円<br>
        </div>

        <button type="submit">検索</button>
    </form>

    <h2>検索結果</h2>
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
                        <button onclick="location.href='subscDetail.php?subid=<?= urlencode($result['SubID']) ?>'">詳細へ</button>
                        </th>
                    </tr>
                    <tr>
                        <th>支払い間隔</th>
                        <td><?= htmlspecialchars($result['intervalName'], ENT_QUOTES, 'UTF-8') ?>日</td>
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