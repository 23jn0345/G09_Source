<?php
require_once 'DAO.php';
class UsingSubsc{
public int $ID;
public int $subID;
public string $subName;
public string $image;
public string $setumei;
public int $intervalDate;
public int $freeDate;
public int $price;
}
#[\AllowDynamicProperties]
class UsingSubscDAO{
    public function get_using_by_id(int $ID){
        $dbh = DAO::get_db_connect(); 
        $sql = "SELECT  subsc.image,subsc.SubName,subscplan.Price,kikan.date as date,subsc.SubID FROM usingsubsc
INNER JOIN subsc ON usingsubsc.SubID = subsc.SubID
INNER JOIN subscplan ON usingsubsc.PlanID = subscplan.PlanID
INNER JOIN kikan ON subscplan.IntervalID = kikan.KikanID
WHERE usingsubsc.ID = :ID"; 
        $stmt = $dbh->prepare($sql); // SQLを実行する 
        $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
         
    public function using_Now(int $ID,int $subID){
        $dbh = DAO::get_db_connect(); 
        $sql = "SELECT * from usingsubsc where ID=:ID and subID= :subID"; 
        $stmt = $dbh->prepare($sql); // SQLを実行する 
        $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
        $stmt->bindValue(':subID',$subID,PDO::PARAM_INT);
        $stmt->execute();
        if($stmt->fetch() !== false){
            return true;
        }else{
            return false;
        }
    }

    
    public function subscribe(int $ID,int $subID){
        $dbh = DAO::get_db_connect(); 
        if(!$this->using_Now($ID,$subID)){
            $sql = "insert into usingsubsc (ID,subID,planID) values (:ID,:subID,:planID)"; 
            $stmt = $dbh->prepare($sql); // SQLを実行する 
            $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
            $stmt->bindValue(':subID',$subID,PDO::PARAM_INT);
            $stmt->bindValue(':planID',$planID,PDO::PARAM_INT);
            $stmt->execute();
            $cnt=0;
            $cnt+1;
    }
    }

   
    /*
    public function update(int $ID,int $subID){
        $dbh = DAO::get_db_connect(); 
        $sql = "update cart set num=:num where memberid=:memberid and goodscode=:goodscode"; 
        $stmt = $dbh->prepare($sql); // SQLを実行する 
        $stmt->bindValue(':memberid',$memberid,PDO::PARAM_INT);
        $stmt->bindValue(':goodscode',$goodscode,PDO::PARAM_STR);
        $stmt->bindValue(':num',$num,PDO::PARAM_INT);
        $stmt->execute();
    }
        */
    public function delete(int $ID,int $subID){
        $dbh = DAO::get_db_connect(); 
        $sql = "delete from usingsubsc where ID=:ID and subID=:subID"; 
        $stmt = $dbh->prepare($sql); 
        $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
        $stmt->bindValue(':subID',$subID,PDO::PARAM_INT);
        $stmt->execute();
    }
}

