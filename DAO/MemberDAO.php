<?php require_once 'DAO.php';

class Member{
   
    public int $memberid;
   public  string $name;
    public string $password;
    public string $birthday;
    public int $sex;
}
class MemberDAO{
    public function get_member(int $memberid,string $password){
        $dbh=DAO::get_db_connect();
        $sql="select * from member where ID=:memberid";
    $stmt = $dbh->prepare($sql); 
    $stmt->bindValue(':memberid',$memberid,PDO::PARAM_INT);
    $stmt->execute(); 
$member=$stmt->fetchObject('Member');
if($member!== false){
    if(password_verify($password,$member->password)){
        return $member;
    }
}
return false;
}
public function insert(Member $member){
    $dbh=DAO::get_db_connect();
    $sql="insert into Member (memberid,password)
    values(:memberid,:password)";
    $stmt = $dbh->prepare($sql); 

  $password=password_hash($member->password,PASSWORD_DEFAULT);

    
    $stmt->bindValue(':memberid',$member->memberid,PDO::PARAM_INT);
    $stmt->bindValue(':password',$password,PDO::PARAM_STR);
    
    $stmt->execute(); 
}

}