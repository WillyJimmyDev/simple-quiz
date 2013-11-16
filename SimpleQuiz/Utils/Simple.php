<?php
namespace SimpleQuiz\Utils;

class Simple implements Base\SimpleInterface {
    
    public function addQuiz(Array $quizmeta)
    {
        $quiz = \ORM::for_table('quizzes')->create();
        $quiz->name = $quizmeta['name'];
        $quiz->description = $quizmeta['description'];
        $quiz->active = $quizmeta['active']; 
        $quiz->set_expr('created', 'NOW()');
        $quiz->set_expr('updated', 'NOW()');
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
        $quiz->set_expr('updated', 'NOW()');
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
            $quizzes = \ORM::for_table('quizzes')->where('active',1)->find_many();
        } else {
            $quizzes = \ORM::for_table('quizzes')->find_many();
        }
        return $quizzes;
    }
    
    public function getUsers($quizid = false)
    {
        
    }
}
?>
