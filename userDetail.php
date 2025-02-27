<?php
    require_once './DAO/userDetailDAO.php';
    
    
        
        $errs = "";
        $id_count[] = $_GET['id'];
        $userDetailDAO = new userDetailDAO();
        $id = (int)$id_count[0][0];
        $subCount = (int)$id_count[0][1];
        
        
        
        if($subCount == 0){
            $userDetail = $userDetailDAO->get_non_subsc_user($id);
            $errs ="なし";
            
        }elseif($subCount !=0){
            $userDetail = $userDetailDAO->get_user($id);
            $useSubsc_list = $userDetailDAO->get_use_subsc($id);
        }
        
        if(isset($_POST['delete'])){
            $userDetailDAO->delete_user($id);
            header('Location:manageUser.php');
        }
    

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>利用者詳細</title>
<link rel="stylesheet" href="css/userDetail.css">
</head>

<body>
    <?php include "adminHeader.php"; ?>
        <div class="title">
        
            <h1>利用者詳細</h1>
        </div>
            
        <br>
    
        <div class="user">
        <table border="1">
        
        
            <tr>
                <th scope="col">ID</th>
                <th scope="col">名前
                <th scope="col">生年月日</th> 
                <th scope="col">性別</th> 
                <th scope="col">登録サブスク</th>
            </tr>
            <tr>
                <td scope="row"><?= $userDetail->id ?></td>
                <td scope="row"><?= $userDetail->name ?></td>
                <td scope="row"><?= $userDetail->BirthDay ?></td>
                <td><?php if($userDetail->gender == 0) : ?>
                        男 
                    <?php else: ?>
                        女
                    <?php endif;?>
                </td>
                <td>
                    <?php if($errs =="なし"): ?>
                        <?= $errs ?>
                        
                    <?php elseif($errs ==""): ?>
                        <?php foreach($useSubsc_list as $useSubsc) : ?>
                                <?= $useSubsc->subName ?><br>
                        <?php endforeach ?>
                    <?php endif ?>
                </td>
            </tr>
        </table>
        <br>
        <form method = "POST" action ="">
            <button type="submit" name="delete">削除</button>
        </form>
    </body>
</html>