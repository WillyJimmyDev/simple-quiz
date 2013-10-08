<?php
namespace SimpleQuiz\Utils\Base;

interface UserInterface {
    
    public function register($username);
    
    public function createRandom();
}
?>
