<?php //results.php
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

$quiz->session->set('last', null);

if( $quiz->session->get('finished') != 'yes' ) 
{
    header('Location: /');
    exit();
}

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
                <ul class="leaders">
                    <?php
                    $leaders = $quiz->getLeaders(30);
                    $numquestions = count($quiz->getQuestions());
                    $counter = 1;
                    foreach ($leaders as $key => $value) :
                        
                        //if current user, bolden the username
                        if ( ( $quiz->session->get('user') ) && ($key == $quiz->session->get('user') ) ) :
                            $key = '<strong>' . $key . '</strong>';
                        endif;
                        
                        echo '<li>' . $key. ': ' .  $value . '/' . $numquestions . '</li>';
                        
                        $counter++;
                        
                    endforeach;
                    ?>
                </ul>
            </div><!--intro-->
            <div id="quiz">
            <?php
            $x = 0;
            foreach ($quiz->getAnswers() as $answergroup) :
                echo ($x % 2 == 0) ? '<div class="qanda clear">'  :  '<div class="qanda">';
                echo '<h4>Question' . ($x + 1) . ': ' . $quiz->getQuestion($x + 1) . '</h4>';
                echo '<ol>' . PHP_EOL;
                    $y = 0;
                    foreach( $answergroup as $answer) :
            
                        //first in array(correct by default) AND chosen by user
                        if ( ($y === 0) && ( in_array( $answer, $_SESSION['correct']) ) ) :
                            echo '<li class="correctuser">'. $answer. ' (Correct!)</li>' . PHP_EOL;
                        
                        //correct but not chosen by user
                        elseif ($y === 0) :
                            echo '<li class="correct">' . $answer . '</li>'  . PHP_EOL;
                        
                        //wrong AND chosen by user
                        elseif ( in_array( $answer, $_SESSION['wrong'])) :
                            echo '<li class="wrong">' . $answer . ' (Woops!)</li>' . PHP_EOL;
                
                        //wrong, not chosen by user
                        else :
                            echo "<li>$answer</li>\n";
                        endif;
                        
                        $y++;
                    endforeach;
                echo '</ol></div>' . PHP_EOL;
            
                //move on to next set of answers
                $x++;
            endforeach; ?>
            </div><!--quiz-->
            <ul id="footer" class="clear">
                <li><a href="/simple-quiz/" title="Start The Quiz Again">Start Again</a></li>
                <li><a href="http://blog.elanman.com/2009/03/make-your-own-php-quiz-part-1/" title="Return To ElanMan's Drawers">ElanMan</a></li>
            </ul>
        </div><!--wrapper-->
    </body>
</html>