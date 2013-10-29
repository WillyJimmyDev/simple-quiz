<?php
$authenticate = function ($app) {
    
    return function () use ($app) {
        
        if (! $app->session->get('adminuser')) {
            $app->session->set('urlRedirect', $app->request()->getPathInfo());
            $app->flash('error', 'Login required');
            $app->redirect($app->request->getRootUri() . '/admin/login/');
        }
    };
};

$app->get('/admin/', $authenticate($app), function () use ($app) {
    
    $simple = $app->simple;
    $simple->getQuizzes(false);

    $quizzes = $simple->quizzes;

    $app->render('admin/index.php', array('quizzes' => $quizzes));
});

$app->get('/admin/login/', function () use ($app) {
    
    $session = $app->session;

    $app->render('admin/login.php', array('session' => $session));
});

$app->post('/admin/login/', function () use ($app) {
    
    $session = $app->session;
    $errors = array();
    
    $email = trim($app->request()->post('email'));
    $password = trim($app->request()->post('password'));
    
    //need to check for 'emptiness' of inputs and display message instead of querying db
    if ((! empty($email)) && (! empty($password) ) )
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['loginerror'] = "The email was invalid. Please try again.";
        }
        else {
            //process inputs
            $authsql = "SELECT count(id) as num, name FROM users where email = :email and pass = :pass and level = 1";
            $stmt = $app->db->prepare($authsql);
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
            $stmt->bindParam(':pass', sha1($password), \PDO::PARAM_STR);
            $stmt->execute();

            if ($result = $stmt->fetchObject()) {
                if ($result->num != 1) {
                    $errors['loginerror'] = "The email or password do not match those in our system. Please try again.";
                } else {
                    $name = $result->name;
                }

            } else {
                $errors['loginerror'] = "A problem has occurred. Woops!.";
            }
        }
    }
    else {
        $errors['loginerror'] = "Please try again.";
    }
    
    if (count($errors) > 0) {
        $app->flash('errors', $errors);
        $session->remove('user');
        $app->redirect($app->request->getRootUri() . '/admin/login/');
    }
    
    // We have a valid admin user
    $session->set('adminuser', true);
    $session->set('user', $name);
    $session->regenerate();

    // redirect them to intended url if not index
    if ($session->get('urlRedirect')) {
       $tmp = $session->get('urlRedirect');
       $session->remove('urlRedirect');
       $app->redirect($app->request->getRootUri() . $tmp);
    }
    
    //logged in with no url 
    $app->redirect($app->request->getRootUri() . '/admin/');
});

$app->get("/admin/quiz/:id", $authenticate($app), function($id) use ($app) {
    
    $quiz = $app->quiz;
    
    if ($quiz->setId($id)) {
        $quiz->populateQuestions();
        $quiz->populateUsers();
        
        $app->render('admin/quiz.php', array('quiz' => $quiz));
    }
        
})->conditions(array('id' => '[0-9]'));

$app->get("/admin/quiz/:quizid/question/:questionid/edit/", $authenticate($app), function($quizid, $questionid) use ($app) {
   
    $quiz = $app->quiz;
    
    if ($quiz->setId($quizid)) {
        $question = $quiz->getQuestion($questionid);
        $answers = $quiz->getAnswers($questionid);
        $app->render('admin/editquestion.php', array('quizid' => $quizid,'questionid' => $questionid, 'question' => $question, 'answers' => $answers));
    } else {
        echo 'oops';
    }
        
})->conditions(array('quizid' => '\d+', 'questionid' => '\d+'));

$app->post("/admin/quiz/:quizid/question/:questionid/edit/", $authenticate($app), function($quizid, $questionid) use ($app) {
   
    if ( (! ctype_digit($quizid)) || (! ctype_digit($questionid))) {
        $app->redirect($app->request->getRootUri().'/admin/');
    }
    
    $quiz = $app->quiz;
    
    $correct = (int) trim($app->request()->post('correct'));
    $answerarray = $app->request()->post('answer');
    $i = 0;
    foreach ($answerarray as $answer) {
        if ($i == $correct) {
            $correctAnswer = 1;
        } else {
           $correctAnswer = 0;
        }
        $answers[] = array($answer, $correctAnswer);

        $i++;
    }
    
    if ($quiz->setId($quizid)) {
        try {
            $quiz->updateAnswers($answers, $quizid, $questionid);
            $question = $quiz->getQuestion($questionid);
            $app->flashnow('success', 'question updated');
        } catch (Exception $e ) {
            echo $e->getMessage();
        }
        $answers = array();
        $app->render('admin/editquestion.php', array('quizid' => $quizid,'questionid' => $questionid, 'question' => $question, 'answers' => $answers));
    } else {
        echo 'oops';
    }
//    echo '<pre>';
//    
//    print_r($answers);
//
//    echo '</pre>';  
});

$app->get("/logout/", function () use ($app) {
    $session = $app->session;
    $session->end();
    $app->redirect($app->request->getRootUri().'/');
});
