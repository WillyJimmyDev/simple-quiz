<?php
namespace SimpleQuiz\Utils;

class Simple implements Base\SimpleInterface {
    
    private $_db;
    public $_quizzes = array();
    
    public function __construct(\Pimple $container) 
    {
        $this->_db = $container['db'];
    }
    
    public function getQuizzes() {
        
        $sql = "SELECT id, name, description from quizzes";
        $stmt = $this->_db->query($sql);
        $stmt->execute();
        
        while ($result = $stmt->fetchObject())
        {
            $quizobj = array('id' => $result->id, 'name' => $result->name, 'description' => $result->description);
            array_push($this->_quizzes,$quizobj);
        }
    }
    
    public function getUsers()
    {
        
    }
}
?>
