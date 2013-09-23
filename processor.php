<?php 
//processor.php
require 'vendor/autoload.php';

$container = new Pimple();

$container['db'] = $container->share(function() {
    return new PDO('mysql:host='.Config::$dbhost.';dbname='.Config::$dbname,  Config::$dbuser,  Config::$dbpassword);
});

$container['session'] = $container->share(function($c) {
    return new SessionDB($c);
});

$container['leaderboard'] = function($c) {
    return new DBLeaderBoard($c);
};

$container['user'] = function($c) { return new User($c);};

$container['Quiz'] = function ($c) {return QuizFactory::getQuiz($c);};

$quiz = $container['Quiz'];

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