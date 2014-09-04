<?php
namespace SimpleQuiz\Utils\Base;

class Config 
{
    static $dbhost = 'localhost';
    static $dbname = 'simple-quiz';
    static $dbuser = 'quizmaster';
    static $dbpassword = '3G8bVeH4dS5euTcF';
    static $requireauth = true;//change to false if no auth required for quizzes
    //only used if requireauth == false
    static $defaultUser = 'default';
}