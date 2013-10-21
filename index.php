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

// route middleware for simple authentication
//function authenticate(\Slim\Route $route) 
//{
//    $app = \Slim\Slim::getInstance();
//    $uid = $app->getEncryptedCookie('uid');
//    $key = $app->getEncryptedCookie('key');
//    if (validateAdminUser($uid, $key) === false) 
//    {
//      $app->halt(401);
//    }
//}
//
//function validateAdminUser($user, $pass) 
//{
//    if ($uid == 'demo' && $key == 'demo') 
//    {
//        return true;
//    } 
//    else 
//    {
//        return false;
//    }
//}

$app = new \Slim\Slim(array(
    'debug' => true,
    'log.enabled' => true
));

$app->get('/', function () use ($app, $container) {
    
    $root = $app->request->getRootUri();
    $simple = $container['simple'];
    $simple->getQuizzes();
    
    $quizzes = $simple->_quizzes;
    
    $session = $container['session'];
    
    $session->set('score', 0);
    $session->set('correct', array()); 
    $session->set('wrong', array());
    $session->set('finished','no');
    $session->set('num',0);
    $session->set('last', null);
    $session->set('timetaken', null);
    $session->set('starttime',null);
    
    $app->render('index.php', array('root' => $root, 'quizzes' => $quizzes));
});

$app->get('/quiz/:id/', function ($id) use ($app, $container) {
    $root = $app->request->getRootUri();
    
    $quiz = $container['quiz'];
    
    $session = $container['session'];
    
    if ($quiz->setId($id))
    {
        $quiz->populateQuestions();
        $quiz->populateUsers();
        $session->set('quizid', $id);
        $session->set('score', 0);
        $session->set('correct', array()); 
        $session->set('wrong', array());
        $session->set('finished','no');
        $session->set('num',0);
        $session->set('last', null);
        $session->set('timetaken', null);
        $session->set('starttime',null);

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
    
    $session = $container['session'];
    
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
                    $random = $quiz->createRandomUser();
                    
                    $session->set('user', 'Anon' . $random);
                    $session->set('score', 0);
                    $session->set('correct', array()); 
                    $session->set('wrong', array());
                    $session->set('finished','no');
                    $session->set('num',0);
                    $session->set('starttime',date('Y-m-d H:i:s'));
                    
                    $app->redirect($app->request->getRootUri() . '/quiz/'. $id . '/test');
                    
                }
                else 
                {
                    $username = trim(strip_tags(stripslashes($username)));
                    if ( $quiz->registerUser($username))
                    {
                        $session->set('user',$username);
                        $session->set('score', 0);
                        $session->set('correct', array());
                        $session->set('wrong', array());
                        $session->set('finished','no');
                        $session->set('num',0);
                        $session->set('starttime',date('Y-m-d H:i:s'));
                        $session->remove('error');
                        
                        $app->redirect($app->request->getRootUri() . '/quiz/'. $id . '/test');
                    }
                    else
                    {
                        $session->set('error', 'That name is already registered, please choose another.');
                        $app->redirect($app->request->getRootUri() . '/quiz/'. $id);
                    }

                }

            } 
            else 
            {
                $random = $quiz->createRandomUser();
                
                $session->set('user', 'Anon' . $random);
                $session->set('score', 0);
                $session->set('correct', array()); 
                $session->set('wrong', array());
                $session->set('finished','no');
                $session->set('num',0);
                $session->set('starttime',date('Y-m-d H:i:s'));
                
                $app->redirect($app->request->getRootUri() . '/quiz/'. $id . '/test');
            }
        } 
        else 
        {
            $quiz->populateQuestions();
            $quiz->populateUsers();
            $session->set('num',(int) $num);

            $numquestions = count($quiz->getQuestions());
            $quizanswers = $quiz->getAnswers($num);

            if ($answers == $quizanswers[0]) //first answer in array is correct one
            {
                $score = $session->get('score');
                $score++;
                $session->set('score', $score);
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
    
    $session = $container['session'];
    
    if ($session->get('quizid') !== $id)
    {
        $error = 'There has been an error. Please return to the main quiz menu and try again';
        $app->render('quiz/quiz.php',array('error' => $error, 'root' => $root));
    }
    
    if ($quiz->setId($id))
    {
        $quiz->populateQuestions();
        $quiz->populateUsers();
        $timetaken = '';

        $num = $session->get('num') ? $session->get('num') : 1;

        if (isset($_SESSION['last']) &&  $_SESSION['last'] == true)
        {
            //first two vars formatted for insertion into database as datetime fields
            $starttime = $session->get('starttime');
            $endtime = date('Y-m-d H:i:s');

            //store $timetaken in session
            if ( ! isset($_SESSION['timetaken']))
            {
                $end = time();
                $start = strtotime($starttime);
                $time = $end - $start;
                $timetaken = date("i:s", $time);//formatted as minutes:seconds
                $_SESSION['timetaken'] = $timetaken; 

                $quiz->addQuizTaker($session->get('user'),$session->get('score'),$starttime,$endtime,$timetaken);
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
    
    $session = $container['session'];
    
    if ($session->get('quizid') !== $id)
    {
        $error = 'There has been an error. Please return to the main quiz menu and try again';
        $app->render('quiz/quiz.php',array('error' => $error, 'root' => $root));
    }
    
    if($quiz->setId($id))
    {
        $quiz->populateQuestions();
        $quiz->populateUsers();
        $session->set('last', null);

        if( $session->get('finished') != 'yes' ) 
        {
            $app->redirect($app->request->getRootUri());
        }

        //destroy the session
        $session->end();

        $app->render('quiz/results.php',array('quiz' => $quiz, 'root' => $root));
    }
    else
    {
        $error = 'The quiz you have selected does not exist. Return to the main menu to try again';
        $app->render('quiz/quiz.php',array('error' => $error, 'root' => $root));
    }
})->conditions(array('id' => '[0-9]'));

//$app->get('/admin/', function () use ($app) {
//
//    //pseudocode ftw!
//    if(! $validadmin) 
//    {
//        $app->redirect('admin/login');
//    }
//    
//    $app->render('admin/index.php');
//});

$app->get('/admin/login/', function () use ($app) {
    
    $root = $app->request->getRootUri();
    
    $app->render('admin/login.php', array('root' => $root));
});
$app->post('/admin/login/', function () use ($app) {
    
    $root = $app->request->getRootUri();
    
    $app->render('admin/login.php', array('root' => $root));
});
//    
//    //pseudocode ftw!
//    if(! $validadmin) 
//    {
//        $app->redirect('admin/login');
//    }
//});

$app->run();