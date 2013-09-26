<?php
namespace SimpleQuiz\Utils;

class DBLeaderBoard extends LeaderBoard
{
    private $_db;
    
    public function __construct(\Pimple $container) 
    {
        try
        {
            $this->_db = $container['db'];
            $sql = "select name, score from users order by score desc";
            $stmt = $this->_db->query($sql);
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
    }
    
    public function addMember($user,$score)
    {
        $sql = "insert into users (name,score,date_submitted) values (:user,:score, now())";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':user',$user,\PDO::PARAM_STR);
        $stmt->bindParam(':score',$score,\PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
}
?>
