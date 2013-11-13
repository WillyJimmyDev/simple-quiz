<?php
namespace SimpleQuiz\Utils;
/**
 *
 * @author Ben Hall
 */

class User implements Base\UserInterface {
    
    private $name;
    private $quizzes;
    
    public function isAdmin();
    
    public function getQuizzes()
    {
        return $this->quizzes;
    }
    
    public function getScore($quizid);
    
    public function getName() 
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
}
