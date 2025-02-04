<?php
require_once 'DAO.php';
#[\AllowDynamicProperties]
class subID{
    public int $subID;
    
}
#[\AllowDynamicProperties]
class kikanID{
    public int $kikanID;
}

#[\AllowDynamicProperties]
class regiConfirmationDAO{

    public function insert_subsc($subName,$setumei,$image,$genreId,$aliasName,$shortName,$url){

        $dbh = DAO::get_db_connect();

        $sql = "INSERT INTO dbo.subsc(SubName,Setumei,aliasName,shortName,image,url,GenreId) 
                Values(:subName,:setumei,:aliasName,:shortName,:image,:url,:genreId)";

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':subName',$subName ,PDO::PARAM_STR);
        $stmt->bindValue(':setumei',$setumei ,PDO::PARAM_STR);
        $stmt->bindValue(':aliasName',$aliasName ,PDO::PARAM_STR);
        $stmt->bindValue(':shortName',$shortName ,PDO::PARAM_STR);
        $stmt->bindValue(':image',$image ,PDO::PARAM_STR);
        $stmt->bindValue(':url',$url ,PDO::PARAM_STR);
        $stmt->bindValue(':genreId',$genreId ,PDO::PARAM_INT);

        

        $stmt->execute();

        
    }

    public function delete_subsc($subName,$genreId){

        $dbh = DAO::get_db_connect();

        $sql = "DELETE FROM subsc WHERE subname = :subName and genreId =:genreId";

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':subName',$subName ,PDO::PARAM_STR);
        $stmt->bindValue(':genreId',$genreId ,PDO::PARAM_INT);

        $stmt->execute();

        
    }

    public function get_ID($subName){
        $dbh = DAO::get_db_connect();

        $sql = "SELECT subID 
	            FROM subsc 
		        WHERE SubName =:subName";

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':subName',$subName ,PDO::PARAM_STR);
       
        $stmt->execute();

        $data = $stmt->fetchObject('subID');

        return $data;
    }

    public function get_kikanID($kikanName,$Date){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT kikanID
	            FROM kikan 
                WHERE kikanname =:kikanName and date =:date";
		        
				

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