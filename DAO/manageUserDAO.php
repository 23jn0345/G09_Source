<?php
require_once 'DAO.php';

#[\AllowDynamicProperties]
class user{
    public string $id;
    public string $name;
    public string $birthday;
    public int $gender;
    public string $subCount; 
}

#[\AllowDynamicProperties]
class userDAO{
    

    public function get_user(){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT member.id,name,BirthDay,gender,COUNT(UseSubID) as subCount
	            FROM member 
		        LEFT OUTER JOIN usingsubsc ON member.id = usingsubsc.id
			    GROUP BY member.id,name,BirthDay,gender
				ORDER BY member.id ASC";

        $stmt = $dbh->prepare($sql);

        $stmt->execute();

        $data =[];
        while($row = $stmt->fetchObject('user')){
            $data[] = $row;
        }

        return $data;
    }

    public function get_user_by_ID(int $id){

        $dbh = DAO::get_db_connect();

        $sql = "SELECT member.id,name,BirthDay,gender,UseSubId
	            FROM member 
		        LEFT OUTER JOIN usingsubsc ON member.id = usingsubsc.id
                WHERE member.id = :id";

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':id',$id,PDO::PARAM_INT);

        $stmt->execute();

        
        while($row = $stmt->fetchObject('user')){
            $data[]=$row;
        }

        return $data;
    }

    public function get_user_by_keyword(string $keyword){
        
        $dbh = DAO::get_db_connect();

        $keyword = "%".$keyword."%";
        $sql = "SELECT member.id,name,BirthDay,gender,COUNT(UseSubID) as subCount
	            FROM member 
                LEFT OUTER JOIN usingsubsc ON member.id = usingsubsc.id
                WHERE member.id LIKE :id OR name LIKE :name
                GROUP BY member.id,name,BirthDay,gender
                ORDER BY id ASC";
        
        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':id',$keyword ,PDO::PARAM_STR);
        $stmt->bindValue(':name',$keyword ,PDO::PARAM_STR);

        $stmt->execute();

        $data =[];
        while($row=$stmt->fetchObject('user')){
            $data[] =$row;
        }
        return $data;
    }

}