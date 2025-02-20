<?php

    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    
    require_once './DAO/subscRegistrationDAO.php';
    require_once './DAO/subscUpdateDAO.php';
    

        $subName    = "";
        $detail     = "";
        $image      = "";
        $category   = "";
        $aliasName  = "";
        $shortName  = "";
        $url        = "";

    
        $errs               = "";
        $image              = "";
        $returnname         = "";
        $returndetail       = "";
        $returnimage        = "";
        $returncategory     = "";
        $returnaliasname    = "";
        $returnshortname    = "";
        $returnurl          = "";

    if(!empty($_SESSION['update'])){
        $subscid  = $_SESSION['update'];
        $subscUpdateDAO = new SubscUpdateDAO;
        $subscData=$subscUpdateDAO->getsubsc($subscid);
        $subName    = $subscData[0];
        $detail     = $subscData[1];
        $image      = $subscData[2];
        $category   = $subscData[3];
        $aliasName  = $subscData[4];
        $shortName  = $subscData[5];
        $url        = $subscData[6];
       
    }

    $subscRegiDAO = new subscRegiDAO;
    $freeTime_list = $subscRegiDAO->get_freetime();
    $interval_list = $subscRegiDAO->get_interval();
        
        
       
        if(isset($_SESSION['returnSubsc'])){  
            $returnSubsc  = $_SESSION['returnSubsc'];
            $returnname       = $returnSubsc[0];
            $returndetail     = $returnSubsc[1];
            $returnimage      = $returnSubsc[2];
            $returncategory   = $returnSubsc[3];
            $returnaliasname  = $returnSubsc[4];
            $returnshortname  = $returnSubsc[5];
            $returnurl        = $returnSubsc[6];
            
        
        }elseif($_SERVER['REQUEST_METHOD']==='POST'){    

            if(!empty($_POST['submit'])){
                $file = "images/$image";
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
                    $errs='入力漏れがあります';
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
                
                }

            }
            elseif(!empty($_POST['return'])){
                
                header('Location:manageSubsc.php');
                exit;
            }
            
        
        }
    
    
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>サブスク更新</title>
    <link rel="stylesheet" href="css/subscRegistration.css">
</head>

<body>
    <?php include "adminHeader.php"; ?>
        <div class="title">
            <h1>サブスク更新</h1>
        </div>

    <form method = "POST" action ="">
    <?php if($errs!=null): ?>
        <spam style="color:red"><?= $errs ?></span>
    <?php endif ?>
        <div class="name">
        <?= var_dump($_SESSION['update'])?>
        <p>アップロード画像</p>
        <input type="file" name="image">
        
            <p>サブスク名<br>
                <input type="text" name="name" size="50px" value ="<?php if($subName !="" ) :?> <? $subName ?> <?php elseif($returnname != ""): ?> <?=$returnname ?><?php endif ?>">
            </p>
            <p>略称<br>
                <input type="text" name="shortName" size="50px" value ="<?php if($shortName !="" ) :?> <? $shortName ?> <?php elseif($returnshortname != ""): ?> <?=$returnshortname ?><?php endif ?>">
            </p>
            <p>別名<br>
                <input type="text" name="aliasName" size="50px" value ="<?php if($aliasName !="" ) :?> <? $aliasName ?> <?php elseif($returnaliasname != ""): ?> <?=$returnaliasname ?><?php endif ?>">
            </p>
            <br>
        </div>
        <div class="category">
            <input type="radio" id="50001" name="category" value="50001" <?php if($category !="" ) :?> checked <?php elseif($returncategory == ""): ?>checked<?php elseif($returncategory == "50001") :?> checked <?php endif ?>  />
            <label for="cate">動画配信</label>
            <input type="radio" id="50002" name="category" value="50002" <?php if($returncategory == "50002"): ?>checked <?php endif ?>/>
            <label for="cate">音楽配信</label>
            <input type="radio" id="50003" name="category" value="50003" <?php if($returncategory == "50003"): ?>checked <?php endif ?>/>
            <label for="cate">書籍</label>
            <input type="radio" id="50004" name="category" value="50004" <?php if($returncategory == "50004"): ?>checked <?php endif ?>/>
            <label for="cate">食品</label>
        </div>
        <br>
        <div class="payterm">
        
                <?php for ($i = 1; $i <= 3; $i++): ?> 
                    <p>支払い<?= $i ?>

                        <select name="interval<?= $i?>">
                        <?php foreach($interval_list as $interval): ?>
                                <option value =<?= $interval->date ?>><?= $interval->date ?>日</option>
                        <?php endforeach ?>
                        </select>
                        料金<?= $i ?>
                        <?php if($i==1): ?>
                            <input type="text" name="amount1" size="30px" >
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
            
        </div>

        <br>
        <p>説明　　　　　<input type="text" class="detail" size="55px" name="detail" value ="<?php if($returndetail != ""): ?> <?=$returndetail ?><?php endif ?>" ></p>
        <p>公式サイトURL<input type="text" name = "url" size="55px" value ="<?php if($returnurl != ""): ?> <?=$returnurl ?><?php endif ?>" ></p>
        <br>
        <button type="submit" name = submit value = "submit">確認画面へ</button>
        <button type="submit" name = return value = "return">管理画面へ戻る</button>
    </form>
    
</body>

</html>