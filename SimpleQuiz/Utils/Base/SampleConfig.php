<?php
namespace SimpleQuiz\Utils\Base;

class Config
{

    //used whe sending emails to users
    static $appname = 'SimpleQuiz';
    static $siteurl = '';
    static $appEmail = '';

    static $templateDir = '../templates';

    //database credentials
    static $dbhost = 'localhost';
    static $dbname = 'simple-quiz';
    static $dbuser = '';
    static $dbpassword = '';
    static $requireauth = true;//change to false if no auth required for quizzes
    //only used if requireauth == false
    static $defaultUser = 'default';

    //mailer config
    static $mailHost = '';
    static $mailUser = '';
    static $mailPass = '';
    static $mailPort = '';
}
