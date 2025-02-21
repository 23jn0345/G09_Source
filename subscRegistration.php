<?php

    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }

    require_once './DAO/subscRegistrationDAO.php';
    $subscRegiDAO = new subscRegiDAO;
    $freeTime_list = $subscRegiDAO->get_freetime();
    $interval_list = $subscRegiDAO->get_interval();


        
        $errs               = "";
        $image              = "";
        $returnname         = "";
        $returndetail       = "";
        $returnimage        = "";
        $returncategory     = "";
        $returnaliasname    = "";
        $returnshortname    = "";
        $returnurl          = "";
        
       
        if(isset($_SESSION['returnSubsc'])){  
            $returnSubsc        = $_SESSION['returnSubsc'];
            $returnname         = $returnSubsc[0];
            $returndetail       = $returnSubsc[1];
            $returnimage        = $returnSubsc[2];
            $returncategory     = $returnSubsc[3];
            $returnaliasname    = $returnSubsc[4];
            $returnshortname    = $returnSubsc[5];
            $returnurl          = $returnSubsc[6];
            session_destroy();
        
        }elseif($_SERVER['REQUEST_METHOD']==='POST'){    

            if(isset($_POST['submit'])){

                $file           = "images/$image";
                $image          = $_POST['image'];
                $name           = $_POST['name'];
                $shortName      = $_POST['shortName'];
                $aliasName      = $_POST['aliasName'];
                $category       = $_POST['category'];
                $interval1      = $_POST['interval1'];
                $interval2      = $_POST['interval2'];
                $interval3      = $_POST['interval3'];
                $amount1        = $_POST['amount1'];
                $amount2        = $_POST['amount2'];
                $amount3        = $_POST['amount3'];
                $free1          = $_POST['free1'];
                $free2          = $_POST['free2'];
                $free3          = $_POST['free3'];
                $detail         = $_POST['detail'];
                $url            = $_POST['url'];

            
            
            if($name=='' || $amount1=='' || $detail=='' || $url=='' || $free1==-1 || $interval1==-1){
                $errs='入力漏れがあります';
            }
            
            if($errs == ""){
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
                if($regiSubsc !==""){
                    $_SESSION['regiSubsc']=$regiSubsc;
                    header('Location:regiConfirmation.php');
                    exit;
                }
                else{
                    $errs='入力漏れがあります';
                }
                
            }

        }
        elseif(!empty($_SERVER['REQUEST_METHOD']==='POST')){
            header('Location:manageSubsc.php');
            exit;
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
            <?php echo($errs) ?>
            <div class="name">
            <p>アップロード画像</p>
            <input type="file" name="image">
            
                <p>サブスク名<br>
                    <input type="text" name="name" size="50px" value ="<?php if($returnname != ""): ?> <?=$returnname ?><?php endif ?>">
                </p>
                <p>略称<br>
                    <input type="text" name="shortName" size="50px" value ="<?php if($returnshortname != ""): ?> <?=$returnshortname ?><?php endif ?>">
                </p>
                <p>別名<br>
                    <input type="text" name="aliasName" size="50px" value ="<?php if($returnaliasname != ""): ?> <?=$returnaliasname ?><?php endif ?>">
                </p>
                <br>
            </div>
            <div class="category">
                <input type="radio" id="50001" name="category" value="50001" <?php if($returncategory == ""): ?>checked<?php elseif($returncategory == "50001") :?> checked <?php endif ?>  />
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
                                <option value=-1 selected hidden >選択してください</option>
                                <?php foreach($interval_list as $interval): ?>
                                    <option value =<?= $interval->date ?>><?= $interval->date ?>日</option>
                                <?php endforeach ?>
                            </select>
                            料金<?= $i ?>
                            <?php if($i==1): ?>
                                <input type="text" name="amount1" size="30px">
                            <?php else :?>
                                <input type="text" name="amount<?=$i?>" size="30px" >
                            <?php endif ?>
                            無料期間
                            <select name="free<?= $i?>">
                                <option value=-1 selected hidden >選択してください</option>
                                <?php foreach($freeTime_list as $freeTime): ?>
                                    <option value=<?= $freeTime->date ?>><?= $freeTime->date ?>日</option>
                                <?php endforeach ?>

                            </select>
                        </p>
                        <br>
                    <?php endfor ?>
                
            </div>

            <br>
            <p>説明　　　　　<input type="text" class="detail" size="55px" name="detail" value ="<?php if($returndetail != ""): ?> <?=$returndetail ?><?php endif ?>"></p>
            <p>公式サイトURL<input type="text" name = "url" size="55px" value ="<?php if($returnurl != ""): ?> <?=$returnurl ?><?php endif ?>"></p>
            <br>
            <button type="submit" name = "submit" value = "submit">確認画面へ</button>
            <button type="submit" name = "return" value = "return">管理画面へ戻る</button>
        </form>
        




    </body>

</html>