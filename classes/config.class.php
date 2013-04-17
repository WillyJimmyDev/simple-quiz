<?php

/*
 * Static Config file for database etc
 * 
 */

class Config 
{
    static $dbhost = 'localhost';
    static $dbname = 'simple-quiz';
    static $dbuser = 'quizmaster';
    static $dbpassword = '3G8bVeH4dS5euTcF';
    
    static $leaderstoshow = 30;
    static $leadersToShowOnFrontPage = 10;
    
    static $poorScoreVerdict = '<p id="verdict"><span>S</span>everely <span>H</span>indered <span>I</span>n the <span>T</span>est!</p>';
    static $averageScoreVerdict = '<p id="verdict"><span>C</span>ould <span>R</span>ead <span>A</span>nd <span>P</span>ractice more.</p>';
    static $goodScoreVerdict = '<p id="verdict"><span>A</span>cronyms a<span>R</span>e <span>S</span>o <span>E</span>asy!</p>';
    static $greatScoreVerdict = '<p id="verdict"><span>S</span>uper <span>A</span>cronym <span>S</span>pecialist</p>';
}
?>
