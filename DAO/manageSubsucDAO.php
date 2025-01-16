<?php
require_once 'DAO.php';

class subsc{
    public string $subId;
    public string $subName;
    public int $price;
    public bool $image;
    public string $genreName;
    public string $aliasName;
    public string $shortName;
}

class kikandata{
    public string $kikanName;
    public string $kikanName2;
    public int $date;
    public int $date2;
}

class subscDAO{
    

    public function get_subsc(){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT subname,image,genreName,price
	            FROM subsc 
		        LEFT OUTER JOIN genre ON subsc.GenreID = genre.GenreID
			    LEFT OUTER JOIN subscplan ON subsc.SubID = subscplan.subID
				LEFT OUTER JOIN kikan as freetime ON subscplan.FreeTimeID = freetime.KikanID
				LEFT OUTER JOIN kikan as interval ON subscplan.IntervalID = interval.KikanID";

        $stmt = $dbh->prepare($sql);

        $stmt->execute();

        $data =[];
        while($row = $stmt->fetchObject('subsc')){
            $data[] = $row;
        }

        return $data;
    }

    public function get_subscdata($subId){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT interval.kikanName,interval.date as intervaldate,freetime.kikanName,freetime.date as freetimedate
	            FROM subsc 
		        LEFT OUTER JOIN genre ON subsc.GenreID = genre.GenreID
			    LEFT OUTER JOIN subscplan ON subsc.SubID = subscplan.subID
				LEFT OUTER JOIN kikan as freetime ON subscplan.FreeTimeID = freetime.KikanID
				LEFT OUTER JOIN kikan as interval ON subscplan.IntervalID = interval.KikanID";

        $stmt = $dbh->prepare($sql);

        $stmt->execute();

        $data =[];
        while($row = $stmt->fetchObject('subsc')){
            $data[] = $row;
        }

        return $data;
    }

    public function get_goods_by_keyword(string $keyword){
        
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