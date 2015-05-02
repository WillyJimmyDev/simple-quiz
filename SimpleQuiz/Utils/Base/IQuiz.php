<?php
namespace SimpleQuiz\Utils\Base;

interface IQuiz {
    
    public function setId($id);
    
    public function getId();
    
    public function getName();
    
    public function getDescription();
    
    public function isActive();

    public function getAllAnswersGroupedByQuestion();

    public function getAnswers($questionid);
    
    public function addAnswers($questionid, Array $answers);
    
    public function addQuestion($question, $type, Array $answers);
    
    public function updateQuestion ($questionnum, $text);
    
    public function deleteQuestion($questionid);
    
    public function updateAnswers(Array $answers, $questionid);
    
    public function deleteAnswers($questionid);
    
    public function getQuestion($questionid);

    public function getQuestions();
    
    public function countQuestions();
    
    public function getCategory();
    
    public function populateQuestions();
    
    public function getUsers();
    
    public function getLeaders($num);
    
    public function addQuizTaker(User $user,$score,$start,$end,$timetaken);
}
