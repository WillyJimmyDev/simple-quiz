<?php
$app->get('/', function () use ($app) {

    $simple = $app->simple;
    $simple->getQuizzes(true);

    $quizzes = $simple->quizzes;

    $session = $app->session;

    $app->render('index.php', array('quizzes' => $quizzes, 'session' => $session));
});

$app->get('/quiz/:id/', function ($id) use ($app) {
    
    //$flash = $app->view()->getData('flash');
    
    $quiz = $app->quiz;

    $session = $app->session;

    if ($quiz->setId($id)) {
        $quiz->populateQuestions();
        $quiz->populateUsers();
        $session->set('quizid', $id);
        $session->set('score', 0);
        $session->set('correct', array());
        $session->set('wrong', array());
        $session->set('finished', 'no');
        $session->set('num', 0);
        $session->set('last', null);
        $session->set('timetaken', null);
        $session->set('starttime', null);

        $app->render('quiz/quiz.php', array('quiz' => $quiz, 'session' => $session));
    } else {
        $app->flash('quizerror','There has been an error. Please return to the main quiz menu and try again');
        $app->render('quiz/quiz.php', array('session' => $session));
    }
})->conditions(array('id' => '[0-9]'));

$app->post('/quiz/process/', function () use ($app) {

    $id = $app->request()->post('quizid');

    if (!ctype_digit($id)) {
        $app->redirect($app->request->getRootUri());
    }

    $quiz = $app->quiz;

    $session = $app->session;

    if ($quiz->setId($id)) {
        $submitter = $app->request()->post('submitter');
        $register = $app->request()->post('register');
        $username = $app->request()->post('username');
        $num = $app->request()->post('num');
        $answers = $app->request()->post('answers');

        if (!isset($submitter)) {
            if (isset($register)) {
                if (empty($username)) {
                    $random = rand(1, 1000);

                    $session->set('user', 'Anon' . $random);
                    $session->set('score', 0);
                    $session->set('correct', array());
                    $session->set('wrong', array());
                    $session->set('finished', 'no');
                    $session->set('num', 0);
                    $session->set('starttime', date('Y-m-d H:i:s'));

                    $app->redirect($app->request->getRootUri() . '/quiz/' . $id . '/test');
                } else {
                    $username = trim(strip_tags(stripslashes($username)));
                    if ($quiz->registerUser($username)) {
                        $session->set('user', $username);
                        $session->set('score', 0);
                        $session->set('correct', array());
                        $session->set('wrong', array());
                        $session->set('finished', 'no');
                        $session->set('num', 0);
                        $session->set('starttime', date('Y-m-d H:i:s'));

                        $app->redirect($app->request->getRootUri() . '/quiz/' . $id . '/test');
                    } else {
                        $app->flash('usererror', 'That name is already registered, please choose another.');
                        $app->redirect($app->request->getRootUri() . '/quiz/' . $id);
                    }
                }
            } else {
                $random = rand(1, 1000);

                $session->set('user', 'Anon' . $random);
                $session->set('score', 0);
                $session->set('correct', array());
                $session->set('wrong', array());
                $session->set('finished', 'no');
                $session->set('num', 0);
                $session->set('starttime', date('Y-m-d H:i:s'));

                $app->redirect($app->request->getRootUri() . '/quiz/' . $id . '/test');
            }
        } else {
            $quiz->populateQuestions();
            $quiz->populateUsers();
            $session->set('num', (int) $num);

            $numquestions = count($quiz->getQuestions());
            $quizanswers = $quiz->getAnswers($num);

            if ($answers == $quizanswers[0]) { //first answer in array is correct one
                $score = $session->get('score');
                $score++;
                $session->set('score', $score);
                $_SESSION['correct'][$num] = array($answers);
            } else {
                $_SESSION['wrong'][$num] = array($answers);
            }
            if ($_SESSION['num'] < $numquestions) {
                $_SESSION['num'] ++;
            } else {
                $_SESSION['last'] = true;
                $_SESSION['finished'] = 'yes';
            }
            $app->redirect($app->request->getRootUri() . '/quiz/' . $id . '/test');
        }
    } else {
        $app->flash('quizerror','There has been an error. Please return to the main quiz menu and try again');
        $app->render('quiz/quiz.php', array('session' => $session));
    }
});

$app->get('/quiz/:id/test/', function ($id) use ($app) {

    $quiz = $app->quiz;

    $session = $app->session;

    if ($session->get('quizid') !== $id) {
        $app->flash('quizerror','There has been an error. Please return to the main quiz menu and try again');
        $app->render('quiz/quiz.php', array('quiz' => $quiz, 'session' => $session));
        $app->stop();
    }

    if ($quiz->setId($id)) {
        $quiz->populateQuestions();
        $quiz->populateUsers();
        $timetaken = '';

        $num = $session->get('num') ? $session->get('num') : 1;

        if (isset($_SESSION['last']) && $_SESSION['last'] == true) {
            //first two vars formatted for insertion into database as datetime fields
            $starttime = $session->get('starttime');
            $endtime = date('Y-m-d H:i:s');

            //store $timetaken in session
            if (!isset($_SESSION['timetaken'])) {
                $end = time();
                $start = strtotime($starttime);
                $time = $end - $start;
                $timetaken = date("i:s", $time); //formatted as minutes:seconds
                $_SESSION['timetaken'] = $timetaken;

                $quiz->addQuizTaker($session->get('user'), $session->get('score'), $starttime, $endtime, $timetaken);
            } else {
                $timetaken = $_SESSION['timetaken'];
            }
        }

        $app->render('quiz/test.php', array('quiz' => $quiz, 'num' => $num, 'timetaken' => $timetaken, 'session' => $session));
    } else {
        $app->flash('quizerror','The quiz you have selected does not exist. Return to the main menu to try again');
        $app->render('quiz/quiz.php', array( 'session' => $session));
    }
})->conditions(array('id' => '[0-9]'));

$app->get('/quiz/:id/results/', function ($id) use ($app) {

    $quiz = $app->quiz;

    $session = $app->session;

    if ($session->get('quizid') !== $id) {
        $app->flash('quizerror','There has been an error. Please return to the main quiz menu and try again');
        $app->render('quiz/quiz.php', array('quiz' => $quiz, 'session' => $session));
    }

    if ($quiz->setId($id)) {
        $quiz->populateQuestions();
        $quiz->populateUsers();
        $session->set('last', null);

        if ($session->get('finished') != 'yes') {
            $app->redirect($app->request->getRootUri());
        }

        //destroy the session
        $session->end();

        $app->render('quiz/results.php', array('quiz' => $quiz, 'session' => $session));
    } else {
        $app->flash('quizerror','The quiz you have selected does not exist. Return to the main menu to try again');
        $app->render('quiz/quiz.php', array('quiz' => $quiz, 'session' => $session));
    }
})->conditions(array('id' => '[0-9]'));