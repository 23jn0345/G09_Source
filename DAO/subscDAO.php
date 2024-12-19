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
   /* public function get_subsc() {
       
        $dbh = DAO::get_db_connect();
        
         $sql = "SELECT subName,setumei,aliasName,shortName,image,URL FROM subsc WHERE subscName=:subscName";
         $stmt = $dbh->prepare($sql); 
         $stmt->execute(); 
         $data = []; 
         while($row = $stmt->fetchObject('subsc')) {
            $data[] = $row;
            } 
            return $data; 
           } 
        } 