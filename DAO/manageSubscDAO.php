<?php
require_once 'DAO.php';

class subsc{
    public string $subId;
    public string $subName;
    public int $price;
    public string $kikanName;
    public int $date;
    public bool $image;
    public string $genrename;
}

class subscDAO{
    

    public function get_subsc(){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT subname,image,GenreName,Price,interval.Kikanname,interval.date,freetime.Kikanname,freetime.date
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

    public function get_goods_by_groupcode(int $groupcode){

        $dbh = DAO::get_db_connect();

        $sql ="SELECT *
                FROM kikan
                WHERE groupcode = :groupcode
                ORDER BY recommend DESC";

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':groupcode',$groupcode,PDO::PARAM_INT);

        $stmt->execute();

        $data =[];
        while($row = $stmt->fetchObject('Goods')){
            $data[]=$row;
        }

        return $data;
    }

    public function get_goods_by_goodscode(string $goodscode){

        $dbh = DAO::get_db_connect();

        $sql ="SELECT *
                FROM goods
                WHERE goodscode = :goodscode
                ORDER BY recommend DESC";

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':goodscode',$goodscode,PDO::PARAM_STR);

        $stmt->execute();

        $data =[];
        $goods = $stmt->fetchObject('Goods');
            

        return $goods;
    }

    public function get_goods_by_keyword(string $keyword){
        
        $dbh = DAO::get_db_connect();

        $keyword = "%".$keyword."%";
        $sql = "SELECT * FROM goods
                WHERE goodsname LIkE :goodsname OR detail LIKE :detail
                ORDER BY recommend DESC";
        
        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':goodsname',$keyword ,PDO::PARAM_STR);
        $stmt->bindValue(':detail',$keyword ,PDO::PARAM_STR);

        $stmt->execute();

        $data =[];
        while($row=$stmt->fetchObject('Goods')){
            $data[] =$row;
        }
        return $data;
    }
}