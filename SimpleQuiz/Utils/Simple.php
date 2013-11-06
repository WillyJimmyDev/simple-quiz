<?php
namespace SimpleQuiz\Utils;

class Simple implements Base\SimpleInterface {
    
    private $_db;
    public $quizzes;
    
    public function __construct(\Slim\Helper\Set $container) 
    {
        $this->_db = $container->db;
    }
    
    public function addQuiz(Array $quizmeta)
    {
        $name = $quizmeta['name'];
        $description = $quizmeta['description'];
        $active = $quizmeta['active'];
        
        $sql = "insert into quizzes (name, description, active) values(:name, :description, :active)";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':name', $name, \PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, \PDO::PARAM_STR);
        $stmt->bindParam(':active', $active, \PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
    
    public function updateQuiz(Array $quizmeta)
    {
        $quizid = $quizmeta['id'];
        $name = $quizmeta['name'];
        $description = $quizmeta['description'];
        $active = $quizmeta['active'];
        
        $sql = "update quizzes set name = :name, description = :description, active = :active where id = :quizid";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':quizid', $quizid, \PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, \PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, \PDO::PARAM_STR);
        $stmt->bindParam(':active', $active, \PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
    
     public function deleteQuiz($quizid)
    {
        $sql = "delete from quizzes where id = :id";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':id', $quizid, \PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
    
    public function getQuizzes($active = true) {
        
        $this->quizzes = array();
        if ($active) {
            $sql = "SELECT quizzes.id, quizzes.name, quizzes.description, quizzes.active from quizzes inner join questions q on quizzes.id = q.quiz_id where quizzes.active = 1 group by quizzes.id having count(q.quiz_id) > 0";
        } else {
            $sql = "SELECT quizzes.id, quizzes.name, quizzes.description, quizzes.active from quizzes left join questions q on quizzes.id = q.quiz_id group by quizzes.id";
        }
        $stmt = $this->_db->query($sql);
        $stmt->execute();
        
        while ($quiz = $stmt->fetchObject())
        {
            array_push($this->quizzes,$quiz);
        }
    }
    
    public function getUsers($quizid = false)
    {
        
    }
}
?>
