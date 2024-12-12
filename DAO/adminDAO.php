<?php require_once 'DAO.php';

class Member{
   
    public string $adminid;
   
    public string $password;
}
class MemberDAO{
    public function get_admin(string $adminid,string $password){
        $dbh=DAO::get_db_connect();
        $sql="select * from admin where adminid=:adminid";
    $stmt = $dbh->prepare($sql); 
    $stmt->bindValue(':adminid',$adminid,PDO::PARAM_STR);
    $stmt->execute(); 
$admin=$stmt->fetchObject('Admin');
if($admin!== false){
    if(password_verify($password,$admin->password)){
        return $admin;
    }
}
return false;
}


}