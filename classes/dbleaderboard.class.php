<?php

class DBLeaderBoard implements LeaderBoard
{
    private $_db;
    private $_members = array();
    
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
    
    //should combine getMembers with getLeaders(default number param)
    public function getMembers()
    {   
        return $this->_members;
    }
    
    public function getLeaders($number);
    public function addMember($user,$score);
    public function hasMember();
}
?>
