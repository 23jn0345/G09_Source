<?php

session_start();

if(empty($_SESSION['member'])){
  header('Location:login.php');
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
        <form>
        <h1>契約したサービスを入力してください</h1>
        <div class="name">
        <select name="usingSubsc" >
            <option value="subsc">NETFLIX</option>
            <option value="subsc">U-NEXT</option>
            <option value="subsc">Spotify</option>
            <option value="subsc">AppleMusic</option>
        </select>
      </div>
        <p>次回支払日
            <select name="month">
                <option value="1">1月</option>
                <option value="2" selected>2月</option>
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
                <option value="1">1日</option>
                <option value="2">2日</option>
                <option value="3">3日</option>
                <option value="4">4日</option>
                <option value="5" selected>5日</option>
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
                <select name="flequency">
                    <option value="1m">一か月</option>
                    <option value="hy">半年</option>
                    <option value="1y">一年</option>
                </select>
              </p>
              <p>支払い料金<input type="text" value="1000円"></p>
              <br>
              <p>無料期間終了予定日</p>
              <div class="calendar-wrap">
                <table class="calendar">
                  <thead>
                    <tr>
                      <th class="sun">Sun</th>
                      <th>Mon</th>
                      <th>Tue</th>
                      <th>Wed</th>
                      <th>Thu</th>
                      <th>Fri</th>
                      <th class="sat">Sat</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="mute">29</td>
                      <td class="mute">30</td>
                      <td>1</td>
                      <td>2</td>
                      <td>3</td>
                      <td>4</td>
                      <td>5</td>
                    </tr>
                    <tr>
                      <td>6</td>
                      <td class="off">7</td>
                      <td>8</td>
                      <td>9</td>
                      <td>10</td>
                      <td>11</td>
                      <td>12</td>
                    </tr>
                    <tr>
                      <td class="today">13</td>
                      <td class="off">14</td>
                      <td>15</td>
                      <td>16</td>
                      <td>17</td>
                      <td>18</td>
                      <td>19</td>
                    </tr>
                    <tr>
                      <td>20</td>
                      <td class="off">21</td>
                      <td>22</td>
                      <td>23</td>
                      <td>24</td>
                      <td>25</td>
                      <td>26</td>
                    </tr>
                    <tr>
                      <td>27</td>
                      <td class="off">28</td>
                      <td>29</td>
                      <td>30</td>
                      <td>31</td>
                      <td class="mute">1</td>
                      <td class="mute">2</td>
                    </tr>
                  </tbody>
                </table>
                
              </div>
              <br>
              </form>
              <button onclick="location.href='usingSubsc.html'">内容を確定</button><br>
              <button onclick="location.href='subscDetail.html'">サブスク詳細画面に戻る</button><br>
          

       
       
        </body>
</html>