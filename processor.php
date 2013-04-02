<?php 
//processor.php

include 'functions.php';

$session = SessionFactory::getsession();
$session->start();

$quiz = new Quiz($session);

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
    $questions = $quiz->getQuestions();
    $answers = $quiz->getAnswers();
    
    $session->set('num',(int) $_POST['num']);
    $num = $session->get('num');
    $postedanswers = $_POST['answers'];
    
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