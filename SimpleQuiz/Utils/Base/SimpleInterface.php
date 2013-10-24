<?php
namespace SimpleQuiz\Utils\Base;

interface SimpleInterface {

    public function getQuizzes();
    
    public function getUsers();
    
    public function authAdmin($email, $pass);
    
}
?>
