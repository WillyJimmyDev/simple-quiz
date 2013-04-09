<?php

class DBLeaderBoard extends LeaderBoard
{
    private $_db;
    
    public function __construct() 
    {
        try
        {
            $this->_db = new PDO('mysql:host='.Config::$dbhost.';dbname='.Config::$dbname,  Config::$dbuser,  Config::$dbpassword);
            $sql = "select name, score from users order by score desc";
            $stmt = $this->_db->query($sql);
            $stmt->execute();
            while ($row = $stmt->fetchObject())
            {
                $this->_members[] .= array($row->name, $row->score);
            }
        }
        catch (PDOException $e)
        {
            return $e;
        }
    }
    
    public function addMember($user,$score)
    {
        $sql = "insert into users (name,score,date_submitted) values (:user,:score, now())";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':user',$user,PDO::PARAM_STR);
        $stmt->bindParam(':score',$score,PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
}
?>
