<?php 
//processor.php
/*********Copyright (c) 2009 ElanMan*********/

include 'functions.php';
$session = new SessionFactory();
$session->start();

require(Config::$questionsandanswersfile);

$quiz = new Quiz($session,'leaders.xml', $answers, $questions);

if ( ! isset($_POST['submitter']) ) 
{
    if ( isset($_POST['register']) ) 
    {
        $quiz->registerUser();
    } 
    else 
    {
        $quiz->createRandomUser();
    }
} 
else 
{
    $session->set('num',(int) $_POST['num']);
    $num = $session->get('num');
    $postedanswers = str_replace("_", " ", $_POST['answers']);
    
    if ($postedanswers == $answers[$num]['0']) 
    {
        $score = $session->get('score');
        $score++;
        $session->set('score', $score);
        $_SESSION['correct'][] = $postedanswers;
    } 
    else 
    {
        $_SESSION['wrong'][] = $postedanswers;
    }
    if ($_SESSION['num'] < count($questions) - 1) 
    {
        $_SESSION['num']++;
    } 
    else 
    {
        $_SESSION['last'] = true;
        $_SESSION['finished'] = 'yes';
    }
    
    header('Location: test.php');
}
?>