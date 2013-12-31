<?php
namespace SimpleQuiz\Utils\Base;

interface SimpleInterface {
    
    public function addQuiz(Array $quizmeta);
    
    public function updateQuiz(Array $quizmeta);
    
    public function deleteQuiz($quizid);

    public function getQuizzes($active = true);
    
    public function getUsers($quizid = false);
    
}
?>
