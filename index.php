<?php
//index.php
ini_set('error-reporting', E_ALL);
ini_set('display_errors', 1);
require 'vendor/autoload.php';

$db = new \SimpleQuiz\Utils\Base\DB();
$session = new \SimpleQuiz\Utils\Session($db);

$app = new \Slim\Slim(array(
    'debug' => true,
    'log.enabled' => true
        ));

require 'routes/public.php';
require 'routes/admin.php';

$app->session = $session;
$app->db = $db;

$app->leaderboard = function($app) {
    return new \SimpleQuiz\Utils\LeaderBoard($app);
};

$app->quiz = function ($app) {
    return new \SimpleQuiz\Utils\Quiz($app);
};

$app->admin = function ($app) {
    return new \SimpleQuiz\Utils\Admin($app);
};

$app->simple = function ($app) {
    return new \SimpleQuiz\Utils\Simple($app);
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
