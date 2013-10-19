<?php
namespace SimpleQuiz\Utils\Base;

interface QuizInterface {
    
    public function setId($id);
    
    public function getId();
    
    public function getAnswers($questionid = false);
    
    public function getQuestion($questionid);
    
    public function getQuestions();
    
    public function populateQuestions();
    
    public function getUsers();
    
    public function getUser($username);
    
    public function getLeaders($num);
    
    public function registerUser($username);
    
    public function createRandomUser();
    
    public function addQuizTaker($user,$score,$start,$end,$timetaken);
}
?>
