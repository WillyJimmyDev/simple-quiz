<?php 
//processor.php
/*********Copyright (c) 2009 ElanMan*********/

include 'functions.php';
session_name("Acronym_Test");
session_start();
require('questionsandanswers.php');
$quiz = new Quiz('leaders.xml', $answers, $questions);

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
    $_SESSION['num'] = (int) $_POST['num'];
    $num = $_SESSION['num'];
    $postedanswers = str_replace("_", " ", $_POST['answers']);
    
    if ($postedanswers == $answers[$num]['0']) 
    {
        $_SESSION['score']++;
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