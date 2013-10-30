<?php
namespace SimpleQuiz\Utils\Base;

interface QuizInterface {
    
    public function setId($id);
    
    public function getId();
    
    public function getName();
    
    public function getDescription();
    
    public function isActive();
    
    public function getAnswers($questionid = false);
    
    public function updateAnswers(Array $answers, $quizid, $questionid);
    
    public function deleteAnswers($quizid, $questionid);
    
    public function getQuestion($questionid);
    
    public function getQuestions();
    
    public function populateQuestions();
    
    public function getUsers();
    
    public function getLeaders($num);
    
    public function registerUser($username);
    
    public function addQuizTaker($user,$score,$start,$end,$timetaken);
}
?>
