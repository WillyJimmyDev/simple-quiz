<?php
namespace SimpleQuiz\Utils;

class Simple implements Base\SimpleInterface {
    
    private $_db;
    public $_quizzes = array();
    
    public function __construct(\Slim\Helper\Set $container) 
    {
        $this->_db = $container->db;
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
    
    public function authAdmin($email, $pass)
    {
        $sql = "SELECT name, email, pass from administration where email = :email and pass = :pass";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':pass', sha1($pass), \PDO::PARAM_STR);
        $stmt->execute();
        
//        while ($result = $stmt->fetchObject())
//        {
//            $quizobj = array('id' => $result->id, 'name' => $result->name, 'description' => $result->description);
//            array_push($this->_quizzes,$quizobj);
//        }
    }
}
?>
