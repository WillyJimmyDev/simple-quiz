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

$app->get("/logout/", function () use ($app) {
    $session = $app->session;
    $session->end();
    $app->redirect($app->request->getRootUri().'/');
});

$app->get('/admin/', $authenticate($app), function () use ($app) {
    
    $simple = $app->simple;
    $quizzes = $simple->getQuizzes(false);

    $app->render('admin/index.php', array('quizzes' => $quizzes));
});

$app->post("/admin/quiz/", $authenticate($app), function() use ($app) {
    
    $quizmeta = array();
    
    $quizname = trim($app->request->post('quizname'));
    $quizdescription = trim($app->request->post('description'));
    $active = (int) trim($app->request()->post('active'));
    
    if ( ($quizname !== '') && ($quizdescription !== '') ) {
        $quizmeta['name'] = ucwords($quizname);
        $quizmeta['description'] = $quizdescription;
        $quizmeta['active'] = $active;
        
        $simple = $app->simple;
    
        if ($simple->addQuiz($quizmeta)) {
            $app->flash('success', 'Quiz has been created successfully');

            $app->redirect($app->request->getRootUri().'/admin/');
        } else {
            //problem adding quiz
            $app->flash('error', 'Problem creating the quiz');
            $app->redirect($app->request->getRootUri().'/admin/');
        }
    } else {
        //problem with post inputs
        $app->flash('error', 'Problem creating the quiz. Something wrong wth inputs');
        $app->redirect($app->request->getRootUri().'/admin/');
    }
        
});

$app->put("/admin/quiz/", $authenticate($app), function() use ($app) {
    
    $quizmeta = array();
    
    $quizid = trim($app->request->put('quizid'));
    $quizname = trim($app->request->put('quizname'));
    $quizdescription = trim($app->request->put('description'));
    $active = (int) trim($app->request()->put('active'));
    
    if ( ($quizname !== '') && ($quizdescription !== '') && (ctype_digit($quizid)) ) {
        
        $quizmeta['id'] = $quizid;
        $quizmeta['name'] = ucwords($quizname);
        $quizmeta['description'] = $quizdescription;
        $quizmeta['active'] = $active;
        
        $simple = $app->simple;
    
        if ($simple->updateQuiz($quizmeta)) {
            $app->flash('success', 'Quiz has been updated');

            $app->redirect($app->request->getRootUri().'/admin/');
        } else {
            //problem adding quiz
            $app->flash('error', 'Problem updating the quiz');
            $app->redirect($app->request->getRootUri().'/admin/');
        }
    } else {
        //problem with post inputs
        $app->flash('error', 'Problem updating the quiz. Something wrong wth inputs');
        $app->redirect($app->request->getRootUri().'/admin/');
    }
        
});

$app->delete("/admin/quiz/", $authenticate($app), function() use ($app) {
    
    $quizid = trim($app->request->post('quizid'));
    
    if (ctype_digit($quizid) ) {
        
        $simple = $app->simple;
        try {
            $simple->deleteQuiz($quizid);
        } catch (Exception $e ) {
            echo json_encode(array('error' => $e->getMessage()));
        }
        echo json_encode(array('success' => 'Quiz has been deleted successfully'));
        $app->stop();
        
    } else {
        echo json_encode(array('error' => 'non-int quiz'));
    }
        
});

$app->get("/admin/quiz/:id/", $authenticate($app), function($id) use ($app) {
    
    $quiz = $app->quiz;
    
    if ($quiz->setId($id)) {
        $quiz->populateQuestions();
        $quiz->populateUsers();
        
        $app->render('admin/quiz.php', array('quiz' => $quiz));
    }
        
})->conditions(array('id' => '\d+'));

$app->put("/admin/quiz/:id/", $authenticate($app), function($id) use ($app) {
    
    $questionid = $app->request->put('questionid');
    $text = $app->request->put('questiontext');
    
    if (! ctype_digit($id)) {
        $app->redirect($app->request->getRootUri().'/admin/');
    }
    
    $quiz = $app->quiz;
    
    if ($quiz->setId($id)) {
        
        if ( (! ctype_digit($questionid)) || (trim($text) == '') ) {
            $app->redirect($app->request->getRootUri().'/admin/');
        }
        try {
            $quiz->updateQuestion($questionid, $text);
            $app->flashnow('success', 'Question saved successfully');
        } catch (Exception $e ) {
            $app->flashnow('error', $e->getMessage());
        }
        $quiz->populateQuestions();
        $quiz->populateUsers();
        $app->render('admin/quiz.php', array('quiz' => $quiz));
        
    }
        
});

