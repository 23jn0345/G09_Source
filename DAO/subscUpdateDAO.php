<?php
require_once 'DAO.php';
#[\AllowDynamicProperties]
class subsc{
    public  string  $subName;
    public  string  $setumei;
    public  string  $aliasName;
    public  string  $shortName;
    public  string  $image;
    public  string  $url; 
    public  string  $genreId;
}
#[\AllowDynamicProperties]
class subId{
    public  string  $subId;
}


#[\AllowDynamicProperties]
class subscUpdateDAO{

    public function get_subsc($subID){
        $dbh = DAO::get_db_connect();

        $sql = "SELECT subName,setumei,aliasName,shortName,image,url,genreId
	            FROM subsc 
		        WHERE SubID =:subID";

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':subID',$subID ,PDO::PARAM_STR);
       
        $stmt->execute();

        $data = $stmt->fetchObject('subsc');

        return $data;
    }

    public function get_subID($subName){
        $dbh = DAO::get_db_connect();

        $sql = "SELECT subId
	            FROM subsc 
		        WHERE SubName =:subName";

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':subName',$subName ,PDO::PARAM_STR);
       
        $stmt->execute();

        $data = $stmt->fetchObject('subId');

        return $data;
    }

    public function get_kikanID($kikanName,$Date){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT kikanID
	            FROM kikan 
                WHERE kikanname = :kikanName and date =:date";
		        
				

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':kikanName',$kikanName,PDO::PARAM_STR);
        $stmt->bindValue(':date',$Date,PDO::PARAM_INT);

        $stmt->execute();

        $data =$stmt->fetchObject('kikanID');

        return $data;
    }
    public function insert_plan($subId,$price,$intervalId,$freeTimeId){
        $dbh = DAO::get_db_connect();

        $sql = "INSERT INTO dbo.subscplan(subId,price,intervalId,freeTimeId) 
                Values(:subId,:price,:intervalId,:freeTimeId)";
		        
				

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':subId',$subId,PDO::PARAM_INT);
        $stmt->bindValue(':price',$price,PDO::PARAM_INT);
        $stmt->bindValue(':intervalId',$intervalId,PDO::PARAM_INT);
        $stmt->bindValue(':freeTimeId',$freeTimeId,PDO::PARAM_INT);

        $stmt->execute();

    }

}