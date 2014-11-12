<?php
namespace SimpleQuiz\Utils\Base;

class Config 
{

    //used whe sending emails to users
    static $appname = 'SimpleQuiz';
    static $siteurl = 'http://localhost/simple-quiz/public/';
    static $appEmail = 'admin@simplequiz.co.uk';

    static $templateDir = '../templates';

    //databse credentials
    static $dbhost = 'localhost';
    static $dbname = 'simple-quiz';
    static $dbuser = 'quizmaster';
    static $dbpassword = '3G8bVeH4dS5euTcF';
    static $requireauth = true;//change to false if no auth required for quizzes
    //only used if requireauth == false
    static $defaultUser = 'default';

    //mailer config
    static $mailHost = 'smtp.mandrillapp.com';
    static $mailUser = 'ElanMan';
    static $mailPass = 'upbbmZDadB5r5AEM1XWtxQ';
    static $mailPort = '587';
}