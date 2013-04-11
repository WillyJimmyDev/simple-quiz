<?php 
//processor.php

include 'functions.php';

$quiz = QuizFactory::getQuiz();

$quiz->session->start();

if ( ! isset($_POST['submitter']) ) 
{
    if ( isset($_POST['register']) ) 
    {
        $username = trim(strip_tags(stripslashes($_POST['username'])));
        $quiz->registerUser($username);
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
    
    $quiz->session->set('num',(int) $_POST['num']);
    $num = $quiz->session->get('num');
    $postedanswers = $_POST['answers'];
    
    if ($postedanswers == $answers[$num]['0']) 
    {
        $score = $quiz->session->get('score');
        $score++;
        $quiz->session->set('score', $score);
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