<?php require_once 'DAO.php';

class subsc{
    public  string $subName;
    public string $setumei;
    public string $aliasName;
    public string $shortName;
    public string $image;
    public string $URL;
}
class subscDAO { 
    public function get_subsc(string $subscName) {
       
        $dbh = DAO::get_db_connect();
        
         $sql = "SELECT subName,setumei,aliasName,shortName,image,URL FROM subsc WHERE SubName LIKE :subscName";
         $stmt = $dbh->prepare($sql); 
         $stmt->bindValue(':subscName','%'.$subscName.'%',PDO::PARAM_STR);
         $stmt->execute(); 
         $data = $stmt->fetchAll(); 
         return $data; 
         
}
}
    