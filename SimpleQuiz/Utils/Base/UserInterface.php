<?php
namespace SimpleQuiz\Utils\Base;

/**
 *
 * @author Ben Hall
 */
interface UserInterface {
    
    public function isAdmin();
    
    public function getQuizzes();
    
    public function getScore($quizid);
    
    public function getName();
    
    public function setName($name);
    
    
}
