<?php
namespace SimpleQuiz\Utils;

class LeaderBoard implements Base\LeaderBoardInterface {
    
    private $_db;
    protected $_members = array();
    
    public function __construct(\Pimple $container) 
    {
        $this->_db = $container['db'];
    }
    
    public function getMembers($quizid, $number = false)
    {  
        try
        {
            $sql = "select name, score from users where quiz_id = :quizid order by score desc";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':quizid', $quizid, \PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetchObject())
            {
                $this->_members[$row->name]= $row->score;
            }
        }
        catch (\PDOException $e)
        {
            return $e;
        }
        
        if ($number)
        {
            arsort($this->_members,SORT_NUMERIC);
            return array_slice($this->_members, 0, $number, true);
        }
        
        return $this->_members;
    }
    
    public function hasMember($username)
    {
        if (array_key_exists($username,$this->_members) )
        {
           return true;
        }
        return false;
    }
    
    public function addMember($quizid, $user,$score,$start,$end,$timetaken)
    {
        $sql = "insert into users (quiz_id,name,score,start_time,date_submitted,time_taken) values (:quizid,:user,:score,:start, :end,:timetaken)";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':quizid', $quizid, \PDO::PARAM_INT);
        $stmt->bindParam(':user',$user,\PDO::PARAM_STR);
        $stmt->bindParam(':score',$score,\PDO::PARAM_INT);
        $stmt->bindParam(':start',$start,\PDO::PARAM_STR);
        $stmt->bindParam(':end',$end,\PDO::PARAM_STR);
        $stmt->bindParam(':timetaken',$timetaken,\PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
}
?>
