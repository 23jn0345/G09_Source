<?php
require_once 'DAO.php';
#[\AllowDynamicProperties]
class insertsubsc{
    
    public string $subName;
    public string $setumei;
    public int $price;
    public string $image;
    public string $genreId;
    public string $aliasName;
    public string $shortName;
}
#[\AllowDynamicProperties]
class insertPlanData{
    public int $subId;
    public int $price;
    public string $intervalName;
    public int $intervalDate;
    public string $freeTimeName;
    public int $freeTimeDate;
}
#[\AllowDynamicProperties]
class subID{
    public int $subId;
}
class kikanID{
    public int $kikanId;
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

        $data =[];
        while($row = $stmt->fetchObject('insertsubsc')){
            $data[] = $row;
        }

        return $data;
    }

    public function get_ID($subName){
        $dbh = DAO::get_db_connect();

        $sql = "SELECT subID
	            FROM subsc 
		        WHERE subname =:subname";

        $stmt = $dbh->prepare($sql);

        $stmt->execute();

        $data =$stmt->fetchObject('subID');

        return $data;
    }

    public function insert_kikandate($kikanName,$kikanDate){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT kikanID
	            FROM kikan 
                WHERE kikanname =:kikanname and date =:date";
		        
				

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':kikanname',$kikanName,PDO::PARAM_STR);
        $stmt->bindValue(':date',$kikanDate,PDO::PARAM_INT);

        $stmt->execute();

        $data =$stmt->fetchObject('kikanID');

        return $data;
    }

    
}