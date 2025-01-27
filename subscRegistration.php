<?php

    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }

    require_once './DAO/subscRegistrationDAO.php';
    $subscRegiDAO = new subscRegiDAO;
    $freeTime_list = $subscRegiDAO->get_freetime();
    $interval_list = $subscRegiDAO->get_interval();


    


        $name       = "";
        $detail     = "";
        $image      = "";
        $category   = "";
        $aliasname  = "";
        $shortname  = "";
        $url        = "";
        $regiData1  = "";
        $interval1  = "";
        $amount1    = "";
        $free1      = "";
        $regiData2  = "";
        $interval2  = "";
        $amount2    = "";
        $free2      = "";
        $regiData3  = "";
        $interval3  = "";
        $amount3    = "";
        $free3      = "";
       
    
        if(isset($_SESSION['returnSubsc'])){
            $regiSubsc  = $_SESSION['returnSubsc'];
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
                $regiData2  = $_SESSION['regiData2'];
                $interval2  = $regiData2[0];
                $amount2    = $regiData2[1];
                $free2      = $regiData2[2];
            }
            if(isset($_SESSION['regiData3'])){
                $regiData3  = $_SESSION['regiData3'];
                $interval3  = $regiData3[0];
                $amount3    = $regiData3[1];
                $free3      = $regiData3[2];
            }
        }
    


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
                $errs[]='入力漏れがあります';
            }
            
            if(empty($errs)){
                $regiSubsc = [$name,$detail,$image,$category,$aliasName,$shortName,$url];
                $regiDate1 = [$interval1,$amount1,$free1];
                
                session_regenerate_id(true);
                $_SESSION['regiData1']=$regiDate1;
                
                if($amount2 !== ''){
                    $regiDate2 = [$interval2,$amount2,$free2];
                    $_SESSION['regiData2']=$regiDate2;
                }
                if($amount3 !== ''){
                    $regiDate3 = [$interval3,$amount3,$free3];
                    $_SESSION['regiData3']=$regiDate3;
                }
                if($regiSubsc !==false){
                    $_SESSION['regiSubsc']=$regiSubsc;
                    
                    header('Location:regiConfirmation.php');
                    exit;
                }
                else{
                    $errs[]='入力漏れがあります';
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
                <input type="text" name="name" size="50px" required value ="<?php if($name != ""): ?> <?=$name ?><?php endif ?>">
            </p>
            <p>略称<br>
                <input type="text" name="shortName" size="50px" value ="<?php if($shortname != ""): ?> <?=$shortname ?><?php endif ?>">
            </p>
            <p>別名<br>
                <input type="text" name="aliasName" size="50px" value ="<?php if($aliasname != ""): ?> <?=$aliasname ?><?php endif ?>">
            </p>
            <br>
        </div>
        <div class="category">
            <input type="radio" id="50001" name="category" value="50001" <?php if($category == "" ): ?>checked<?php elseif($category == "50001") :?> checkd <?php endif ?>  />
            <label for="cate">動画配信</label>
            <input type="radio" id="50002" name="category" value="50002" <?php if($category == "50002"): ?>checked <?php endif ?>/>
            <label for="cate">音楽配信</label>
            <input type="radio" id="50003" name="category" value="50003" <?php if($category == "50003"): ?>checked <?php endif ?>/>
            <label for="cate">書籍</label>
            <input type="radio" id="50004" name="category" value="50004" <?php if($category == "50004"): ?>checked <?php endif ?>/>
            <label for="cate">食品</label>
        </div>
        <br>
        <div class="payterm">
        <?php if($regiData1 != ""): ?>
            <?php for ($i = 1; $i <= 3; $i++): ?> 
                <p>支払い<?= $i ?>
                <?php if($i==1): ?>
                    <select name="interval<?= $i ?>" >
                        <option value ="<?= $interval1 ?>"><?= $interval1 ?>日</option>
                    </select>
                <?php elseif($i==2 && $regiData2 !=""): ?>
                    <select name="interval<?= $i ?>" >
                        <option value ="<?= $interval2 ?>"><?= $interval2 ?>日</option>
                    </select>
                <?php elseif($i==3 && $regiData3 !=""): ?>
                    <select name="interval<?= $i ?>" >
                        <option value ="<?= $interval3 ?>"><?= $interval3 ?>日</option>
                    </select>
                <? else :?>
                    
                <?php endif ?>
                    
                    料金<?= $i ?>
                    <?php if($i==1): ?>
                        <input type="text" name="amount<?= $i ?>" size="30px" value ="<?= $amount1 ?>" required >
                    <?php elseif($i==2 && $regiData2 !=""): ?>
                        <input type="text" name="amount<?= $i ?>" size="30px" value ="<?= $amount2 ?>" >
                    <?php elseif($i==3 && $regiData3 !=""): ?>
                        <input type="text" name="amount<?= $i ?>" size="30px" value ="<?= $amount3 ?>" >
                    <?php endif ?>
                    無料期間
                    <?php if($i==1): ?>
                        <select name="free<?= $i ?>" >
                            <option value=<?= $free1 ?>><?=$free1 ?>日</option>
                        </select>
                    <?php elseif($i==2 && $regiData2 !=""): ?>
                        <select name="free<?= $i ?>" >
                            <option value=<?= $free2 ?>><?= $free2 ?>日</option>
                        </select>
                    <?php elseif($i==3 && $regiData3 !=""): ?>
                        <select name="free<?= $i ?>" >
                            <option value=<?= $free3 ?>><?= $free3 ?>日</option>
                        </select>
                    <?php endif ?>
                </p>
                <br>
                <?php endfor ?>

            <?php else : ?>
                <?php for ($i = 1; $i <= 3; $i++): ?> 
                    <p>支払い<?= $i ?>

                        <select name="interval<?= $i?>">
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
                        <select name="free<?= $i?>">
                        <?php foreach($freeTime_list as $freeTime): ?>
                            <option value=<?= $freeTime->date ?>><?= $freeTime->date ?>日</option>
                        <?php endforeach ?>

                        </select>
                    </p>
                    <br>
                <?php endfor ?>
            <?php endif ?>
        </div>

        <br>
        <p >説明　　　　　<input type="text" class="detail" size="55px" name="detail" required></p>
        <p>公式サイトURL<input type="text" name = "url" size="55px" required></p>
        <br>
        <button type="submit">確認画面へ</button>
    </form>
    




</body>

</html>