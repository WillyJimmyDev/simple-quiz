<?php //index.php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
require 'vendor/autoload.php';

$container = new Pimple();

$container['db'] = $container->share(function() {
    return new PDO('mysql:host='.Config::$dbhost.';dbname='.Config::$dbname,  Config::$dbuser,  Config::$dbpassword);
});

$container['session'] = $container->share(function($c) {
    return new SessionDB($c);
});

$container['leaderboard'] = function($c) {
    return new DBLeaderBoard($c);
};

$container['user'] = function($c) { return new User($c);};

$container['Quiz'] = function ($c) {return QuizFactory::getQuiz($c);};

$quiz = $container['Quiz'];

$quiz->session->set('score', 0);
$quiz->session->set('correct', array()); 
$quiz->session->set('wrong', array());
$quiz->session->set('finished','no');
$quiz->session->set('num',0);
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="res/css/style.css" type="text/css" />
    <title>The Web Acronym Test</title>
    <script type="text/javascript" src="res/js/start.js"></script>
</head>
<body id="splash">
    <div id="wrapper">
        <div id="intro">
            <h1>Take the test and see how well you know your web acronyms</h1>
            <p>Each question has 4 possible answers. Choose the answer you think is correct and click <strong>'Submit Answer'</strong>. You'll then be given the next acronym.</p>
            <p>There are <?php echo count($quiz->getQuestions()); ?> questions, so let's get cracking!</p>
            <p>You'll get your score at the end of the test.</p>
            <div id="leaders-score">
                <h2>Top 10 Scorers</h2>
                <ul class="leaders">
                    <?php
                    $leaders = $quiz->getLeaders(10);
                    $numquestions = count($quiz->getQuestions());
                    $counter = 1;
                    foreach ($leaders as $key => $value) :
                        
                        echo '<li>' . $key. ': ' .  $value . '/' . $numquestions . '</li>';
                        
                        //Use modulus to create new sub-list if required.
                        if ($counter % 5 == 0) :  
                            echo '</ul>' . PHP_EOL . '<ul class="leaders">' . PHP_EOL;
                        endif;
                        
                        $counter++;
                        
                    endforeach;
                    ?>
                </ul>
            </div><!-- leaders-score-->
        </div><!--intro-->
        <div id="quiz">
            <h2>Start The Test</h2>
            <p>If featuring on the Score Board doesn't interest you,</p>
            <form id="jttt" method="post" action="processor.php">
                <p><input type="submit" value="Just Take The Test" /></p>
            </form>
            <form id="questionBox" method="post" action="processor.php">
                <p>If you want to be placed on the 'Top Scorers' list, please enter a username below.</p> 
                <ul>
                    <li><label for="username">Create A Username:</label><br />
                        <input type="text" id="username" name="username" value="Username" />
                        <p id="exp">Username must be between 3 and 10 characters in length</p></li>
                </ul>
                <p><input type="hidden" name="register" value="TRUE" />
                    <input type="submit" id="submit" value="Register And Take The Test" /></p>
            </form> 
            <p id="helper"><?php if ( $quiz->session->get('error') ) echo $quiz->session->get('error'); ?></p>
        </div><!--quiz-->
    </div><!--wrapper-->
</body>
</html>