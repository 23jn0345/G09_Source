<?php require_once 'DAO.php';

class Member{
   
    
   public  string $name;
    public string $password;
    public string $birthday;
    public string $gender;
}
class MemberDAO{
    public function get_member(string $name,string $password){
        $dbh=DAO::get_db_connect();
        $sql="select * from member where name=:name";
    $stmt = $dbh->prepare($sql); 
    $stmt->bindValue(':name',$name,PDO::PARAM_STR);
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
    $sql="insert into Member (name,password,birthday,gender)
    values(:name,:password,:birthday,:gender)";
    $stmt = $dbh->prepare($sql); 

  $password=password_hash($member->password,PASSWORD_DEFAULT);

    
    $stmt->bindValue(':name',$member->name,PDO::PARAM_STR);
    $stmt->bindValue(':password',$password,PDO::PARAM_STR);
    $stmt->bindValue(':birthday',$birthday,PDO::PARAM_STR);
    $stmt->bindValue(':gender',$gender,PDO::PARAM_STR);
    
    $stmt->execute(); 
}

}