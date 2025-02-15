<?php 
require_once 'DAO/MemberDAO.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name=$_POST['name'];
    $password=$_POST['password'];
    $year=$_POST['year'];
    $month=$_POST['month'];
    $day=$_POST['day']; 
    $birthday=$year."/".$month."/".$day;
    $gender=$_POST['gender'];
    

    $memberDAO=new MemberDAO();
    
    if(!preg_match('/\A.{4,}\z/',$password)){
        $errs['password']='パスワードは４文字以上で入力してください';
    }
    if($name===""){
        $errs['name']='IDを入力してください';
    }elseif($memberDAO->id_exists($name)){
        $errs['name']='このIDは既に使われています';
    }
    if($gender===""){
        $errs['gender']='性別を選択してください';
    }
    if($year===""){
        $errs['year']='生年を入力してください';
    }
    if($month===""){
        $errs['month']='生月を入力してください';
    }
    if($day===""){
        $errs['day']='生日を入力してください';
    }
if(empty($errs)){


    $member=new Member();
    $member->name=$name;
    $member->password=$password;
    $member->birthday=$birthday;
    $member->gender=$gender;
    

    $memberDAO->insert($member);
    header('Location:login.php');
    exit;
}

}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
<meta charset="utf-8">
   
        <title>新規登録</title>
<link rel="stylesheet" href="css/newRegi.css">
    </head>
    <body>
        <h1>新規会員登録</h1>
        <form action="" method="POST">
        <p>ユーザーID<br>
            <input type="text" required autofocus name="name" size="50px" class="text" value="<?= @$name ?>"></p>
            <span style="color:red"><?= @$errs['name'] ?></span>
        <p>パスワード（4文字以上）<br>
        <input type="text" name="password" size="50px" required class="text" value="<?= @$password ?>">
        <span style="color:red"><?= @$errs['password'] ?></span>
        </p>
       
            <p>性別
            <input type="radio" name="gender" value="1" />
            <label for="male">男性</label>
            <input type="radio" name="gender" value="0" />
            <label for="female">女性</label>
        </p>

            <p>生年月日
            <select name="year">
                <option value="1941">1941</option>
                <option value="1942">1942</option>
                <option value="1943">1943</option>
                <option value="1944">1944</option>
                <option value="1945">1945</option>
                <option value="1946">1946</option>
                <option value="1947">1947</option>
                <option value="1948">1948</option>
                <option value="1949">1949</option>
                <option value="1950">1950</option>
                <option value="1951">1951</option>
                <option value="1952">1952</option>
                <option value="1953">1953</option>
                <option value="1954">1954</option>
                <option value="1955">1955</option>
                <option value="1956">1956</option>
                <option value="1957">1957</option>
                <option value="1958">1958</option>
                <option value="1959">1959</option>
                <option value="1960">1960</option>
                <option value="1961">1961</option>
                <option value="1962">1962</option>
                <option value="1963">1963</option>
                <option value="1964">1964</option>
                <option value="1965">1965</option>
                <option value="1966">1966</option>
                <option value="1967">1967</option>
                <option value="1968">1968</option>
                <option value="1969">1969</option>
                <option value="1970">1970</option>
                <option value="1971">1971</option>
                <option value="1972">1972</option>
                <option value="1973">1973</option>
                <option value="1974">1974</option>
                <option value="1975">1975</option>
                <option value="1976">1976</option>
                <option value="1977">1977</option>
                <option value="1978">1978</option>
                <option value="1979">1979</option>
                <option value="1980">1980</option>
                <option value="1981">1981</option>
                <option value="1982">1982</option>
                <option value="1983">1983</option>
                <option value="1984">1984</option>
                <option value="1985">1985</option>
                <option value="1986">1986</option>
                <option value="1987">1987</option>
                <option value="1988">1988</option>
                <option value="1989">1989</option>
                <option value="1990">1990</option>
                <option value="1991">1991</option>
                <option value="1992">1992</option>
                <option value="1993" selected>1993</option>
                <option value="1994">1994</option>
                <option value="1995">1995</option>
                <option value="1996">1996</option>
                <option value="1997">1997</option>
                <option value="1998">1998</option>
                <option value="1999">1999</option>
                <option value="2000">2000</option>
                <option value="2001">2001</option>
                <option value="2001">2002</option>
                <option value="2001">2003</option>
                <option value="2001">2004</option>
                <option value="2001">2005</option>
                <option value="2001">2006</option>
                <option value="2001">2007</option>
              </select>年<span style="color:red"><?= @$errs['year'] ?></span>
              <select name="month">
                <option value="1">1</option>
                <option value="2" selected>2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>月<span style="color:red"><?= @$errs['month'] ?></span>
              <select name="day">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5" selected>5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
              </select>日<span style="color:red"><?= @$errs['day'] ?></span></p><br><br>
<input type="submit" value="登録" class="button">
            </form>
 
           
            <br>
            <p>既に登録済みの方は<a href="login.php">ログイン</a> </p>
       
        </body>
</html>