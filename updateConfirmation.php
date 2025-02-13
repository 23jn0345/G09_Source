<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">

    <title>サブスク詳細更新確認</title>
    <link rel="stylesheet" href="css/updateConfirmation.css">
    <link rel="stylesheet" href="css/adminiHeader.css">
</head>

<body>
    <header>
        <h1>サブスル管理</h1>
        <nav>
            <ul>
                <li><a href="manageUser.html">利用者管理</a></li>
                <li><a href="manageSubsc.html">サブスク管理</a></li>

            </ul>
        </nav>

    </header>
    <div class="title">サブスク更新確認</div>

    <div class="form">
        <span class="befor">
            <div class="image">
                <img src="netflix.png"><br>
            </div>



            <div class="name">
                <p>サブスク名<br>
                    <input type="text" name="ID" size="55px" value="NETFLIX" disabled>
                </p>
                <p>略称<br>
                    <input type="text" name="password" size="55px" value="ネトフリ" disabled>
                </p>
                <p>別名<br>
                    <input type="text" name="password" size="55px" disabled value="ネットフリックス">
                </p>
            </div>
            <div class="category">
                <input type="checkbox" id="cate" name="1" disabled checked />
                <label for="cate">動画配信</label>
                <input type="checkbox" id="cate" name="2" disabled />
                <label for="cate">音楽配信</label>
                <input type="checkbox" id="cate" name="3" disabled />
                <label for="cate">書籍</label>
                <input type="checkbox" id="cate" name="4" disabled />
                <label for="cate">食品</label>
            </div>
            <br>
            <div class="payterm">
                <p>支払い１
                    <select name="pay1" disabled>
                        <option value="1m">１カ月</option>
                        <option value="harf">半年</option>
                        <option value="1y">１年</option>
                    </select>
                    料金１
                    <select name="amount" disabled>
                        <option value="500">500</option>
                        <option value="3000">3000</option>
                        <option value="6000">6000</option>
                    </select>
                    無料期間
                    <select name="free" disabled>
                        <option value="1w">１週間</option>
                        <option value="1m">１カ月</option>
                        <option value="3m">３カ月</option>

                    </select>
                </p>
                <br>
                <p>支払い2
                    <select name="pay1" disabled>
                        <option value="1m">１カ月</option>
                        <option value="harf">半年</option>
                        <option value="1y">１年</option>
                    </select>
                    料金2
                    <select name="amount" disabled>
                        <option value="500">500</option>
                        <option value="3000">3000</option>
                        <option value="6000">6000</option>
                    </select>
                    無料期間
                    <select name="free" disabled>
                        <option value="1w">１週間</option>
                        <option value="1m">１カ月</option>
                        <option value="3m">３カ月</option>

                    </select>
                </p>
                <br>
                <p>支払い3
                    <select name="pay1" disabled>
                        <option value="1m">１カ月</option>
                        <option value="harf">半年</option>
                        <option value="1y">１年</option>
                    </select>
                    料金3
                    <select name="amount" disabled>
                        <option value="500">500</option>
                        <option value="3000">3000</option>
                        <option value="6000">6000</option>
                    </select>
                    無料期間
                    <select name="free" disabled>
                        <option value="1w">１週間</option>
                        <option value="1m">１カ月</option>
                        <option value="3m">３カ月</option>

                    </select>
                </p>
                <br>
            </div>
            <p class="text">説明　　　　　<input type="text" class="detail" size="55px" disabled></p>
            <p>公式サイトURL<input type="text" size="55px" disabled></p>


        </span>

        <div class="block"> →</div>


        <span class="after">
            <div class="image">
                <img src="unext.png"><br>
            </div>



            <div class="name">
                <p>サブスク名<br>
                    <input type="text" name="ID" size="55px" disabled value="U-NEXT">
                </p>
                <p>略称<br>
                    <input type="text" name="password" size="55px" disabled value="UNEXT">
                </p>
                <p>別名<br>
                    <input type="text" name="password" size="55px" disabled value="ユーネクスト">
                </p>
            </div>
            <div class="category">

                <input type="radio" id="j1" name="j1" value="j1" disabled checked />
                <label for="j1">ジャンル1</label>

                <input type="radio" id="j2" name="j2" value="j2" disabled />
                <label for="j2">ジャンル2</label>

                <input type="radio" id="j3" name="j3" value="j3" disabled />
                <label for="j3">ジャンル3</label>

                <input type="radio" id="j4" name="j4" value="j4" disabled />
                <label for="j4">ジャンル4</label>
            </div>
            <br>
            <div class="payterm">
                <p>支払い１
                    <select name="pay1" disabled>
                        <option value="1m">１カ月</option>
                        <option value="harf">半年</option>
                        <option value="1y">１年</option>
                    </select>
                    料金１
                    <select name="amount" disabled>
                        <option value="500">500</option>
                        <option value="3000">3000</option>
                        <option value="6000">6000</option>
                    </select>
                    無料期間
                    <select name="free" disabled>
                        <option value="1w">１週間</option>
                        <option value="1m">１カ月</option>
                        <option value="3m">３カ月</option>

                    </select>
                </p>
                <br>
                <p>支払い2
                    <select name="pay1" disabled>
                        <option value="1m">１カ月</option>
                        <option value="harf">半年</option>
                        <option value="1y">１年</option>
                    </select>
                    料金2
                    <select name="amount" disabled>
                        <option value="500">500</option>
                        <option value="3000">3000</option>
                        <option value="6000">6000</option>
                    </select>
                    無料期間
                    <select name="free" disabled>
                        <option value="1w">１週間</option>
                        <option value="1m">１カ月</option>
                        <option value="3m">３カ月</option>

                    </select>
                </p>
                <br>
                <p>支払い3
                    <select name="pay1" disabled>
                        <option value="1m">１カ月</option>
                        <option value="harf">半年</option>
                        <option value="1y">１年</option>
                    </select>
                    料金3
                    <select name="amount" disabled>
                        <option value="500">500</option>
                        <option value="3000">3000</option>
                        <option value="6000">6000</option>
                    </select>
                    無料期間
                    <select name="free" disabled>
                        <option value="1w">１週間</option>
                        <option value="1m">１カ月</option>
                        <option value="3m">３カ月</option>

                    </select>
                </p>
                <br>
            </div>
            <p class="text">説明　　　　　<input type="text" class="detail" size="55px" disabled></p>
            <p>公式サイトURL<input type="text" size="55px" disabled></p>
            <br>
        </span>
    </div>
    <div class="btn"></div>
    <button onclick="location.href='subscUpdate.html'">修正</button>
    <br>
    <button onclick="location.href='manageSubsc.html'">更新</button>
    </div>
    </div>
</body>

</html>