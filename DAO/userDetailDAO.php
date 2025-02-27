<?php
require_once 'DAO.php';

#[\AllowDynamicProperties]
class userDetail{
    public int $id;
    public string $name;
    public string $password;
    public int $birthday;
    public int $gender;
    public int $useSubId;
}
#[\AllowDynamicProperties]
class nonSubscUser{
    public int $id;
    public string $name;
    public string $password;
    public int $birthday;
    public int $gender;
    
}

#[\AllowDynamicProperties]
class useSubsc{
    public string $subName;
}

#[\AllowDynamicProperties]
class userDetailDAO{
    

    public function get_user(int $userid){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT member.id,name,BirthDay,gender,useSubId
	            FROM member 
		        LEFT OUTER JOIN usingsubsc ON member.id = usingsubsc.id
                WHERE member.id = :id";

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':id',$userid,PDO::PARAM_INT);

        $stmt->execute();

        
        $data = $stmt->fetchObject('userDetail');

        return $data;
    }

    public function get_non_subsc_user(int $userid){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT member.id,name,BirthDay,gender
	            FROM member 
                WHERE member.id = :id";

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':id',$userid,PDO::PARAM_INT);

        $stmt->execute();

        
        $data = $stmt->fetchObject('nonSubscUser');

        return $data;
    }

    public function get_use_subsc(int $userid){
        
        $dbh = DAO::get_db_connect();
        
        $sql = "SELECT subName 
	            FROM member 
		        LEFT OUTER JOIN usingsubsc ON member.id = usingsubsc.id
				LEFT OUTER JOIN subsc ON usingsubsc.SubID = subsc.SubID
                WHERE member.id = :id";

        $stmt = $dbh->prepare($sql);
    
        $stmt->bindValue(':id',$userid,PDO::PARAM_INT);

        $stmt->execute();
            
        while($row = $stmt->fetchObject('useSubsc')){
            $data[]=$row;
        }

        return $data;
    }

    public function delete_user(int $userid){

        $dbh = DAO::get_db_connect();

        $sql = "DELETE FROM favorite WHERE id = :id";

        $stmt = $dbh->prepare($sql);
    
        $stmt->bindValue(':id',$userid,PDO::PARAM_INT);

        $stmt->execute();

        $sql = "DELETE FROM usingsubsc WHERE id = :id";

        $stmt = $dbh->prepare($sql);
    
        $stmt->bindValue(':id',$userid,PDO::PARAM_INT);

        $stmt->execute();

        
        $sql = "DELETE FROM member WHERE id = :id";

        $stmt = $dbh->prepare($sql);
    
        $stmt->bindValue(':id',$userid,PDO::PARAM_INT);

        $stmt->execute();
            
    }

}