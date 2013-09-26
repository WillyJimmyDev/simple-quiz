<?php 
//processor.php
namespace SimpleQuiz;

 ini_set('display_errors', 1);
 ini_set('error_reporting', E_ALL);
require 'vendor/autoload.php';

$container = new \Pimple();

$container['db'] = $container->share(function() {
    return new \SimpleQuiz\Utils\DB();
});

$container['session'] = $container->share(function($c) {
    return new \SimpleQuiz\Utils\SessionDB($c);
});

$container['leaderboard'] = function($c) {
    return new \SimpleQuiz\Utils\DBLeaderBoard($c);
};

$container['user'] = function($c) { return new \SimpleQuiz\Utils\User($c);};

$container['quiz'] = function ($c) {return \SimpleQuiz\Utils\QuizFactory::getQuiz($c);};

$quiz = $container['quiz'];

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