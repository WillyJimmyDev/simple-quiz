<?php //index.php
 ini_set('error-reporting', E_ALL);
 ini_set('display_errors', 1);
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

$app = new \Slim\Slim(array(
    'debug' => true,
    'log.enabled' => true
));

$app->get('/', function () use ($app, $container) {
    
    $quiz = $container['quiz'];
    $root = $app->request->getRootUri();
    
    $quiz->session->set('score', 0);
    $quiz->session->set('correct', array()); 
    $quiz->session->set('wrong', array());
    $quiz->session->set('finished','no');
    $quiz->session->set('num',0);
    
    $app->render('index.php',array('quiz' => $quiz,'root' => $root));
});

$app->post('/process', function () use ($app, $container) {
    
    $quiz = $container['quiz'];
    
    $submitter = $app->request()->post('submitter');
    $register = $app->request()->post('register');
    $username = $app->request()->post('username');
    $num = $app->request()->post('num');
    $answers = $app->request()->post('answers');
    
    if ( ! isset($submitter) ) 
    {
        if ( isset($register) ) 
        {
            $username = trim(strip_tags(stripslashes($username)));
            $quiz->registerUser($username);
        } 
        else 
        {
            $quiz->createRandomUser();
        }
    } 
    else 
    {
        $quiz->session->set('num',(int) $num);
        //$num = $quiz->session->get('num');
    
        $numquestions = count($quiz->getQuestions());
        $quizanswers = $quiz->getAnswers($num);
    
        if ($answers == $quizanswers[0]) //first answer in array is correct one
        {
            $score = $quiz->session->get('score');
            $score++;
            $quiz->session->set('score', $score);
            $_SESSION['correct'][] = $answers;
        } 
        else 
        {
            $_SESSION['wrong'][] = $answers;
        }
        if ($_SESSION['num'] < $numquestions) 
        {
            $_SESSION['num']++;
        } 
        else 
        {
            $_SESSION['last'] = true;
            $_SESSION['finished'] = 'yes';
        }
        $app->redirect('test');
    }
});

$app->get('/test', function () use ($app, $container) {
    $root = $app->request->getRootUri();
    $quiz = $container['quiz'];
    $num = $quiz->session->get('num') ? $quiz->session->get('num') : 1;
    
    $app->render('test.php',array('quiz' => $quiz,'num' => $num, 'root' => $root));
});

$app->get('/results', function () use ($app, $container) {
    
    $root = $app->request->getRootUri();
    $quiz = $container['quiz'];
    $quiz->session->set('last', null);

    if( $quiz->session->get('finished') != 'yes' ) 
    {
        $app->redirect($root);
    }

    //destroy the session
    $quiz->session->end();
    
    $app->render('results.php',array('quiz' => $quiz,'root' => $root));
});


$app->run();