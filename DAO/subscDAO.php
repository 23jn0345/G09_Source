<?php 
require_once 'DAO.php';
require_once 'memberDAO.php';
$memberDAO= new memberDAO();
#[\AllowDynamicProperties]
class subsc{
    public string $subname;
    public string $setumei;
    public string $aliasName;
    public string $shortName;
    public string $image;
    public string $URL;
    public int $subID;
    public int $price;
    public int $date;
    
    
}
#[\AllowDynamicProperties]
class subscDAO { 
    public function search_subsc(string $subscName) {
       
        $dbh = DAO::get_db_connect();
        
         $sql = "SELECT subName,setumei,aliasName,shortName,image,URL FROM subsc WHERE SubName LIKE :subscName";
         $stmt = $dbh->prepare($sql); 
         $stmt->bindValue(':subscName','%'.$subscName.'%',PDO::PARAM_STR);
         $stmt->execute(); 
         $data = $stmt->fetchAll(); 
         return $data; 
         
}
         
public function add_favorite(int $ID,int $subID){
    $dbh = DAO::get_db_connect();
    $sql="INSERT INTO favorite (ID, subID) VALUES (:ID, :subID)";
    $stmt = $dbh->prepare($sql); 
    $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
    $stmt->bindValue(':subID',$subID,PDO::PARAM_INT);
    $stmt->execute();
    return ;
}

public function get_favorite_by_id(int $ID){
    $dbh = DAO::get_db_connect(); 
    $sql = "SELECT  
    subsc.SubID, 
    subsc.SubName, 
    subsc.image, 
    subscplan.Price, 
    kikan.date AS freedate, 
    subsc.Setumei 
FROM favorite
INNER JOIN subsc ON favorite.SubID = subsc.SubID
INNER JOIN subscplan ON subsc.SubID = subscplan.SubID
INNER JOIN kikan ON subscplan.FreeTimeID = kikan.KikanID
WHERE favorite.ID = :id
";
    $stmt = $dbh->prepare($sql); // SQLを実行する 
    $stmt->bindValue(':id',$ID,PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();
        return $data;
}
public function delete_favorite(int $ID,int $subID){
    $dbh = DAO::get_db_connect(); 
    $sql = "delete from favorite where SubID=:SubID and ID=:ID"; 
    $stmt = $dbh->prepare($sql); 
    $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
    $stmt->bindValue(':SubID',$subID,PDO::PARAM_INT);
    $stmt->execute();
}
public function get_subsc(int $subID){
    $dbh = DAO::get_db_connect();
    $sql="SELECT subname,image,genreName,price,interval.kikanName,interval.date,freetime.kikanName,freetime.date as freedate
	            ,setumei,URL FROM subsc 
		        LEFT OUTER JOIN genre ON subsc.GenreID = genre.GenreID
			    LEFT OUTER JOIN subscplan ON subsc.SubID = subscplan.SubID
				LEFT OUTER JOIN kikan as freetime ON subscplan.FreeTimeID = freetime.KikanID
				LEFT OUTER JOIN kikan as interval ON subscplan.IntervalID = interval.KikanID
                where subsc.SubID = :SubID";
     $stmt = $dbh->prepare($sql); 
     $stmt->bindValue(':SubID',$subID,PDO::PARAM_INT);

     $stmt->execute(); 
     $data = $stmt->fetchAll(); 
     return $data; 
}
public function get_subsc_by_keyword(string $keyword){
        
    $dbh = DAO::get_db_connect();

    $keyword = "%".$keyword."%";
    $sql = "SELECT subname,image,price,interval.date,genreName,subsc.subID
	             FROM subsc 
		        LEFT OUTER JOIN genre ON subsc.GenreID = genre.GenreID
			    LEFT OUTER JOIN subscplan ON subsc.SubID = subscplan.subID
				LEFT OUTER JOIN kikan as freetime ON subscplan.FreeTimeID = freetime.KikanID
				LEFT OUTER JOIN kikan as interval ON subscplan.IntervalID = interval.KikanID
           where subname LIKE :subname OR aliasName LIKE :aliasName OR shortName LIKE :shortName OR genreName LIKE :genreName";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':aliasName',$keyword ,PDO::PARAM_STR);
    $stmt->bindValue(':subname',$keyword ,PDO::PARAM_STR);
    $stmt->bindValue(':shortName',$keyword ,PDO::PARAM_STR);
    $stmt->bindValue(':genreName',$keyword ,PDO::PARAM_STR);

    $stmt->execute();

    $data =[];
    while($row=$stmt->fetchObject('subsc')){
        $data[] =$row;
    }
    return $data;
}

public function get_subsc_by_genre(string $genres){

    $dbh = DAO::get_db_connect();

    $sql = "SELECT subname,image,price,interval.date,genreName,subsc.subID
                FROM subsc
                LEFT OUTER JOIN genre ON subsc.GenreID = genre.GenreID
                LEFT OUTER JOIN subscplan ON subsc.SubID = subscplan.subID
                LEFT OUTER JOIN kikan as freetime ON subscplan.FreeTimeID = freetime.KikanID
                LEFT OUTER JOIN kikan as interval ON subscplan.IntervalID = interval.KikanID
                Where subsc.genreID = :genre";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':genre',$genres ,PDO::PARAM_STR);

    $stmt->execute();

    $data = [];
    while($row=$stmt->fetchObject('subsc')){
        $data[] =$row;
    }
    return $data;
}

public function get_subsc_by_keywordgenre(string $keyword,string $genres){

    $dbh = DAO::get_db_connect();

    $keyword = "%".$keyword."%";
    $sql = "SELECT subname,image,price,interval.date,genreName,subsc.subID
                FROM subsc
                LEFT OUTER JOIN genre ON subsc.GenreID = genre.GenreID
                LEFT OUTER JOIN subscplan ON subsc.SubID = subscplan.subID
                LEFT OUTER JOIN kikan as freetime ON subscplan.FreeTimeID = freetime.KikanID
                LEFT OUTER JOIN kikan as interval ON subscplan.IntervalID = interval.KikanID
                Where (subname LIKE :subname OR aliasName LIKE :aliasName OR shortName LIKE :shortName OR genreName LIKE :genreName) AND subsc.genreID = :genre";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':aliasName',$keyword ,PDO::PARAM_STR);
    $stmt->bindValue(':subname',$keyword ,PDO::PARAM_STR);
    $stmt->bindValue(':shortName',$keyword ,PDO::PARAM_STR);
    $stmt->bindValue(':genreName',$keyword ,PDO::PARAM_STR);
    $stmt->bindValue(':genre',$genres ,PDO::PARAM_STR);

    $stmt->execute();

    $data = [];
    while($row=$stmt->fetchObject('subsc')){
        $data[] =$row;
    }
    return $data;
}

public function get_all_subsc(){
    // データベース接続を取得
    $dbh = DAO::get_db_connect();



    // ベースSQL
    $sql = "
        SELECT 
        subsc.subID, -- SubID を追加
        subsc.subname, 
        subsc.image, 
        subscplan.price, 
        kikan.date
    FROM 
        subsc
    INNER JOIN subscplan ON subsc.SubID = subscplan.SubID
    INNER JOIN kikan ON subscplan.IntervalID = kikan.KikanID
    WHERE 1=1
    ";

    $params = [];
    
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    while($row=$stmt->fetchObject('subsc')){
        $data[] =$row;
    }
        return $data;
    }

    public function is_favorite(int $ID, int $subID){
        $dbh = DAO::get_db_connect();

        $sql = "SELECT * FROM favorite WHERE ID = :ID and subID = :subID";
        $stmt = $dbh->prepare($sql); 
        $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);
        $stmt->bindValue(':subID',$subID,PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(); 
        $lowCnt = count($data);
        if($lowCnt > 0){
            return true;
        }
        return false; 
    
    
    }

    public function get_Plans_by_subID($subID){
        $dbh = DAO::get_db_connect();


        $sql = "select * from subsc 
	    inner  join  subscplan ON subsc.SubID = subscplan.SubID  
	    inner join kikan on IntervalID = KikanID 
	    where subsc.SubID = :subID";
        $stmt = $dbh->prepare($sql); 
        $stmt->bindValue(':subID',$subID,PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(); 

        return $data; 

    }

    public function get_Plans_and_subsc(int $ID, int $subID){
        $dbh = DAO::get_db_connect();
        $sql = "	select * from subsc 
	    inner  join  subscplan ON subsc.SubID = subscplan.SubID  
	    inner join kikan on IntervalID = KikanID 
		inner join usingsubsc on subsc.SubID = usingsubsc.SubID
	    where subsc.SubID = :subID and ID = :ID";
        $stmt = $dbh->prepare($sql); 
        $stmt->bindValue(':ID',$ID,PDO::PARAM_INT);

        $stmt->bindValue(':subID',$subID,PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(); 
        return $data; 

    }
}


    