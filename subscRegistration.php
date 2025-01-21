<?php

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
   
    <img src="netflix.png"><br>

    <form>
        <div class="name">
            <p>サブスク名<br>
                <input type="text" name="ID" size="50px">
            </p>
            <p>略称<br>
                <input type="text" name="password" size="50px">
            </p>
            <p>別名<br>
                <input type="text" name="password" size="50px">
            </p>
            <br>
        </div>
        <div class="category">
            <input type="checkbox" id="cate" name="1" checked />
            <label for="cate">動画配信</label>
            <input type="checkbox" id="cate" name="2" />
            <label for="cate">音楽配信</label>
            <input type="checkbox" id="cate" name="3" />
            <label for="cate">書籍</label>
            <input type="checkbox" id="cate" name="4" />
            <label for="cate">食品</label>
        </div>
        <br>
        <div class="payterm">
            <p>支払い１
                <select name="pay1">
                    <option value="1m" selected>１カ月</option>
                    <option value="harf">半年</option>
                    <option value="1y">１年</option>
                </select>
                料金１
                <select name="amount1">
                    <option value="500" selected>500</option>
                    <option value="3000">3000</option>
                    <option value="6000">6000</option>
                </select>
                無料期間
                <select name="free1">
                    <option value="1w" selected>１週間</option>
                    <option value="1m">１カ月</option>
                    <option value="3m">３カ月</option>

                </select>
            </p>
            <br>
            <p>支払い2
                <select name="pay2">
                    <option value="1m">１カ月</option>
                    <option value="harf">半年</option>
                    <option value="1y">１年</option>
                </select>
                料金2
                <select name="amount2">
                    <option value="500">500</option>
                    <option value="3000">3000</option>
                    <option value="6000">6000</option>
                </select>
                無料期間
                <select name="free2">
                    <option value="1w">１週間</option>
                    <option value="1m">１カ月</option>
                    <option value="3m">３カ月</option>

                </select>
            </p>
            <br>
            <p>支払い3
                <select name="pay3">
                    <option value="1m">１カ月</option>
                    <option value="harf">半年</option>
                    <option value="1y">１年</option>
                </select>
                料金3
                <select name="amount3">
                    <option value="500">500</option>
                    <option value="3000">3000</option>
                    <option value="6000">6000</option>
                </select>
                無料期間
                <select name="free3">
                    <option value="1w">１週間</option>
                    <option value="1m">１カ月</option>
                    <option value="3m">３カ月</option>

                </select>
            </p>
            <br>
        </div>

        <br>
        <p class="text">説明　　　　　<input type="text" class="detail" size="55px" required></p>
        <p>公式サイトURL<input type="text" size="55px" required></p>
        <br>
    </form>
    <button onclick="location.href='regiConfirmation.html'">確認画面へ</button>





</body>

</html>