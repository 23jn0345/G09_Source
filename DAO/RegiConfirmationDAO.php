<?php
require_once 'DAO.php';
#[\AllowDynamicProperties]
class insertsubsc{
    public int $subId;
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
class regiConfirmationDAO{
    

    public function insert_subsc($subName,$setumei,$image,$genreId,$aliasName,$shortName,$url){

        $dbh = DAO::get_db_connect();

        $sql = "INSERT INTO dbo.subsc(SubName,Setumei,aliasName,shortName,image,url,GenreId) 
                Values(:subName,:setumei,:aliasName,:shortName,:image,:url,:genreId)";

        
        $stmt->bindValue(':subName',$subName ,PDO::PARAM_STR);
        $stmt->bindValue(':setumei',$setumei ,PDO::PARAM_STR);
        $stmt->bindValue(':aliasName',$aliasName ,PDO::PARAM_STR);
        $stmt->bindValue(':shortName',$shortName ,PDO::PARAM_STR);
        $stmt->bindValue(':image',$image ,PDO::PARAM_STR);
        $stmt->bindValue(':url',$url ,PDO::PARAM_STR);
        $stmt->bindValue(':genreId',$genreId ,PDO::PARAM_INT);

        $stmt = $dbh->prepare($sql);

        $stmt->execute();

        $data =[];
        while($row = $stmt->fetchObject('insertsubsc')){
            $data[] = $row;
        }

        return $data;
    }

    public function insert_kikandate($price,$intervalName,$intervalDate,$freetimeName,$freetimeDate){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT subsc.subId,subName
	            FROM subsc 
				ORDER BY subid DESC";

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':subId',$subId,PDO::PARAM_INT);

        $stmt->execute();

        $subdata = $stmt->fetchAll(); 
        
        $subid=$subdata[0]->subid;

        $sql = "SELECT subsc.SubID,price, interval.kikanName as intervalName,interval.date as intervalDate,freetime.kikanName as freetimeName,freetime.date as freetimedate
	            FROM subsc 
		        LEFT OUTER JOIN genre ON subsc.GenreID = genre.GenreID
			    LEFT OUTER JOIN subscplan ON subsc.SubID = subscplan.subID
				LEFT OUTER JOIN kikan as freetime ON subscplan.FreeTimeID = freetime.KikanID
				LEFT OUTER JOIN kikan as interval ON subscplan.IntervalID = interval.KikanID
				WHERE subsc.SubID = :subId";

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':subId',$subId,PDO::PARAM_INT);

        if($stmt->execute()){
            $data="成功";
        }else{
            $data="失敗";
        }

        

        return $data;
    }

    
}