<?php
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
        if(isset($_SESSION['regiSubsc'])){
            $regiSubsc  = $_SESSION['regiSubsc'];
            $name       = $regiSubsc[0];
            $detail     = $regiSubsc[1];
            $image      = $regiSubsc[2];
            $category   = $regiSubsc[3];
            $aliasname  = $regiSubsc[4];
            $shortname  = $regiSubsc[5];
            $url        = $regiSubsc[6];
            $regiData1  = $_SESSION['regiData1'];
            $interval1  = $regiData1[0];
            $amount1    = $regiData1[1];
            $free1      = $regiData1[2];
            if(isset($_SESSION['regiData2'])){
                $regiData2 = $_SESSION['regiData2'];
                $interval2  = $regiData2[0];
                $amount2    = $regiData2[1];
                $free2      = $regiData2[2];
            }
            if(isset($_SESSION['regiData3'])){
                $regiData3 = $_SESSION['regiData3'];
                $interval3  = $regiData3[0];
                $amount3    = $regiData3[1];
                $free3      = $regiData3[2];
            }


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
<?php include "adminHeader.php"; ?>
    <div class="title">サブスク登録確認</div>
    <p>アップロード画像</p>
         
    
    <form method = "POST" action="">
        <div class="name">
            <p>サブスク名<br>
                <input type="text" name="name" size="50px" disabled value="<?= $name ?>">
            </p>
            <p>略称<br>
                <input type="text" name="shortName" size="50px" disabled value="<?php if($shortname !== "") :?> <?= $shortname ?> <?php endif ?>">
            </p>
            <p>別名<br>
                <input type="text" name="aliasName" size="50px" disabled value="<?php if($aliasname !== "") :?> <?= $aliasname ?> <?php endif ?>">
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
            <?php if($i==1): ?>
                <select name="interval<?= $i ?>" disabled>
                    <option value ="<?= $interval1 ?>"><?= $interval1 ?>日</option>
                </select>
            <?php elseif($i==2): ?>
                <select name="interval<?= $i ?>" disabled>
                    <option value ="<?= $interval2 ?>"><?= $interval2 ?>日</option>
                </select>
            <?php elseif($i==3): ?>
                <select name="interval<?= $i ?>" disabled>
                    <option value ="<?= $interval3 ?>"><?= $interval3 ?>日</option>
                </select>
            <?php endif ?>
                
                料金<?= $i ?>
                <?php if($i==1): ?>
                    <input type="text" name="amount<?= $i ?>" size="30px" value ="<?= $amount1 ?>" disabled>
                <?php elseif($i==2): ?>
                    <input type="text" name="amount<?= $i ?>" size="30px" value ="<?= $amount2 ?>" disabled>
                <?php elseif($i==3): ?>
                    <input type="text" name="amount<?= $i ?>" size="30px" value ="<?= $amount3 ?>" disabled>
                <?php endif ?>
                無料期間
                <?php if($i==1): ?>
                    <select name="free<?= $i ?>" disabled>
                        <option value=<?= $free1 ?>><?=$free1 ?>日</option>
                    </select>
                <?php elseif($i==2): ?>
                    <select name="free<?= $i ?>" disabled>
                        <option value=<?= $free2 ?>><?= $free2 ?>日</option>
                    </select>
                <?php elseif($i==3): ?>
                    <select name="free<?= $i ?>" disabled>
                        <option value=<?= $free3 ?>><?= $free3 ?>日</option>
                    </select>
                <?php endif ?>

                
            </p>
            <br>
            <?php endfor ?>

        </div>
        <p class="text">説明　　　　　<input type="text" class="detail" size="55px" name="detail" disabled value="<?= $detail ?>"></p>
        <p>公式サイトURL<input type="text"  size="55px" name="url" disabled value ="<?= $url ?>"></p>
        </div>

    

    
    <button type ="submit" name = "retouch" value ="retouch">修正</button>
    <br>
    <button type ="submit" name = "regist" value ="regist">登録</button>
    

    </form>



</body>

</html>