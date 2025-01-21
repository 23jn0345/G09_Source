<?php
require_once 'DAO.php';

#[\AllowDynamicProperties]
class userDetail{
    public string $id;
    public string $name;
    public string $password;
    public string $birthday;
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

        $sql = "SELECT member.id,name,BirthDay,gender,UseSubId
	            FROM member 
		        LEFT OUTER JOIN usingsubsc ON member.id = usingsubsc.id
                WHERE member.id = :id";

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':id',$userid,PDO::PARAM_INT);

        $stmt->execute();

        
        $data = $stmt->fetchObject('userDetail');

        return $data;
    }

    public function get_use_subsc(int $userid){
        
        $dbh = DAO::get_db_connect();
        $subName =1;
        $sql = "SELECT subName 
	            FROM member 
		        LEFT OUTER JOIN usingsubsc ON member.id = usingsubsc.id
				LEFT OUTER JOIN subsc ON usingsubsc.SubID = subsc.SubID
                WHERE member.id = :id";

        $stmt = $dbh->prepare($sql);
        
            $stmt->bindValue(':id',$userid,PDO::PARAM_INT);

            $stmt->execute();
        if($stmt != 1){
            while($row = $stmt->fetchObject('useSubsc')){
                $data[]=$row;
            }
        }
        else{
            $data = NULL;
        }

        return $data;
    }

}