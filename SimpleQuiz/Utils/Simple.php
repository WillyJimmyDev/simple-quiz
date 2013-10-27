<?php
namespace SimpleQuiz\Utils;

class Simple implements Base\SimpleInterface {
    
    private $_db;
    public $quizzes;
    
    public function __construct(\Slim\Helper\Set $container) 
    {
        $this->_db = $container->db;
    }
    
    public function getQuizzes($active = true) {
        $this->quizzes = array();
        if ($active) {
            $sql = "SELECT id, name, description, active from quizzes where active = 1";
        } else {
            $sql = "SELECT id, name, description, active from quizzes";
        }
        $stmt = $this->_db->query($sql);
        $stmt->execute();
        
        while ($quiz = $stmt->fetchObject())
        {
            array_push($this->quizzes,$quiz);
        }
    }
    
    public function getUsers()
    {
        
    }
}
?>
