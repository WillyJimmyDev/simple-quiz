<?php
//index.php
ini_set('error-reporting', E_ALL);
ini_set('display_errors', 1);
require '../vendor/autoload.php';

ORM::configure('mysql:host=' . \SimpleQuiz\Utils\Base\Config::$dbhost. ';dbname=' . \SimpleQuiz\Utils\Base\Config::$dbname);
ORM::configure('username', \SimpleQuiz\Utils\Base\Config::$dbuser);
ORM::configure('password', \SimpleQuiz\Utils\Base\Config::$dbpassword);
ORM::configure('return_result_sets', true);

//$db = new \SimpleQuiz\Utils\Base\DB();
$session = new \SimpleQuiz\Utils\Session();

$app = new \Slim\Slim(array(
    'debug' => true,
    'log.enabled' => true,
    'templates.path' => '../templates'
        ));

require '../routes/public.php';
require '../routes/admin.php';

$app->session = $session;
//$app->db = $db;

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

$app->hook('slim.before.dispatch', function() use ($app) { 

    $user = null;
    
    if ($app->session->get('user')) {
       $user = $app->session->get('user');
    }
    
    $app->view()->setData('user', $user);
    
    $root = $app->request->getRootUri();
    $app->view()->setData('root', $root);
});

$app->run();
