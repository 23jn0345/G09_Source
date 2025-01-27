<?php
    require_once './DAO/manageUserDAO.php';

    if(session_status()===PHP_SESSION_NONE){
      session_start();
  }
  if(!empty($_SESSION['manager'])){
      $manager=$_SESSION['manager'];
  }

    $userDAO = new userDAO();
    $user_list = $userDAO->get_user();

    if(isset($_GET['keyword']) && $_GET['keyword'] !== ''){
      $keyword = $_GET['keyword'];
      $user_list = $userDAO->get_user_by_keyword($keyword);
    }

?>

<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="utf-8">
    <title>利用者管理</title>
    <link rel="stylesheet" href="css/manageUser.css">
    
  </head>

  <body>
    <?php include "adminHeader.php"; ?>
            
    <div class="title">
      <h1>利用者管理</h1>
    </div>
      <form action="manageuser.php?keyword" method="GET">
        <p class="search">  検索 <input type="text" name="keyword"> 
        <input type="submit" value="検索">
      </form> 
        <h2>利用者一覧　　　　
          <?php if(isset($keyword) && $keyword !== '') : ?>
              検索結果 : <?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') ?>
          <?php endif;?></h2>
          
        <div class="user">
          <table border="1">
            <thead>
              <tr>
                <th scope="col">ID</a></th>
                <th scope="col">ユーザー名</a></th>
                <th scope="col">生年月日</th>
                <th scope="col">性別</th>
                <th scope="col">登録サブスク数</th>
              </tr>
            </thead>
            
            <?php foreach($user_list as $user) : ?>
              <tbody>
                <tr>
                  <td scope="row"><?= $user->id ?></td>
                  <td scope="row"><?= $user->name ?></td>
                  <td><?= $user->BirthDay ?></td>
                  <td><?php if($user->gender == 0) : ?>
                        男 
                      <?php else: ?>
                        女
                      <?php endif;?>
                  </td>
                  <td><?= $user->subCount ?></td>
                  <td><a href="userDetail.php?id=<?= $user->id ?>">利用者詳細</td>
                </tr>
              </tbody>
            <?php endforeach ?>
          </table>
        </div>
          <br>
        
  </body>
</html>