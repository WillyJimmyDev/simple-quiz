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
    
    $quiz->session->set('num',(int) $_POST['num']);
    $num = $quiz->session->get('num');
    
    $numquestions = count($quiz->getQuestions());
    $answers = $quiz->getAnswers($num);
    //sort the array of answers so correct answer is first
    usort($answers, 'answerSort');
    
    $postedanswers = $_POST['answers'];
    
    if ($postedanswers == $answers[0]) //first answer in array is correct one
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
    if ($_SESSION['num'] < $numquestions - 1) 
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