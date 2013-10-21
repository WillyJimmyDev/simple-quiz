<?php //index.php
//ini_set('error-reporting', E_ALL);
//ini_set('display_errors', 1);
require 'vendor/autoload.php';

$container = new \Pimple();

$container['db'] = $container->share(function() {
    return new \SimpleQuiz\Utils\Base\DB();
});

$container['session'] = $container->share(function($c) {
    return new \SimpleQuiz\Utils\Session($c);
});

$container['leaderboard'] = function($c) {
    return new \SimpleQuiz\Utils\LeaderBoard($c);
};

$container['quiz'] = function ($c) {return new \SimpleQuiz\Utils\Quiz($c);};

$container['admin'] = function ($c) {return new \SimpleQuiz\Utils\Admin($c);};

$container['auth'] = function ($c) {return new \SimpleQuiz\Utils\Auth($c);};

$container['simple'] = function ($c) {return new \SimpleQuiz\Utils\Simple($c);};

$app = new \Slim\Slim(array(
    'debug' => true,
    'log.enabled' => true
));

$app->get('/', function () use ($app, $container) {
    
    $root = $app->request->getRootUri();
    $simple = $container['simple'];
    $simple->getQuizzes();
    
    $quizzes = $simple->_quizzes;
    
    $quiz = $container['quiz'];
    
    $quiz->session->set('score', 0);
    $quiz->session->set('correct', array()); 
    $quiz->session->set('wrong', array());
    $quiz->session->set('finished','no');
    $quiz->session->set('num',0);
    $quiz->session->set('last', null);
    $quiz->session->set('timetaken', null);
    $quiz->session->set('starttime',null);
    
    $app->render('index.php', array('root' => $root, 'quizzes' => $quizzes));
});

$app->get('/quiz/:id/', function ($id) use ($app, $container) {
    $root = $app->request->getRootUri();
    
    $quiz = $container['quiz'];
    
    if ($quiz->setId($id))
    {
        $quiz->populateQuestions();
        $quiz->populateUsers();
        $quiz->session->set('quizid', $id);
        $quiz->session->set('score', 0);
        $quiz->session->set('correct', array()); 
        $quiz->session->set('wrong', array());
        $quiz->session->set('finished','no');
        $quiz->session->set('num',0);
        $quiz->session->set('last', null);
        $quiz->session->set('timetaken', null);
        $quiz->session->set('starttime',null);

        $app->render('quiz/quiz.php',array('quiz' => $quiz, 'root' => $root));
    }
    else
    {
        $error = 'The quiz you have selected does not exist. Return to the main menu to try again';
        $app->render('quiz/quiz.php',array('error' => $error, 'root' => $root));
        
    }
})->conditions(array('id' => '[0-9]'));

$app->post('/quiz/process/', function () use ($app, $container) {
    
    $id = $app->request()->post('quizid');
   
    if (! ctype_digit($id))
    {
        $app->redirect($app->request->getRootUri()); 
    }
    
    $quiz = $container['quiz'];
    
    if ($quiz->setId($id))
    {
        $submitter = $app->request()->post('submitter');
        $register = $app->request()->post('register');
        $username = $app->request()->post('username');
        $num = $app->request()->post('num');
        $answers = $app->request()->post('answers');

        if ( ! isset($submitter) ) 
        {
            if ( isset($register) ) 
            {
                if (empty($username))
                {
                    if ($quiz->createRandomUser())
                    {
                        $app->redirect($app->request->getRootUri() . '/quiz/'. $id . '/test');
                    }

                }
                else 
                {
                    $username = trim(strip_tags(stripslashes($username)));
                    if ( $quiz->registerUser($username))
                    {
                        $app->redirect($app->request->getRootUri() . '/quiz/'. $id . '/test');
                    }

                }

            } 
            else 
            {
                if ($quiz->createRandomUser())
                {
                    $app->redirect($app->request->getRootUri() . '/quiz/'. $id . '/test');
                }
            }
        } 
        else 
        {
            $quiz->populateQuestions();
            $quiz->populateUsers();
            $quiz->session->set('num',(int) $num);

            $numquestions = count($quiz->getQuestions());
            $quizanswers = $quiz->getAnswers($num);

            if ($answers == $quizanswers[0]) //first answer in array is correct one
            {
                $score = $quiz->session->get('score');
                $score++;
                $quiz->session->set('score', $score);
                $_SESSION['correct'][$num] = array($answers);
            } 
            else 
            {
                $_SESSION['wrong'][$num] = array($answers);
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
            $app->redirect($app->request->getRootUri() . '/quiz/' . $id . '/test');
        }
    }
    else
    {
        $error = 'The quiz you have selected does not exist. Return to the main menu to try again';
        $app->render('quiz/quiz.php',array('error' => $error, 'root' => $root));
    }
});

$app->get('/quiz/:id/test/', function ($id) use ($app, $container) {
   
    $root = $app->request->getRootUri();
    
    $quiz = $container['quiz'];
    
    if ($quiz->session->get('quizid') !== $id)
    {
        $error = 'There has been an error. Please return to the main quiz menu and try again';
        $app->render('quiz/quiz.php',array('error' => $error, 'root' => $root));
    }
    
    if ($quiz->setId($id))
    {
        $quiz->populateQuestions();
        $quiz->populateUsers();
        $timetaken = '';

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

        $app->render('quiz/test.php',array('quiz' => $quiz,'num' => $num,'timetaken' => $timetaken,'root' => $root));
    }
    else
    {
        $error = 'The quiz you have selected does not exist. Return to the main menu to try again';
        $app->render('quiz/quiz.php',array('error' => $error, 'root' => $root));
    }
})->conditions(array('id' => '[0-9]'));

$app->get('/quiz/:id/results/', function ($id) use ($app, $container) {
    
    $root = $app->request->getRootUri();
    
    $quiz = $container['quiz'];
    
    if ($quiz->session->get('quizid') !== $id)
    {
        $error = 'There has been an error. Please return to the main quiz menu and try again';
        $app->render('quiz/quiz.php',array('error' => $error, 'root' => $root));
    }
    
    if($quiz->setId($id))
    {
        $quiz->populateQuestions();
        $quiz->populateUsers();
        $quiz->session->set('last', null);

        if( $quiz->session->get('finished') != 'yes' ) 
        {
            $app->redirect($app->request->getRootUri());
        }

        //destroy the session
        $quiz->session->end();

        $app->render('quiz/results.php',array('quiz' => $quiz, 'root' => $root));
    }
    else
    {
        $error = 'The quiz you have selected does not exist. Return to the main menu to try again';
        $app->render('quiz/quiz.php',array('error' => $error, 'root' => $root));
    }
})->conditions(array('id' => '[0-9]'));

$app->get('/admin/', function () use ($app, $container) {
    
    $admin = $container['admin'];

    if(! $quiz->session->get('admin')) 
    {
        $app->redirect('admin/login');
    }
    
    $app->render('admin/index.php');
});

$app->get('/admin/login/', function () use ($app) {
    
    $app->render('admin/login.php');
});
$app->post('/admin/login/', function () use ($app, $container) {
    //$auth = $container['auth'];
    return $app->render('admin/login.php');
});

$app->run();