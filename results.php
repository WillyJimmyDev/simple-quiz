<?php //results.php

include 'functions.php';

$quiz = QuizFactory::getQuiz();

$quiz->session->start();

$quiz->session->set('last', null);

if( $quiz->session->get('finished') != 'yes' ) 
{
    header('Location: index.php');
    exit();
}

$formatter = new Formatter($quiz);

//destroy the session
$quiz->session->end();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="res/css/style.css" type="text/css" />
        <title>The Web Acronym Test Results</title>
    </head>
    <body id="resultpage">
        <div id="wrapresult">
            <h1>The Results Page For <span><?php echo $quiz->session->get('user');  ?></span></h1>    
            <div id="intro">
                <h2>Top Scorers</h2>
                <?php echo $quiz->showLeaders(Config::$leaderstoshow); //the top scorers. ?>
            </div><!--intro-->
            <div id="quiz">
                <?php echo $formatter->formatAnswers(); ?>	
            </div><!--quiz-->
            <ul id="footer" class="clear">
                <li><a href="index.php" title="Start The Quiz Again">Start Again</a></li>
                <li><a href="http://blog.elanman.com/2009/03/make-your-own-php-quiz-part-1/" title="Return To ElanMan's Drawers">ElanMan</a></li>
            </ul>
        </div><!--wrapper-->
    </body>
</html>