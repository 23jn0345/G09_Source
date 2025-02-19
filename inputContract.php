<?php
    require_once 'DAO/subscDAO.php';
    require_once 'DAO/usingSubscDAO.php';


session_start();

if(empty($_SESSION['member'])){
  header('Location:login.php');
  exit;
}else{
  $userID = (int)$_SESSION['member']->ID;
}

if(isset($_GET['subid'])){
  $subID=$_GET['subid'];
  $subscDAO=new subscDAO();
  $plans=$subscDAO->get_Plans_by_subID($subID);

}
var_dump($_POST);

if(!empty($_POST["flequency"])){
  $usingSubscDAO=new usingSubscDAO();
  $planid_price = preg_split("/[,]/",$_POST["flequency"]);
  var_dump($planid_price[0]);
  $nextPay = $_POST["year"]."-".$_POST["month"]."-".$_POST["day"];
  $endFree = $_POST["free_year"]."-".$_POST["free_month"]."-".$_POST["free_day"];

  $usingSubscDAO->subscribe($userID, $subID,$planid_price[0],$endFree,$nextPay);

  header('Location:usingSubsc.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
<meta charset="utf-8">
   
        <title>契約内容入力</title>
<link rel="stylesheet" href="css/inputContract.css">
    </head>
    <body>
        <form action="" method="POST">
        <h1>契約したサービスを入力してください</h1>
        <div class="name">
        <select name="usingSubsc" >
            <option value="<?= $subID ?>"><?=$plans[0]["SubName"]?></option>
        </select>
      </div>
        <p>次回支払日
            <select name="year">
                <option value="2025"selected>2025年</option>
                <option value="2026" >2026年</option>
                <option value="2027">2027年</option>
                <option value="2028">2028年</option>

              </select>
            <select name="month">
                <option value="1"selected>1月</option>
                <option value="2" >2月</option>
                <option value="3">3月</option>
                <option value="4">4月</option>
                <option value="5">5月</option>
                <option value="6">6月</option>
                <option value="7">7月</option>
                <option value="8">8月</option>
                <option value="9">9月</option>
                <option value="10">10月</option>
                <option value="11">11月</option>
                <option value="12">12月</option>
              </select>
            
              <select name="day">
                <option value="1"selected>1日</option>
                <option value="2">2日</option>
                <option value="3">3日</option>
                <option value="4">4日</option>
                <option value="5" >5日</option>
                <option value="6">6日</option>
                <option value="7">7日</option>
                <option value="8">8日</option>
                <option value="9">9日</option>
                <option value="10">10日</option>
                <option value="11">11日</option>
                <option value="12">12日</option>
                <option value="13">13日</option>
                <option value="14">14日</option>
                <option value="15">15日</option>
                <option value="16">16日</option>
                <option value="17">17日</option>
                <option value="18">18日</option>
                <option value="19">19日</option>
                <option value="20">20日</option>
                <option value="21">21日</option>
                <option value="22">22日</option>
                <option value="23">23日</option>
                <option value="24">24日</option>
                <option value="25">25日</option>
                <option value="26">26日</option>
                <option value="27">27日</option>
                <option value="28">28日</option>
                <option value="29">29日</option>
                <option value="30">30日</option>
                <option value="31">31日</option>
              </select></p>
            
              <p>支払い頻度
                <select id="plans"name="flequency">
                <option value="-1"></option>
                  <?php foreach($plans as $plan) {?>
                    <option value="<?=$plan["PlanID"].",".$plan["Price"]?>"><?=$plan["date"]?>日</option>

                  <?php } ?>

                </select>
              </p>
              <p>支払い料金<input id="pay_price" type="text" value=""></p>
              <br>
              <p>無料期間終了予定日
              <select name="free_year">
              <option value="-1"selected></option>
                <option value="2025">2025年</option>
                <option value="2026" >2026年</option>
                <option value="2027">2027年</option>
                <option value="2028">2028年</option>

              </select>
            <select name="free_month">
                <option value="-1"selected></option>
                <option value="1">1月</option>
                <option value="2" >2月</option>
                <option value="3">3月</option>
                <option value="4">4月</option>
                <option value="5">5月</option>
                <option value="6">6月</option>
                <option value="7">7月</option>
                <option value="8">8月</option>
                <option value="9">9月</option>
                <option value="10">10月</option>
                <option value="11">11月</option>
                <option value="12">12月</option>
              </select>
            
              <select name="free_day">
                <option value="-1"selected></option>

                <option value="1">1日</option>
                <option value="2">2日</option>
                <option value="3">3日</option>
                <option value="4">4日</option>
                <option value="5" >5日</option>
                <option value="6">6日</option>
                <option value="7">7日</option>
                <option value="8">8日</option>
                <option value="9">9日</option>
                <option value="10">10日</option>
                <option value="11">11日</option>
                <option value="12">12日</option>
                <option value="13">13日</option>
                <option value="14">14日</option>
                <option value="15">15日</option>
                <option value="16">16日</option>
                <option value="17">17日</option>
                <option value="18">18日</option>
                <option value="19">19日</option>
                <option value="20">20日</option>
                <option value="21">21日</option>
                <option value="22">22日</option>
                <option value="23">23日</option>
                <option value="24">24日</option>
                <option value="25">25日</option>
                <option value="26">26日</option>
                <option value="27">27日</option>
                <option value="28">28日</option>
                <option value="29">29日</option>
                <option value="30">30日</option>
                <option value="31">31日</option>
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