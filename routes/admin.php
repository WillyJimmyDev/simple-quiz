<?php
$authenticate = function ($app) {
    
    return function () use ($app) {
        
        if (! $app->session->get('adminuser')) {
            $app->session->set('urlRedirect', $app->request()->getPathInfo());
            $app->flash('loginerror', 'Login required');
            $app->redirect($app->request->getRootUri() . '/admin/login/');
        }
    };
};

$app->get('/admin/', $authenticate($app), function () use ($app) {
    
    $session = $app->session;
    $simple = $app->simple;
    $simple->getQuizzes(false);

    $quizzes = $simple->quizzes;

    $app->render('admin/index.php', array('quizzes' => $quizzes));
});

$app->get('/admin/login/', function () use ($app) {
    
    $session = $app->session;
    
    $flash = $app->view()->getData('flash');

    $app->render('admin/login.php', array('session' => $session));
});

$app->post('/admin/login/', function () use ($app) {
    
    $session = $app->session;
    $errors = array();
    
    $email = $app->request()->post('email');
    $password = $app->request()->post('password');
    
    //need to check for 'emptiness' of inputs and display message instead of querying db
    if ((! empty($email)) && (! empty($password) ) )
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['loginerror'] = "The email was invalid. Please try again.";
        }
        else {
            //process inputs
            $authsql = "SELECT count(id) as num FROM administration where email = :email and pass = :pass";
            $stmt = $app->db->prepare($authsql);
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
            $stmt->bindParam(':pass', sha1($password), \PDO::PARAM_STR);
            $stmt->execute();

            if ($result = $stmt->fetchObject()) {
                if ($result->num != 1) {
                    $errors['loginerror'] = "The email or password do not match those in our system. Please try again.";
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
    $session->set('adminuser', $email);
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
    
    $session = $app->session;
    $quiz = $app->quiz;
    
    if ($quiz->setId($id)) {
        $quiz->populateQuestions();
        $quiz->populateUsers();
        
        $app->render('admin/quiz.php', array('quiz' => $quiz));
    }
        
})->conditions(array('id' => '[0-9]'));

$app->get("/logout/", function () use ($app) {
    $session = $app->session;
    $session->end();
    $app->render('admin/logout.php');
});
