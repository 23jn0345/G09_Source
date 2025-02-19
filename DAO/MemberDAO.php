<?php require_once 'DAO.php';
#[\AllowDynamicProperties]
class Member{
   
    public int $id;
    public string $name;
    public string $password;
    public string $birthday;
    public string $gender;
}
#[\AllowDynamicProperties]
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
    $stmt->bindValue(':birthday',$member->birthday,PDO::PARAM_STR);
    $stmt->bindValue(':gender',$member->gender,PDO::PARAM_STR);
    
    $stmt->execute(); 
}
public function id_exists(string $name){
    $dbh = DAO::get_db_connect(); 
    $sql = "SELECT * from member where name=:name"; 
    $stmt = $dbh->prepare($sql); 
    $stmt->bindValue(':name',$name,PDO::PARAM_STR);
   
    $stmt->execute();
    if($stmt->fetch() !== false){
        return true;
    }else{
        return false;
    }
}
}