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
        $returnimage        = "";
        $returnname         = "";
        $returndetail       = "";
        $returnimage        = "";
        $returncategory     = "";
        $returnaliasname    = "";
        $returnshortname    = "";
        $returnurl          = "";

    if(!empty($_SESSION['id'])){
        $subscid  = $_SESSION['id'];
        $subscUpdateDAO = new SubscUpdateDAO;
        $subscData=$subscUpdateDAO->get_subsc($subscid);
        $_SESSION['deleteImage'] = $subscData->image;
       
    }

    $subscRegiDAO = new subscRegiDAO;
    $freeTime_list = $subscRegiDAO->get_freetime();
    $interval_list = $subscRegiDAO->get_interval();
        
        
       
        if(isset($_SESSION['returnSubsc'])){  
            $returnSubsc    = $_SESSION['returnSubsc'];
            $returnname       = $returnSubsc[0];
            $returndetail     = $returnSubsc[1];
            $returnimage      = $returnSubsc[2];
            $returncategory   = $returnSubsc[3];
            $returnaliasname  = $returnSubsc[4];
            $returnshortname  = $returnSubsc[5];
            $returnurl        = $returnSubsc[6];
            $subscid = $_SESSION['id']; 
            session_destroy();
            
            
        }elseif($_SERVER['REQUEST_METHOD']==='POST'){    

            if(isset($_POST['submit'])){
                $path = "./images/";
                $temporary_file = $_FILES['file_name']['tmp_name']; # 一時ファイル名
                $true_file = $_FILES['file_name']['name']; # 本来のファイル名
                # is_uploaded_fileメソッドで、一時的にアップロードされたファイルが本当にアップロード処理されたかの確認
                if( !empty($_FILES['file_name']['tmp_name']) && is_uploaded_file($_FILES['file_name']['tmp_name']) ) {
                        move_uploaded_file( $_FILES['file_name']['tmp_name'], $path.$_FILES['file_name']['full_path']);
                        var_dump('アップロードしました');
                        $image      = $_FILES['file_name']['name'];
                }else{
                    $image= $subscData->image;
                }

                
                
                $name = $_POST['name'];
                $shortName = $_POST['shortName'];
                $aliasName = $_POST['aliasName'];
                $category = $_POST['category'];
                $interval1 = $_POST['interval1'];
                $interval2 = $_POST['interval2'];
                $interval3 = $_POST['interval3'];
                $amount1 = $_POST['amount1'];
                $amount2 = $_POST['amount2'];
                $amount3 = $_POST['amount3'];
                $free1 = $_POST['free1'];
                $free2 = $_POST['free2'];
                $free3 = $_POST['free3'];
                $detail = $_POST['detail'];
                $url = $_POST['url'];

                
                
                if($name=='' || $amount1=='' || $detail=='' || $url==''){
                    $errs='入力漏れがあります';
                }
                
                
                if(empty($errs)){
                    $updateSubsc = [$name,$detail,$image,$category,$aliasName,$shortName,$url];
                    $updateDate1 = [$interval1,$amount1,$free1];
                    
                    session_regenerate_id(true);
                    $_SESSION['updateData1']=$updateDate1;
                    
                    if($amount2 !== ''){
                        $updateDate2 = [$interval2,$amount2,$free2];
                        $_SESSION['updateData2']=$updateDate2;
                    }
                    if($amount3 !== ''){
                        $updateDate3 = [$interval3,$amount3,$free3];
                        $_SESSION['updateData3']=$updateDate3;
                    }
                    if($updateSubsc !==false){
                        $_SESSION['updateSubsc']=$updateSubsc;
                        $_SESSION['id'] = $subscid;
                        $_SESSION['deleteImage'] = $subscData->image;
                        header('Location:updateConfirmation.php');
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
        <?php var_dump($subscid) ?>
    <form method = "POST" action ="" enctype="multipart/form-data">
    
    <?php if($errs!=null): ?>
        <spam style="color:red"><?= $errs ?></span>
    <?php endif ?>
        <div class="name">
        
        <p>アップロード画像</p>
        ※画像を変更しない場合ファイル選択は必要ありません<br>
        <input type="file" name="file_name"  value ="<?php if($subscData->image != "") : ?>images/<?=$subscData->image ?> <?php elseif($returnimage != ""): ?>images/<?= $returnimage?><?php endif?>">
        <input type="hidden" name="image" value ="<?php if($subscData->image != "") : ?><?=$subscData->image ?> <?php elseif($returnimage != ""): ?><?= $returnimage?><?php endif?>">
            <p>サブスク名<br>
                <input type="text" name="name" size="50px" value ="<?php if($subscData->subName !="" ) :?><?=$subscData->subName ?><?php elseif($returnname != ""): ?><?=$returnname ?><?php endif ?>">
            </p>
            <p>略称<br>
                <input type="text" name="shortName" size="50px" value ="<?php if($subscData->shortName !="" ) :?><?=$subscData->shortName ?><?php elseif($returnshortname != ""): ?><?=$returnshortname ?><?php endif ?>">
            </p>
            <p>別名<br>
                <input type="text" name="aliasName" size="50px" value ="<?php if($subscData->aliasName !="" ) :?><?=$subscData->aliasName ?><?php elseif($returnaliasname != ""): ?><?=$returnaliasname ?><?php endif ?>">
            </p>
            <br>
        </div>
        <div class="category">
            <input type="radio" id="50001" name="category" value="50001" <?php if($subscData->genreId =="50001" ) :?> checked <?php elseif($returncategory == "50001") :?> checked <?php endif ?>  />
            <label for="cate">動画配信</label>
            <input type="radio" id="50002" name="category" value="50002" <?php if($subscData->genreId =="50002" ) :?> checked <?php elseif($returncategory == "50002") :?> checked <?php endif ?>  />
            <label for="cate">音楽配信</label>
            <input type="radio" id="50003" name="category" value="50003" <?php if($subscData->genreId =="50003" ) :?> checked <?php elseif($returncategory == "50003") :?> checked <?php endif ?>  />
            <label for="cate">書籍</label>
            <input type="radio" id="50004" name="category" value="50004" <?php if($subscData->genreId =="50004" ) :?> checked <?php elseif($returncategory == "50004") :?> checked <?php endif ?>  />
            <label for="cate">食品</label>
        </div>
        <br>
        <div class="payterm">
        
                <?php for ($i = 1; $i <= 3; $i++): ?> 
                    <p>支払い<?= $i ?>

                        <select name="interval<?= $i?>">
                        <?php foreach($interval_list as $interval): ?>
                            <option value=-1 selected hidden >選択してください</option>
                            <option value =<?= $interval->date ?>><?= $interval->date ?>日</option>
                        <?php endforeach ?>
                        </select>
                        料金<?= $i ?>
                        <?php if($i==1): ?><input type="text" name="amount1" size="30px" ><?php else :?><input type="text" name="amount<?=$i?>" size="30px" ><?php endif ?>
                        無料期間
                        <select name="free<?= $i?>">
                        <?php foreach($freeTime_list as $freeTime): ?>
                            <option value=-1 selected hidden >選択してください</option>
                            <option value=<?= $freeTime->date ?>><?= $freeTime->date ?>日</option>
                        <?php endforeach ?>

                        </select>
                    </p>
                    <br>
                <?php endfor ?>
            
        </div>

        <br>
        <p>説明　　　　　<textarea  class="detail" rows ="4"cols="50" name="detail" ><?php if($subscData->setumei !=""):?><?= $subscData->setumei ?><?php elseif($returndetail != ""): ?><?=$returndetail ?><?php endif ?></textarea></p>
        <p>公式サイトURL<input type="text" name = "url" size="55px" value ="<?php if($subscData->url !=""):?><?= $subscData->url ?><?php elseif($returnurl != ""): ?><?=$returnurl ?><?php endif ?>" ></p>
        <br>
        <button type="submit" name = submit value = "submit">確認画面へ</button>
        <button type="submit" name = return value = "return">管理画面へ戻る</button>
        
    </form>
    
</body>

</html>