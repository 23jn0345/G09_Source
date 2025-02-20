<?php
require_once 'DAO.php';
class UsingSubsc{
public int $ID;
public int $subID;
public string $subName;
public string $image;
public string $setumei;
public int $intervalDate;
public string $endfree;
public string $nextpay;
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

    
    public function subscribe(int $ID,int $subID,int $planID,string $endFree, string $nextPay){
        $dbh = DAO::get_db_connect(); 
        if(!$this->using_Now($ID,$subID)){
            $sql = "insert into usingsubsc (ID,SubID,PlanID,RegistDate,EndFree,NextPay) values (:ID,:subID,:planID,:RegistDate,:EndFree,:NextPay)"; 
            $stmt = $dbh->prepare($sql); // SQLを実行する 
            $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
            $stmt->bindValue(':subID',$subID,PDO::PARAM_INT);
            $stmt->bindValue(':planID',$planID,PDO::PARAM_INT);
            $today = date('Y-m-d');
            $stmt->bindValue(':RegistDate',$today,PDO::PARAM_INT);
            $stmt->bindValue(':EndFree',$endFree,PDO::PARAM_INT);
            $stmt->bindValue(':NextPay',$nextPay,PDO::PARAM_INT);

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
    public function update_subscribe(int $ID,int $subID,int $planID,string $endFree, string $nextPay){
        $dbh = DAO::get_db_connect(); 

        $sql = "update  usingsubsc set PlanID = :planID,EndFree = :EndFree,NextPay=:NextPay where  ID = :ID and SubID = :subID"; 
        $stmt = $dbh->prepare($sql); // SQLを実行する 
        $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
        $stmt->bindValue(':subID',$subID,PDO::PARAM_INT);
        $stmt->bindValue(':planID',$planID,PDO::PARAM_INT);

        $stmt->bindValue(':EndFree',$endFree,PDO::PARAM_INT);
        $stmt->bindValue(':NextPay',$nextPay,PDO::PARAM_INT);

        $stmt->execute();
    }
    public function get_using_by_id_home(int $ID){
        $dbh = DAO::get_db_connect(); 
        $sql = "SELECT subName,endfree,nextpay FROM usingsubsc
        INNER JOIN subsc ON usingsubsc.SubID = subsc.SubID
        WHERE ID = :ID"; 
        $stmt = $dbh->prepare($sql); // SQLを実行する 
        $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
        $stmt->execute();
        $data=[];
        while($row=$stmt->fetchObject('usingsubsc')){
            $data[]=$row;
        }
            return $data;
    }

    public function get_using_by_id_efnp(int $ID){
        $dbh = DAO::get_db_connect(); 
        $sql = "SELECT endfree,nextpay FROM usingsubsc
        INNER JOIN subsc ON usingsubsc.SubID = subsc.SubID
        WHERE ID = :ID"; 
        $stmt = $dbh->prepare($sql); // SQLを実行する 
        $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
        $stmt->execute();
        $data=[];
        while($row=$stmt->fetchObject('usingsubsc')){
            $data[]=$row;
        }
            return $data;
    }
    
}
    if(isset($_POST['action']) == true && $_POST['action'] === 'get_using_by_id_efnp'){
        $using = new UsingSubscDAO();
        $result = $using->get_using_by_id_home($_POST['param']);
        echo json_encode(['result' => $result]);
        exit();
    }



