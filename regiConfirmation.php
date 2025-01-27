<?php
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
        if(isset($_SESSION['regiSubsc'])){
            $regiSubsc = $_SESSION['regiSubsc'];
            $category = $regiSubsc[3];
            $name = $regiSubsc[0];
            $shortname = $
            
        }


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

    <title>サブスク詳細登録確認</title>
    <link rel="stylesheet" href="css/regiConfirmation.css">
    <link rel="stylesheet" href="css/adminiHeader.css">

</head>

<body>
    <header>
        <h1>サブスル管理</h1>
        <nav>
            <ul>
                <li><a href="manageUser.html">利用者管理</a></li>
                <li><a href="manageSubsc.html">サブスク管理</a></li>

            </ul>
        </nav>

    </header>
    <div class="title">サブスク登録確認</div>
    <img src="netflix.png"><br>

    <form>
        <div class="name">
            <p>サブスク名<br>
                <input type="text" name="ID" size="50px" disabled value="<?= $name ?>">
            </p>
            <p>略称<br>
                <input type="text" name="password" size="50px" disabled value="<?php if($shortname !== "") :?> <?= $shortname ?> <?php endif ?>">
            </p>
            <p>別名<br>
                <input type="text" name="password" size="50px" disabled value="ネットフリックス">
            </p>
        </div>
        <div class="category">
            <input type="radio" id="50001" name="category" disabled <?php if($category == "50001") :?> checked <?php endif ?> />
            <label for="cate">動画配信</label>
            <input type="radio" id="50001" name="category" disabled <?php if($category == "50002") :?> checked <?php endif ?>/>
            <label for="cate">音楽配信</label>
            <input type="radio" id="50001" name="category" disabled <?php if($category == "50003") :?> checked <?php endif ?>/>
            <label for="cate">書籍</label>
            <input type="radio" id="50001" name="category" disabled <?php if($category == "50004") :?> checked <?php endif ?>/>
            <label for="cate">食品</label>
        </div>
        <br>
        <div class="payterm">
        <?php for ($i = 1; $i <= 3; $i++): ?> 
            <p>支払い<?= $i ?>
                <select name="pay<?= $i ?>">
                <?php foreach($interval_list as $interval): ?>
                        <option value =<?= $interval->date ?>><?= $interval->date ?>日</option>
                <?php endforeach ?>
                </select>
                料金<?= $i ?>
                <?php if($i==1): ?>
                    <input type="text" name="amount1" size="30px" required>
                <?php else :?>
                    <input type="text" name="amount<?= $i ?>" size="30px" >
                <?php endif ?>
                無料期間
                <select name="free<?= $i ?>">
                <?php foreach($freeTime_list as $freeTime): ?>
                    <option value=<?= $freeTime->date ?>><?= $freeTime->date ?>日</option>
                <?php endforeach ?>

                </select>
            </p>
            <br>
            <?php endfor ?>

        </div>
        <p class="text">説明　　　　　<input type="text" class="detail" size="55px" disabled></p>
        <p>公式サイトURL<input type="text" size="55px" disabled></p>
        </div>

    </form>

    <div class="btn"></div>
    <button type ="submit" onclick="location.href='subscRegistration.php'">修正</button>
    <br>
    <button type ="submit" onclick="location.href='manageSubsc.php'">登録</button>
    </div>





</body>

</html>