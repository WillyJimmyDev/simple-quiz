<?php
namespace SimpleQuiz\Utils\Base;

class Config
{

    //used when sending emails to users
    static $appname = 'SimpleQuiz';
    static $siteurl = ''; // e.g https://simplequiz.co.uk/
    static $appEmail = '';// email address used in the 'From' header sent in all emails e.g admin@yoursite.com

    static $emailTemplateDir = '/templates/email/'; // not currently used

    //database credentials . Change as required
    static $dbhost = 'localhost';
    static $dbname = 'simple-quiz';
    static $dbuser = '';
    static $dbpassword = '';

    //mailer config. Change as required.
    /*
    gmail example
    static $mailHost = 'smtp.gmail.com';
    static $mailUser = 'example@gmail.com';
    static $mailPass = '1234';
    static $mailPort = '587';
    */

    static $mailHost = '';
    static $mailUser = '';
    static $mailPass = '';
    static $mailPort = '';
}
