<?php 
require_once 'DAO/MemberDAO.php';
require_once 'DAO/usingSubscDAO.php';
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
var_dump($using_list);
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
            </div>
        </div>
        <table class="amount" border="1">
            <tr>
                <th>2024年10月</th>
                <th>2024年11月</th>
            </tr>
            <tr>
                <td>3000円</td>
                <td>3000円</td>
            </tr>
        </table>
   
    

    <div class="border">
        <h1>通知一覧</h1>
        <ul>
            <li></li>
            <li> </li>
            <li> </li>
        </ul>


    </div>
    <input type="hidden" name="id" value="<?= $member->ID?>" id="memberID">
    <script src="js/calendar.js" type="text/javascript"></script>
    
</body>

</html>