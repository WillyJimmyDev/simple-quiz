<?php //index.php
ini_set('error-reporting', E_ALL);
ini_set('display_errors', 1);
require 'vendor/autoload.php';

$container = new \Pimple();

$container['db'] = $container->share(function() {
    return new \SimpleQuiz\Utils\Base\DB();
});

$container['session'] = $container->share(function($c) {
    return new \SimpleQuiz\Utils\SessionDB($c);
});

$container['leaderboard'] = function($c) {
    return new \SimpleQuiz\Utils\DBLeaderBoard($c);
};

$container['user'] = function($c) { return new \SimpleQuiz\Utils\User($c);};

$container['quiz'] = function ($c) {return new \SimpleQuiz\Utils\Quiz($c);};

$container['admin'] = function ($c) {return new \SimpleQuiz\Utils\Admin($c);};

$container['auth'] = function ($c) {return new \SimpleQuiz\Utils\Auth($c);};


$app = new \Slim\Slim(array(
    'debug' => true,
    'log.enabled' => true
));

$app->get('/', function () use ($app, $container) {
    
    $quiz = $container['quiz'];
    
    $quiz->session->set('score', 0);
    $quiz->session->set('correct', array()); 
    $quiz->session->set('wrong', array());
    $quiz->session->set('finished','no');
    $quiz->session->set('num',0);
    $quiz->session->set('last', null);
    $quiz->session->set('timetaken', null);
    $quiz->session->set('starttime',null);
    
    $app->render('index.php',array('quiz' => $quiz));
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
    
    $timetaken = '';
    $quiz = $container['quiz'];
    $num = $quiz->session->get('num') ? $quiz->session->get('num') : 1;
    
    if (isset($_SESSION['last']) &&  $_SESSION['last'] == true)
    {
        //first two vars formatted for insertion into database as datetime fields
        $starttime = $quiz->session->get('starttime');
        $endtime = date('Y-m-d H:i:s');
        
        //store $timetaken in session
        if ( ! isset($_SESSION['timetaken']))
        {
            $end = time();
            $start = strtotime($starttime);
            $time = $end - $start;
            $timetaken = date("i:s", $time);//formatted as minutes:seconds
            $_SESSION['timetaken'] = $timetaken; 
            
            $quiz->addQuizTaker($quiz->session->get('user'),$quiz->session->get('score'),$starttime,$endtime,$timetaken);
        }
        else
        {
            $timetaken = $_SESSION['timetaken'];
        }
    }
    
    $app->render('test.php',array('quiz' => $quiz,'num' => $num,'timetaken' => $timetaken));
});

$app->get('/results', function () use ($app, $container) {
    
    $quiz = $container['quiz'];
    $quiz->session->set('last', null);

    if( $quiz->session->get('finished') != 'yes' ) 
    {
        $app->redirect($app->request->getRootUri());
    }

    //destroy the session
    $quiz->session->end();
    
    $app->render('results.php',array('quiz' => $quiz));
});

$app->get('/admin', function () use ($app, $container) {
    
    $admin = $container['admin'];

    if(! $quiz->session->get('admin')) 
    {
        $app->redirect('admin/login');
    }
    
    $app->render('admin/index.php');
});

$app->get('/admin/login', function () use ($app) {
    
    $app->render('admin/login.php');
});
$app->post('/admin/login', function () use ($app, $container) {
    //$auth = $container['auth'];
    return $app->render('admin/login.php');
});

$app->run();