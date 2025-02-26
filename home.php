<?php 
require_once 'DAO/MemberDAO.php';
require_once 'DAO/usingSubscDAO.php';
require_once 'DAO/PaymentDAO.php';
if(session_status()===PHP_SESSION_NONE){
    session_start();
}
if(!empty($_SESSION['member'])){
    $member=$_SESSION['member'];
}
else{
    header('Location:login.php');
    exit;
}
$usingsubscDAO =new usingSubscDAO();
$using_list=$usingsubscDAO->get_using_by_id_home($member->ID);
$today = date("Y-m-d"); 
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>家計簿閲覧</title>
    <link rel="stylesheet" href="css/calendar.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <header>
        <h1>サブスル</h1>
        <nav>
            <ul>
                <li><a href="home.php">家計簿閲覧</a></li>
                <li><a href="subscSearch.php">サブスク検索</a></li>
                <li><a href="usingSubsc.php">利用中のサブスク</a></li>
            
           <li> <?php if(isset($member)) : ?>
            <?= $member->Name ?>さん
            <a href="logout.php">ログアウト</a>
           
            <?php else: ?>
        <a href="login.php" class="login">ログイン</a>
        <?php endif; ?>
            </li>
        </ul>
        </nav>
    </header>
    
        <div class="container-calendar">
            <h4 id="monthAndYear"></h4>
            <div class="button-container-calendar">
                <button id="previous" onclick="previous()">‹</button>
                <button id="next" onclick="next()">›</button>
            </div>
    
            <table class="table-calendar" id="calendar" data-lang="ja">
                <thead id="thead-month"></thead>
                <tbody id="calendar-body"></tbody>
            </table>
    
            <div class="footer-container-calendar">
                <label for="month">日付指定：</label>
                <select id="month" onchange="jump()">
                    <option value=0>1月</option>
                    <option value=1>2月</option>
                    <option value=2>3月</option>
                    <option value=3>4月</option>
                    <option value=4>5月</option>
                    <option value=5>6月</option>
                    <option value=6>7月</option>
                    <option value=7>8月</option>
                    <option value=8>9月</option>
                    <option value=9>10月</option>
                    <option value=10>11月</option>
                    <option value=11>12月</option>
                </select>
                <select id="year" onchange="jump()"></select>
                <p>🟥今日の日付</p>
                <p>🟦無料期間終了日</p>
                <p>🟨次回支払い日</p>
            </div>
        </div>
        <table class="amount" border="1">
            <?php
            try {
                // PaymentDAOのインスタンス化
                $paymentDAO = new PaymentDAO();
                
                // 現在の年月とユーザーID取得
                $currentYear = date('Y');
                $currentMonth = date('m', strtotime(date('Y-m-01').'+1 month'));//翌月月初を支払いの最終日とする
                $userID = $_SESSION['member']->ID;

                
                $nextMonth = date('m', strtotime(date('Y-m-01').'+2 month'));//来月分の処理
                // 支払い情報の計算



                $result = $paymentDAO->calculate_MonthlyPayments($userID, $currentYear, $currentMonth);
                $monthlyTotal = $result['total'];
                $paymentDetails = $result['details'];
                $nextresult = $paymentDAO->calculate_MonthlyPayments($userID, $currentYear, $nextMonth);
                $nextmonthlyTotal = $nextresult['total'];
                $nextpaymentDetails = $nextresult['details'];

            ?>
   

            <?php
            } catch (Exception $e) {
                echo "<p>エラーが発生しました。管理者にお問い合わせください。 $e</p>";
            }
            ?>
            
            <tr>
                <th><?php echo $currentYear; ?>年<?php echo $currentMonth - 1; ?>月</th>
                <th><?php echo $currentYear; ?>年<?php echo $nextMonth - 1; ?>月</th>
            </tr>
            <tr>
                <td><?php echo number_format($monthlyTotal); ?>円</td>
                <td><?php echo number_format($nextmonthlyTotal); ?>円</td>
            </tr>
            
        </table>
   
        

    <div class="border">
        <h1>通知一覧</h1>
        <ul>
            <?php for($i = 0; $i < count($using_list); $i++){?>
                <?php if($using_list[$i]->endfree !== null){?>
                    <?php if(strtotime($using_list[$i]->endfree) > strtotime($today)){?>
                        <li><?= $using_list[$i]->endfree ?>に<?= $using_list[$i]->subName ?>の無料期間が終了します。</li>
                    <?php } ?>                   
                <?php } ?>
                <li><?= $using_list[$i]->nextpay ?>に<?= $using_list[$i]->subName ?>の支払いがあります。</li> 
            <?php } ?>        
        </ul>


    </div>
    <input type="hidden" name="id" value="<?= $member->ID?>" id="memberID">
    <script src="js/calendar.js" type="text/javascript"></script>
    
</body>

</html>