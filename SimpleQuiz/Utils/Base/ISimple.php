<?php
namespace SimpleQuiz\Utils\Base;

interface ISimple {
    
    public function addQuiz(Array $quizmeta);
    
    public function updateQuiz(Array $quizmeta);
    
    public function deleteQuiz($quizid);

    public function getQuizzes($active = true);
    
    public function getCategories($active = true);
    
    public function getCategory($id);
    
    public function getCategoryQuizzes($id);
    
    public function getUsers($quizid = false);
    
}
?>
