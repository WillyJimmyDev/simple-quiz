<?php
namespace SimpleQuiz\Utils;

class LeaderBoard implements Base\LeaderBoardInterface {
    
    private $_db;
    protected $_members = array();
    
    public function __construct(\Slim\Helper\Set $container) 
    {
        $this->_db = $container->db;
    }
    
    public function getMembers($quizid, $number = false)
    {  
        try
        {
            $sql = "select u.name, q.score from users u left join quiz_users q on q.user_id = u.id where q.quiz_id = :quizid order by score desc";
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
    
    public function addMember($quizid, $user,$score,$start,$end,$timetaken)
    {
        $userid = '';
        
        $sql = "select count(name) as num, id from users where name = :user";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':user',$user,\PDO::PARAM_STR);
        $stmt->execute();
        
        if ($row = $stmt->fetchObject())
        {
            if ($row->num == 1) {
                $userid = $row->id;
            }
        } 
        
        if ($userid == '') {
            $sql = "insert into users (name) values(:user)";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':user',$user,\PDO::PARAM_STR);
            $stmt->execute();
            $userid = $this->_db->lastInsertId();
        }
       
        $sql = "insert into quiz_users (quiz_id,user_id,score,start_time,date_submitted,time_taken) values (:quizid,:userid,:score,:start,:end,:timetaken)";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':quizid', $quizid, \PDO::PARAM_INT);
        $stmt->bindParam(':userid',$userid,\PDO::PARAM_STR);
        $stmt->bindParam(':score',$score,\PDO::PARAM_INT);
        $stmt->bindParam(':start',$start,\PDO::PARAM_STR);
        $stmt->bindParam(':end',$end,\PDO::PARAM_STR);
        $stmt->bindParam(':timetaken',$timetaken,\PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
}
?>
