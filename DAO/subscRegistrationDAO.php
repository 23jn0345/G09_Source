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
class subscRegiDAO{

    public function get_freetime(){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT * FROM kikan
                WHERE kikanname = '無料期間'
                ORDER BY date ASC";

        $stmt = $dbh->prepare($sql);

        $stmt->execute();

        $data =[];
        while($row = $stmt->fetchObject('freeTimeData')){
            $data[] = $row;
        }

        return $data;
    }

    public function get_interval(){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT * FROM kikan
                WHERE kikanname = '支払いスパン'
                ORDER BY date ASC";

        $stmt = $dbh->prepare($sql);

        $stmt->execute();

        $data =[];
        while($row = $stmt->fetchObject('intervalData')){
            $data[] = $row;
        }

        return $data;
    }
    
    
}