$app->post("/admin/quiz/:id/", $authenticate($app), function($id) use ($app) {
    
    if  (! ctype_digit($id)) {
        $app->redirect($app->request->getRootUri().'/admin/');
    }
    
    $quiz = $app->quiz;
    
    $question = trim($app->request->post('questiontext'));
    $correct = (int) trim($app->request()->post('correct'));
    $answerarray = $app->request()->post('answer');
    
    if ($quiz->setId($id)) {
        
        $i = 0;
        foreach ($answerarray as $answer) {
            if (trim($answer) == '') {
                $app->flashnow('error', "Answers can't be empty");
                $app->render('admin/quiz.php', array('quiz' => $quiz));
                $app->stop();
            }
            if ($i == $correct) {
                $correctAnswer = 1;
            } else {
               $correctAnswer = 0;
            }
            $answers[] = array($answer, $correctAnswer);

            $i++;
        }
        try {
            $quiz->addQuestion($question, $answers);
            $app->flashnow('success', 'New Question saved successfully');
        } catch (Exception $e ) {
            $app->flashnow('error', 'An error occurred creating a new question');
            $app->flashnow('error', $e->getMessage());
        }
        
        $quiz->populateQuestions();
        $quiz->populateUsers();
   
        $app->render('admin/quiz.php', array('quiz' => $quiz));
    } else {
        echo 'oops';
    }
        
});

$app->delete("/admin/quiz/:id/", $authenticate($app), function($id) use ($app) {
    
    $questionid = $app->request->post('questionid');
            
    if (! ctype_digit($id)) {
        $app->redirect($app->request->getRootUri().'/admin/');
    }
    
    $quiz = $app->quiz;
    
    if ($quiz->setId($id)) {
        
        try {
            $quiz->deleteQuestion($questionid);
        } catch (Exception $e ) {
            echo json_encode(array('error' => $e->getMessage()));
        }
        echo json_encode(array('success' => 'Question successfully deleted'));
        $app->stop();
    }
        
});

$app->get("/admin/quiz/:quizid/question/:questionid/edit/", $authenticate($app), function($quizid, $questionid) use ($app) {
   
    $quiz = $app->quiz;
    
    if ($quiz->setId($quizid)) {
        $question = $quiz->getQuestion($questionid);
        $answers = $quiz->getAnswers($questionid);
        $app->render('admin/editanswers.php', array('quizid' => $quizid,'questionid' => $questionid, 'question' => $question, 'answers' => $answers));
    } else {
        echo 'oops';
    }
        
})->conditions(array('quizid' => '\d+', 'questionid' => '\d+'));

$app->put("/admin/quiz/:quizid/question/:questionid/edit/", $authenticate($app), function($quizid, $questionid) use ($app) {
   
    if ( (! ctype_digit($quizid)) || (! ctype_digit($questionid))) {
        $app->redirect($app->request->getRootUri().'/admin/');
    }
    
    $quiz = $app->quiz;
    
    $correct = (int) trim($app->request()->put('correct'));
    $answerarray = $app->request()->put('answer');
    
    if ($quiz->setId($quizid)) {
        $question = $quiz->getQuestion($questionid);
        $i = 0;
        foreach ($answerarray as $answer) {
            if (trim($answer) == '') {
                $app->flashnow('error', 'Answers can\'t be empty');
                $answers = $quiz->getAnswers($questionid);
                $app->render('admin/editanswers.php', array('quizid' => $quizid,'questionid' => $questionid, 'question' => $question, 'answers' => $answers));
                $app->stop();
            }
            if ($i == $correct) {
                $correctAnswer = 1;
            } else {
               $correctAnswer = 0;
            }
            $answers[] = array($answer, $correctAnswer);

            $i++;
        }
        try {
            $quiz->updateAnswers($answers, $questionid);
            $app->flashnow('success', 'Answers saved successfully');
        } catch (Exception $e ) {
            $app->flashnow('error', 'An error occurred');
        }
        $answers = $quiz->getAnswers($questionid);
        $app->render('admin/editanswers.php', array('quizid' => $quizid,'questionid' => $questionid, 'question' => $question, 'answers' => $answers));
    } else {
        echo 'oops';
    }
});