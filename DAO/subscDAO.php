<?php 
require_once 'DAO.php';
require_once 'memberDAO.php';
$memberDAO= new memberDAO();
#[\AllowDynamicProperties]
class subsc{
    public  string $subName;
    public string $setumei;
    public string $aliasName;
    public string $shortName;
    public string $image;
    public string $URL;
    
}
#[\AllowDynamicProperties]
class subscDAO { 
    public function search_subsc(string $subName) {
       
        $dbh = DAO::get_db_connect();
        
         $sql = "SELECT subName,setumei,aliasName,shortName,image,URL FROM subsc WHERE SubName LIKE :subscName";
         $stmt = $dbh->prepare($sql); 
         $stmt->bindValue(':subscName','%'.$subName.'%',PDO::PARAM_STR);
         $stmt->execute(); 
         $data = $stmt->fetchAll(); 
         return $data; 
         
}
public function add_favorite(){
    $dbh = DAO::get_db_connect();
    $sql="INSERT INTO favorite (ID, subID) VALUES (:ID, :subID)";
    $stmt = $dbh->prepare($sql); 
    $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
    $stmt->bindValue(':subID',$subID,PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(); 
    return $data;
}

public function get_favorite_by_id(int $ID){
    $dbh = DAO::get_db_connect(); 
    $sql = "SELECT  subsc.SubName,subsc.image,subscplan.Price,kikan.date AS freedate, subsc.Setumei FROM favorite
INNER JOIN subsc ON favorite.SubID = subsc.SubID
INNER JOIN subscplan ON subsc.SubID = subscplan.SubID
INNER JOIN kikan ON subscplan.FreeTimeID = kikan.KikanID
WHERE favorite.ID = :id";
    $stmt = $dbh->prepare($sql); // SQLを実行する 
    $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
    $stmt->execute();
    $data=[];
    while($row=$stmt->fetchObject('favorite')){
        $data[]=$row;
    }
        return $data;
}
public function delete_favorite(int $ID){
    $dbh = DAO::get_db_connect(); 
    $sql = "delete from favorite where ID=:ID"; 
    $stmt = $dbh->prepare($sql); 
    $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
    $stmt->execute();
}
public function get_subsc(string $subID){
    $dbh = DAO::get_db_connect();
    $sql="SELECT subname,image,genreName,price,interval.kikanName,interval.date,freetime.kikanName,freetime.date as freedate
	            ,setumei,URL FROM subsc 
		        LEFT OUTER JOIN genre ON subsc.GenreID = genre.GenreID
			    LEFT OUTER JOIN subscplan ON subsc.SubID = subscplan.subID
				LEFT OUTER JOIN kikan as freetime ON subscplan.FreeTimeID = freetime.KikanID
				LEFT OUTER JOIN kikan as interval ON subscplan.IntervalID = interval.KikanID
                where subsc.SubID = :subID";
     $stmt = $dbh->prepare($sql); 
     $stmt->bindValue(':subID',$subID,PDO::PARAM_STR);

     $stmt->execute(); 
     $data = $stmt->fetchAll(); 
     return $data; 
}
public function get_subsc_by_keyword(string $keyword){
        
    $dbh = DAO::get_db_connect();

    $keyword = "%".$keyword."%";
    $sql = "SELECT subname,image,genreName,price
            FROM subsc 
            LEFT OUTER JOIN genre ON subsc.GenreID = genre.GenreID
            LEFT OUTER JOIN subscplan ON subsc.SubID = subscplan.subID
            LEFT OUTER JOIN kikan as freetime ON subscplan.FreeTimeID = freetime.KikanID
            LEFT OUTER JOIN kikan as interval ON subscplan.IntervalID = interval.KikanID
            WHERE subId LIKE :subId OR subname LIKE :subname OR aliasName LIKE :aliasName OR shortName LIKE :shortName OR genreName LIKE :genreName";

    
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':subId',$keyword ,PDO::PARAM_STR);
    $stmt->bindValue(':subname',$keyword ,PDO::PARAM_STR);

    $stmt->execute();

    $data =[];
    while($row=$stmt->fetchObject('user')){
        $data[] =$row;
    }
    return $data;
}

}
    