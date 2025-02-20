<?php 
    require_once 'DAO/subscDAO.php';
    require_once 'DAO/usingSubscDAO.php';
session_start();    
$subscDAO=new subscDAO();
$usingSubscDAO=new usingSubscDAO();

$isFavorite =false;

if(empty($_SESSION['member'])){
    header('Location:login.php');
    exit;
  }else{
    $userID = (int)$_SESSION['member']->ID;
  }
if(isset($_POST['del_contract'])){
    $usingSubscDAO->delete($userID ,$_GET['subID']);
    header('Location:usingSubsc.php');
    exit;
}
if(isset($_GET['subID'])){
    $subsc=$subscDAO->get_Plans_and_subsc($userID,$_GET['subID']);
    $isFavorite = $subscDAO->is_favorite($userID,$_GET['subID']);
    $plans=$subscDAO->get_Plans_by_subID($_GET['subID']);
}

//test
//$subsc=$subscDAO->get_subsc('20002');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">

    <title>サブスク詳細</title>
    <link rel="stylesheet" href="css/changePlan.css">
    <link rel="stylesheet" href="css/header.css">
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .result {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .content img {
            max-width: 200px;
            height: auto;
        }
        
        .contract {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        
        .contract ul {
            list-style: none;
            padding: 0;
        }
        
        .contract li {
            margin: 10px 0;
        }
        
        .url a {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        
        .detail {
            margin: 20px 0;
        }
        
        .change {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }
        
        .flex {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        
        select, input[type="text"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 200px;
        }
        
        button {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        button:hover {
            background: #218838;
        }

        .action-row {
    display: flex;
    align-items: center;
    gap: 20px;  /* チェックボックスとボタンの間隔 */
    margin: 20px 0;
    }

        .favorite-checkbox {
            margin: 0;  /* 以前のマージンを削除 */
        }

        .cancel-button {
        display: inline-block;
        padding: 8px 20px;
        background: #f0f0f0;
        color: black;
        text-decoration: none;
        border-radius: 5px;
        text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <h1>サブスル</h1>
        <nav>
            <ul>
                <li><a href="home.html">家計簿閲覧</a></li>
                <li><a href="subscSearch.html">サブスク検索</a></li>
                <li><a href="usingSubsc.html">利用中のサブスク</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="result">
            <div class="content">
                <img src="<?="./images/".$subsc[0]["image"]  ?>" alt="サブスクリプションイメージ">
            </div>
            <div>
                <h1><?=$subsc[0]["SubName"] ?></h1>
                <div class="contract">
                    <h2>現在の契約</h2>
                    <ul>
                        <li>支払い間隔: <?=$subsc[0]['date'] ?>日</li>
                        <li>料金: <?=$subsc[0]['Price'] ?>円</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="url">
            <a href="<?=$subsc[0]['URL']  ?>">契約変更URL(公式)</a>
        </div>

        <div class="action-row">
            <label class="favorite-checkbox">
                <input type="checkbox" id="favorite" <?= $isFavorite ? 'checked' : ''?> value="<?= $_GET['subID'] ?>">
                お気に入り
            </label>
            <button onclick="location.href='updateContract.php?subID=<?php echo urlencode($_GET['subID']); ?>'">サブスル登録変更</button>
             
        </div>

        <p class="instruct"><?=$subsc[0][2]  ?></p>


            <form method="POST" action="">

                <button name="del_contract" value="1" type="submit">サブスル登録解除</a>

            </form>
        
    </div>
    <script src="js/checkbox_favorite.js" ></script>
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