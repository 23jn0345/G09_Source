<?php
    require_once './DAO/manageUserDAO.php';

    $userDAO = new userDAO();
    $user_list = $userDAO->get_user();

    if(isset($_GET['ID'])){
        $Id = $_GET['ID'];
        $Id = $userDAO->get_member_by_ID($id);
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
      <form>
        <p class="search">  検索 <input type="text" name="Search">     
        <br>
        <h2>利用者一覧</h2>
        <div class="user">
          <table border="1">
            <thead>
              <tr>
                <th scope="col">ID</a></th>
                <th scope="col">生年月日</th>
                <th scope="col">性別</th>
                <th scope="col">登録サブスク数</th>
              </tr>
            </thead>
            <br>
            <?php foreach($user_list as $user) : ?>
              <tbody>
                <tr>
                  <td scope="row"><?= $user->id ?></td>
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
              <br>
            <?php endforeach ?>
          </table>
        </div>
          <br>
      </form>
        
  </body>
</html>