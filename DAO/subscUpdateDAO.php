<?php
require_once 'DAO.php';
#[\AllowDynamicProperties]
class regiSubsc{
    public  string  $subName;
    public  string  $detail;
    public  string  $image;
    public  string  $genreId;
    public  string  $aliasName;
    public  string  $shortName;
    public  string  $url; 
}
#[\AllowDynamicProperties]
class freeTimeData{
    public int $kikanId;
    public string $name;
    public int $date;
}
#[\AllowDynamicProperties]
class intervalData{
    public int $kikanId;
    public string $name;
    public int $date;
}

#[\AllowDynamicProperties]
class regiConfirmationDAO{

    public function get_subsc($subID){
        $dbh = DAO::get_db_connect();

        $sql = "SELECT *
	            FROM subsc 
		        WHERE SubID =:subID";

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':subID',$subID ,PDO::PARAM_STR);
       
        $stmt->execute();

        $data = $stmt->fetchObject('subsc');

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