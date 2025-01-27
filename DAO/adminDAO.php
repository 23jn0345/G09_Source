<?php require_once 'DAO.php';

#[\AllowDynamicProperties]
class Manager{
    public string $managerid;
    public string $password;
}
#[\AllowDynamicProperties]
class AdminDAO{
    public function get_admin(string $managerid,string $password){
        
        $dbh=DAO::get_db_connect();
        $sql= "SELECT * from administrator where managerid = :managerid";
        $stmt = $dbh->prepare($sql); 
        $stmt->bindValue(':managerid',$managerid,PDO::PARAM_STR);
        $stmt->execute(); 

        $manager = $stmt->fetchObject('Manager');
        if($manager!== false){
            return $manager;
        }
        else{
            return false;
        }
        
    }


}