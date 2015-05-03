<?php
require '../vendor/autoload.php';

ORM::configure('mysql:host=' . \SimpleQuiz\Utils\Base\Config::$dbhost. ';dbname=' . \SimpleQuiz\Utils\Base\Config::$dbname);
ORM::configure('username', \SimpleQuiz\Utils\Base\Config::$dbuser);
ORM::configure('password', \SimpleQuiz\Utils\Base\Config::$dbpassword);
ORM::configure('return_result_sets', true);

$session = new \SimpleQuiz\Utils\Session();

$app = new \Slim\Slim(array(
    'debug' => true,
    'log.enabled' => true,
    'templates.path' => '../templates'
        ));

$app->session = $session;

require '../routes/admin.php';
require '../routes/public.php';

$app->leaderboard = function() {
    return new \SimpleQuiz\Utils\LeaderBoard();
};

$app->quiz = function ($app) {
    return new \SimpleQuiz\Utils\Quiz($app);
};

$app->admin = function ($app) {
    return new \SimpleQuiz\Utils\Admin($app);
};

$app->simple = function () {
    return new \SimpleQuiz\Utils\Simple();
};

$app->installer = function () {
    return new \SimpleQuiz\Utils\Base\Installer();
};

$app->hook('slim.before.dispatch', function() use ($app) { 

    $user = null;
    
    if ($app->session->get('user')) {
       $user = $app->session->get('user');
    }
    
    $app->view()->appendData(['user' => $user]);
    
    $root = $app->request->getRootUri();
    $app->view()->appendData(['root' => $root]);
});

$app->run();
