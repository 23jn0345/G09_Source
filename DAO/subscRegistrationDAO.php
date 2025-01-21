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
class insertkikandata{
    public int $subId;
    public int $price;
    public string $intervalName;
    public int $intervalDate;
    public string $freetimeName;
    public int $freetimeDate;
}
#[\AllowDynamicProperties]
class manageSubscDAO{
    

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

    public function get_subscdata($subId,$price,$intervalName,$intervalDate,$freetimeName,$freetimeDate){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT subsc.SubID,price, interval.kikanName as intervalName,interval.date as intervalDate,freetime.kikanName as freetimeName,freetime.date as freetimedate
	            FROM subsc 
		        LEFT OUTER JOIN genre ON subsc.GenreID = genre.GenreID
			    LEFT OUTER JOIN subscplan ON subsc.SubID = subscplan.subID
				LEFT OUTER JOIN kikan as freetime ON subscplan.FreeTimeID = freetime.KikanID
				LEFT OUTER JOIN kikan as interval ON subscplan.IntervalID = interval.KikanID
				WHERE subsc.SubID = :subId";

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':subId',$subId,PDO::PARAM_INT);

        $stmt->execute();

        $sql = "SELECT subsc.SubID,price, interval.kikanName as intervalName,interval.date as intervalDate,freetime.kikanName as freetimeName,freetime.date as freetimedate
	            FROM subsc 
		        LEFT OUTER JOIN genre ON subsc.GenreID = genre.GenreID
			    LEFT OUTER JOIN subscplan ON subsc.SubID = subscplan.subID
				LEFT OUTER JOIN kikan as freetime ON subscplan.FreeTimeID = freetime.KikanID
				LEFT OUTER JOIN kikan as interval ON subscplan.IntervalID = interval.KikanID
				WHERE subsc.SubID = :subId";

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':subId',$subId,PDO::PARAM_INT);

        $stmt->execute();

        $data =[];
        while($row = $stmt->fetchObject('insertkikandata')){
            $data[] = $row;
        }

        return $data;
    }

    public function get_subsc_by_keyword(string $keyword){
        
        $dbh = DAO::get_db_connect();

        $keyword = "%".$keyword."%";
        $sql = "SELECT subsc.subId,subName,image,genreName,price
                FROM subsc 
                LEFT OUTER JOIN genre ON subsc.GenreID = genre.GenreID
                LEFT OUTER JOIN subscplan ON subsc.SubID = subscplan.subID
                LEFT OUTER JOIN kikan as freetime ON subscplan.FreeTimeID = freetime.KikanID
                LEFT OUTER JOIN kikan as interval ON subscplan.IntervalID = interval.KikanID
                WHERE subsc.subId LIKE :subId OR subName LIKE :subName OR aliasName LIKE :aliasName OR shortName LIKE :shortName OR genreName LIKE :genreName";

        
        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':subId',$keyword ,PDO::PARAM_INT);
        $stmt->bindValue(':subName',$keyword ,PDO::PARAM_STR);
        $stmt->bindValue(':aliasName',$keyword ,PDO::PARAM_STR);
        $stmt->bindValue(':shortName',$keyword ,PDO::PARAM_STR);
        $stmt->bindValue(':genreName',$keyword ,PDO::PARAM_STR);
        $stmt->execute();

        $data =[];
        while($row=$stmt->fetchObject('subsc')){
            $data[] =$row;
        }
        return $data;
    }
}