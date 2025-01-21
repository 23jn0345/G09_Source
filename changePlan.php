<?php 
require_once 'DAO/subscDAO.php';
$subscDAO=new subscDAO();

$favorite = $_POST['favorite'];
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">

    <title>サブスク詳細</title>
    <link rel="stylesheet" href="css/changePlan.css">
    <link rel="stylesheet" href="css/header.css">
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


    <div class="result">
        <div class="content">
            <img src="netflix.png">
        </div>
        <h1>NETFLIX</h1>
        <div class="contract">
            <p>現在の契約</p>
            <ul>
                <li>月額890円</li>
                <li>無料期間0日</li>
            </ul>
        </div>
    </div>
    <div class="url">
        <p><a href="https://www.netflix.com/jp/">登録URL</a></p>
    </div>

    <br>
    <div class="detail">
    <form method="post" action="">
        <p><input type="checkbox" name="favorite" value="1">お気に入り</p>
</form>
        <p><button onclick="location.href='usingSubsc.html'">登録解除</button></p>
    </div>
    </div>
    <br>
    <p class="instruct">Netflixは、受賞歴のあるドラマ、映画、アニメ、ドキュメンタリーなどの
        幅広いコンテンツを配信するサービスで、メンバーはあらゆるインターネット接続デバイスで視聴することができます
        定額、低価格で、いつでもどこでも、好きなだけ視聴することができます。映画やドラマは毎週追加されるので、
        いつでも新しい作品が見つかります。</p>
    </div>
    <br>
    <div class="change">
        <h2>変更内容</h2>
        <div class="flex">
            <div class="content">
                <p>支払い間隔 <select name="year">
                        <option value="---円"></option>
                        <option value="---円"></option>
                        <option value="---円"></option>
                    </select></p>
                <p>金額
                    <input type="text" name="ID" size="50px" required class="text">
                </p>
            </div>
            <button onclick="location.href='usingSubsc.html'">変更内容を反映</button>
        </div>
    </div>
</body>

</html>