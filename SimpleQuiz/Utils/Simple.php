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
        $quiz = \ORM::for_table('quizzes')->create();
        $quiz->name = $quizmeta['name'];
        $quiz->description = $quizmeta['description'];
        $quiz->active = $quizmeta['active']; 
        
        $quiz->save();
        return true;
    }
    
    public function updateQuiz(Array $quizmeta)
    {
        $quiz = \ORM::for_table('quizzes')->find_one($quizmeta['id']);
        
        $quiz->set(array(
            'name' => $quizmeta['name'],
            'description'  => $quizmeta['description'],
            'active' => $quizmeta['active']
        ));
        $quiz->save();
   
        return true;
    }
    
     public function deleteQuiz($quizid)
    {
        $quiz = \ORM::for_table('quizzes')->find_one($quizid);
        $quiz->delete();
        return true;
    }
    
    public function getQuizzes($active = true) {
        
        if ($active) {
            $this->quizzes = \ORM::for_table('quizzes')->where('active',1)->find_many();
        } else {
            $this->quizzes = \ORM::for_table('quizzes')->find_many();
        }
    }
    
    public function getUsers($quizid = false)
    {
        
    }
}
?>
