<?php
function shuffle_assoc($array) 
{
    $keys = array_keys($array);
    shuffle($keys);
    $shuffled = array();
    foreach ($keys as $key) 
    {
        $shuffled[$key] = $array[$key];
    }
     return $shuffled;
}

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