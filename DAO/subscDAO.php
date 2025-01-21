<?php 
require_once 'DAO.php';
require_once 'memberDAO.php';
$memberDAO= new memberDAO();
class subsc{
    public  string $subName;
    public string $setumei;
    public string $aliasName;
    public string $shortName;
    public string $image;
    public string $URL;
    
}
class subscDAO { 
    public function search_subsc_by_name(string $subscName) {
       
        $dbh = DAO::get_db_connect();
        
         $sql = "SELECT subName,setumei,aliasName,shortName,image,URL FROM subsc WHERE SubName LIKE :subscName";
         $stmt = $dbh->prepare($sql); 
         $stmt->bindValue(':subscName','%'.$subscName.'%',PDO::PARAM_STR);
         $stmt->execute(); 
         $data = $stmt->fetchAll(); 
         return $data; 
         
}
public function add_favorite(){
    $dbh = DAO::get_db_connect();
    $sql="INSERT INTO favorite (ID, subID) VALUES (:ID, :subID)";
    $stmt = $dbh->prepare($sql); 
    $stmt->bindValue(':ID',$ID,PDO::PARAM_STR);
    //作成中
}
public function get_subsc(){
    $dbh = DAO::get_db_connect();
    $sql="SELECT subname,image,genreName,price,interval.kikanName,interval.date,freetime.kikanName,freetime.date as freedate
	            FROM subsc 
		        LEFT OUTER JOIN genre ON subsc.GenreID = genre.GenreID
			    LEFT OUTER JOIN subscplan ON subsc.SubID = subscplan.subID
				LEFT OUTER JOIN kikan as freetime ON subscplan.FreeTimeID = freetime.KikanID
				LEFT OUTER JOIN kikan as interval ON subscplan.IntervalID = interval.KikanID";
     $stmt = $dbh->prepare($sql); 
     $stmt->execute(); 
     $data = $stmt->fetchAll(); 
     return $data; 
}
}
    