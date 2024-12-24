<?php
    require_once './DAO/manageSubscDAO.php';
    
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
<meta charset="utf-8">
   
        <title>サブスク管理</title>
<link rel="stylesheet" href="css/manageSubsc.css">
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
        <div class="title">
        <h1>サブスク管理</h1>
    </div>
            <button onclick="location.href='subscRegistration.html'" class="regi">新しいサブスクの登録</button><br>
          <p>検索 <input type="text" name="ID" size="50px"></p> 
            <br>
            <div class="result">
                <table border="1">
                  <tr>
                 <th rowspan="4" ><img src="netflix.png" ></th>
                    <th colspan="2">NETFLIX</th>
                    <th><button onclick="location.href='subscUpdate.html'">編集</button></th>
                </tr>
                <br>
               <tr>
                <th>支払い</th>
                <td>１か月毎,半年から選択</td>
               </tr>
               <tr>
                <th>料金</th>
                <td>400円,1000,</td>
               </tr>
               <tr>
                <th>ジャンル</th>
                <td>ジャンル２</td>
               </tr>
               <tr>
                <th rowspan="4" ><img src="unext.png" ></th>
                   <th colspan="2">U-NEXT</th>
                   <th><button onclick="location.href='subscUpdate.html'">編集</button></th>
               </tr>
               <br>
              <tr>
               <th>支払い</th>
               <td>１か月毎,半年から選択</td>
              </tr>
              <tr>
               <th>料金</th>
               <td>400円,1000,</td>
              </tr>
              <tr>
               <th>ジャンル</th>
               <td>ジャンル２</td>
              </tr>
              <tr>
                
              
               </table>
               </div>
    
       
        </body>
</html>