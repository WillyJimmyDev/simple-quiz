<?php //results.php

include 'functions.php';
$session = new Session();
$session->start();

$session->set('last', null);

if( $session->get('finished') != 'yes' ) 
{
    header('Location: index.php');
    exit();
}

require(Config::$questionsandanswersfile);

$quiz = new Quiz($session, 'leaders.xml', $answers, $questions);

//destroy the session before returning to the start page
$session->destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="style.css" type="text/css" />
        <title>The Web Acronym Test Results</title>
    </head>
    <body id="resultpage">
        <div id="wrapresult">
            <h1>The Results Page For <span><?php echo $session->get('user');  ?></span></h1>    
            <div id="intro">
                <h2>Top Scorers</h2>
                <?php echo $quiz->showLeaders(Config::$leaderstoshow); //the top 30 scorers. ?>
            </div><!--intro-->
            <div id="quiz">
                <?php echo $quiz->formatAnswers(); ?>	
            </div><!--quiz-->
            <ul id="footer" class="clear">
                <li><a href="index.php" title="Start The Quiz Again">Start Again</a></li>
                <li><a href="http://blog.elanman.com/2009/03/make-your-own-php-quiz-part-1/" title="Return To ElanMan's Drawers">ElanMan</a></li>
            </ul>
        </div><!--wrapper-->
    </body>
</html>