<?php
    require_once './DAO/subscRegistrationDAO.php';
    session_start();
    $subscRegiDAO = new subscRegiDAO;
    $freeTime_list = $subscRegiDAO->get_freetime();
    $interval_list = $subscRegiDAO->get_interval();






    if($_SERVER['REQUEST_METHOD']==='POST'){
        $image=$_POST['image'];
        $name=$_POST['name'];
        $shortName=$_POST['shortName'];
        $aliasName=$_POST['aliasName'];
        $category=$_POST['category'];
        $interval1=$_POST['interval1'];
        $interval2=$_POST['interval2'];
        $interval3=$_POST['interval3'];
        $amount1=$_POST['amount1'];
        $amount2=$_POST['amount2'];
        $amount3=$_POST['amount3'];
        $free1=$_POST['free1'];
        $free2=$_POST['free2'];
        $free3=$_POST['free3'];
        $detail=$_POST['detail'];
        $url=$_POST['url'];
        if($name=='' || $amount1=='' || $detail=='' || $url==''){
            $errs[]='IDを入力してください';
        }
        
        if(empty($errs)){
            $regiSubsc = [$name,$detail,$image,$category,$aliasName,$shortName,$url];
            $regiDate1 = [$interval1,$amount1,$free1];
            if($regidata1 !==false){
            $_SESSION['regidata1']=$regidata1;
            
                if($amount2 !== ''){
                    $regiDate2 = [$interval2,$amount2,$free2];
                    $_SESSION['regidata2']=$regidata2;
                }
                if($amount3 !== ''){
                    $regiDate3 = [$interval3,$amount3,$free3];
                    $_SESSION['regidata3']=$regidata3;
                }
                if($regiSubsc !==false){
                    $_SESSION['regiSubsc']=$regiSubsc;
                    
                    header('Location:regiConfirmation.php');
                    exit;
                }
                else{
                    $errs[]='ログインIDまたはパスワードに誤りがあります。';
                }
            }
        }
    }
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

    <form method = "POST" action ="">
        <div class="name">
        <p>アップロード画像</p>
        <input type="file" name="image">
        
        
            <p>サブスク名<br>
                <input type="text" name="name" size="50px" required>
            </p>
            <p>略称<br>
                <input type="text" name="shortName" size="50px">
            </p>
            <p>別名<br>
                <input type="text" name="aliasName" size="50px">
            </p>
            <br>
        </div>
        <div class="category">
            <input type="radio" id="50001" name="category" value="50001" checked />
            <label for="cate">動画配信</label>
            <input type="radio" id="50002" name="category" value="50002"/>
            <label for="cate">音楽配信</label>
            <input type="radio" id="50003" name="category" value="50003"/>
            <label for="cate">書籍</label>
            <input type="radio" id="50004" name="category" value="50004"/>
            <label for="cate">食品</label>
        </div>
        <br>
        <div class="payterm">
        <?php for ($i = 1; $i <= 3; $i++): ?> 
            <p>支払い<?= $i ?>
                <select name="interval<?=$i?>">
                <?php foreach($interval_list as $interval): ?>
                        <option value =<?= $interval->date ?>><?= $interval->date ?>日</option>
                <?php endforeach ?>
                </select>
                料金<?= $i ?>
                <?php if($i==1): ?>
                    <input type="text" name="amount1" size="30px" required>
                <?php else :?>
                    <input type="text" name="amount<?=$i?>" size="30px" >
                <?php endif ?>
                無料期間
                <select name="free<?=$i?>">
                <?php foreach($freeTime_list as $freeTime): ?>
                    <option value=<?= $freeTime->date ?>><?= $freeTime->date ?>日</option>
                <?php endforeach ?>

                </select>
            </p>
            <br>
            <?php endfor ?>
            
        </div>

        <br>
        <p class="text">説明　　　　　<input type="text" class="detail" size="55px" name="detail" required></p>
        <p>公式サイトURL<input type="text" name = "url" size="55px" required></p>
        <br>
        <button type="submit">確認画面へ</button>
    </form>
    




</body>

</html>