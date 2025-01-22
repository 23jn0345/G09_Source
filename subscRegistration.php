<?php
    require_once './DAO/subscRegistrationDAO.php';

    $subscRegiDAO = new subscRegiDAO;
    $freeTime_list = $subscRegiDAO->get_freetime();
    $interval_list = $subscRegiDAO->get_interval();

    // if (isset($_POST['upload'])) {//送信ボタンが押された場合
	// 	$image = uniqid(mt_rand(), true);//ファイル名をユニーク化
	// 	$image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
	// 	$file = "images/$image";
    //     $sql = "INSERT INTO images(name) VALUES (:image)";
	// 	$stmt = $dbh->prepare($sql);
	// 	$stmt->bindValue(':image', $image, PDO::PARAM_STR);
	// 	if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
	// 		move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $image);//imagesディレクトリにファイル保存
	// 		if (exif_imagetype($file)) {//画像ファイルかのチェック
    //             $message = '画像をアップロードしました';
    //             $stmt->execute();
	// 		} else {
	// 			$message = '画像ファイルではありません';
	// 		}
	// 	}
	// }

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">

    <title>サブスク詳細登録</title>
    <link rel="stylesheet" href="css/subscRegistration.css">
</head>


<body>
    <?php include "adminHeader.php"; ?>
                
        <div class="title">
            <h1>サブスク詳細登録</h1>
        </div>

    <form method = "POST">
        <div class="name">
        <p>アップロード画像</p>
        <input type="file" name="image">
        
        
            <p>サブスク名<br>
                <input type="text" name="ID" size="50px" required>
            </p>
            <p>略称<br>
                <input type="text" name="password" size="50px">
            </p>
            <p>別名<br>
                <input type="text" name="password" size="50px">
            </p>
            <br>
        </div>
        <div class="category">
            <input type="checkbox" id="cate" name="50001" checked />
            <label for="cate">動画配信</label>
            <input type="checkbox" id="cate" name="50002" />
            <label for="cate">音楽配信</label>
            <input type="checkbox" id="cate" name="50003" />
            <label for="cate">書籍</label>
            <input type="checkbox" id="cate" name="50004" />
            <label for="cate">食品</label>
        </div>
        <br>
        <div class="payterm">
        <?php for ($i = 1; $i <= 3; $i++): ?> 
            <p>支払い<?= $i ?>
                <select name="pay<?= $i ?>">
                <?php foreach($interval_list as $interval): ?>
                        <option value=""><?= $interval->date ?>日</option>
                <?php endforeach ?>
                </select>
                料金<?= $i ?>
                <?php if($i==1): ?>
                    <input type="text" name="amount1" size="30px" required>
                <?php else :?>
                    <input type="text" name="amount<?= $i ?>" size="30px" required>
                <?php endif ?>
                無料期間
                <select name="free<?= $i ?>">
                <?php foreach($freeTime_list as $freeTime): ?>
                    <option value=""><?= $freeTime->date ?>日</option>
                <?php endforeach ?>

                </select>
            </p>
            <br>
            <?php endfor ?>
            
        </div>

        <br>
        <p class="text">説明　　　　　<input type="text" class="detail" size="55px" required></p>
        <p>公式サイトURL<input type="text" size="55px" required></p>
        <br>
        <input type="submit" value="検索">
    </form>
    




</body>

</html>