<?php
    require_once 'DAO/subscDAO.php';
    require_once 'DAO/usingSubscDAO.php';


session_start();
$usingSubscDAO=new usingSubscDAO();

if(empty($_SESSION['member'])){
  header('Location:login.php');
  exit;
}else{
  $userID = (int)$_SESSION['member']->ID;
}

if(isset($_GET['subID'])){
  $subID=$_GET['subID'];
  $subscDAO=new subscDAO();
  $plans=$subscDAO->get_Plans_by_subID($subID);
  $useingSubsc = $subscDAO->get_Plans_and_subsc($userID,$subID);
  $nextPay = preg_split("/[-]/",$useingSubsc[0]['NextPay']);
  $endFree = preg_split("/[-]/",$useingSubsc[0]['EndFree']);;

}
var_dump($useingSubsc);

if(!empty($_POST["flequency"])){
  $planid_price = preg_split("/[,]/",$_POST["flequency"]);
  var_dump($planid_price[0]);
  $nextPay = $_POST["year"]."-".$_POST["month"]."-".$_POST["day"];
  $endFree = $_POST["free_year"]."-".$_POST["free_month"]."-".$_POST["free_day"];

  $usingSubscDAO->update_subscribe($userID, $subID,$planid_price[0],$endFree,$nextPay);

  header('Location:usingSubsc.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
<meta charset="utf-8">
   
        <title>契約内容変更</title>
<link rel="stylesheet" href="css/inputContract.css">
    </head>
    <body>
        <form action="" method="POST">
        <h1>契約した内容を変更してください/h1>
        <div class="name">
        <select name="usingSubsc" >
            <option value="<?= $subID ?>"><?=$plans[0]["SubName"]?></option>
        </select>
      </div>
        <p>次回支払日
            <select name="year">
            <?php for($i = 2025; $i <= 2028; $i++) { ?>
                <option value="<?= $i ?>" <?= ($nextPay[0] == $i) ? 'selected' : '' ?>>
                  <?= $i ?>年
                </option>
            <?php } ?>


              </select>
            <select name="month">
            <?php for($i = 1; $i <= 12; $i++) { ?>
                <option value="<?= $i ?>" <?= ($nextPay[1] == $i) ? 'selected' : '' ?>>
                  <?= $i ?>月
                </option>
            <?php } ?>
                
              </select>
            
              <select name="day">
              <?php for($i = 1; $i <= 31; $i++) { ?>
                <option value="<?= $i ?>" <?= ($nextPay[2] == $i) ? 'selected' : '' ?>>
                  <?= $i ?>日
                </option>
            <?php } ?>
               
              </select></p>
            
              <p>支払い頻度
                <select id="plans"name="flequency">
                <option value="-1"></option>
                  <?php foreach($plans as $plan) {?>
                    <option value="<?=$plan["PlanID"].",".$plan["Price"]?>" <?= ($useingSubsc[0]["date"] == $plan['date']) ? 'selected' : '' ?>><?=$plan["date"]?>日</option>

                  <?php } ?>

                </select>
              </p>
              <p>支払い料金<input id="pay_price" readonly type="text" value="<?=$useingSubsc[0]['Price']?>"></p>
              <br>
              <p>無料期間終了予定日
              <select name="free_year">
              <option value="-1"></option>
              <?php for($i = 2025; $i <= 2028; $i++) { ?>
                <option value="<?= $i ?>" <?= ($endFree[0] == $i) ? 'selected' : '' ?>>
                  <?= $i ?>年
                </option>
              <?php } ?>


              </select>

            <select name="free_month">
            <?php for($i = 1; $i <= 12; $i++) { ?>
                <option value="<?= $i ?>" <?= ($endFree[1] == $i) ? 'selected' : '' ?>>
                  <?= $i ?>月
                </option>
            <?php } ?>
              </select>
            
              <select name="free_day">
              <?php for($i = 1; $i <= 31; $i++) { ?>
                <option value="<?= $i ?>" <?= ($endFree[2] == $i) ? 'selected' : '' ?>>
                  <?= $i ?>日
                </option>
            <?php } ?>
              </select></p>
              <br>
 
              <button type="submit">内容を確定</button><br>
              </form>
              <button onclick='location.href="./subscDetail.php?subid= <?= $subID ?>"'>サブスク詳細画面に戻る</button><br>
          

       
<script>

// セレクトボックスの変更イベントを監視
document.getElementById('plans').addEventListener('change', function() {
    const selectedValue = this.value;
    planArr = selectedValue.split(",");
    const textInput = document.getElementById('pay_price');
    textInput.value = planArr[1];
    textInput.textContent = planArr[1];
    console.log("ryoukinn :",textInput.textContent);

    
});
</script>
        </body>
</html>