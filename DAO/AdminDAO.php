<?php require_once 'DAO.php';

class Member{
   
    public string $managerid;
   
    public string $password;
}
class MemberDAO{
    public function get_member(string $managerid,string $password){
        $dbh=DAO::get_db_connect();
        $sql="select * from administrator where managerid=:managerid";
    $stmt = $dbh->prepare($sql); 
    $stmt->bindValue(':managerid',$managerid,PDO::PARAM_STR);
    $stmt->execute(); 
$manager=$stmt->fetchObject('manager');
if($member!== false){
    if(password_verify($password,$manager->password)){
        return $manager;
    }
}
return false;
}


}