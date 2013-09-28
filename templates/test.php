<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="res/css/style.css" type="text/css" />
    <title>The Web Acronym Test</title>
    <?php 
    if (! $quiz->session->get('last')) 
    {
        echo '<script type="text/javascript" src="res/js/form.js"></script>';
    }
    ?>
</head>
<body>
<div id="wrapper">
<div id="intro">
<h1>Take the test and see how well you know your web acronyms</h1>
<p>Each question has 4 possible answers. Choose the answer you think is correct and click <strong>'Submit Answer'</strong>. You'll then be given the next acronym.</p>
<p>There are <?php echo count($quiz->getQuestions()); ?> questions, so let's get cracking!</p>
<p>You'll get your score at the end of the test..</p>
<?php if( $quiz->session->get('user') ) echo '<h4>Current tester: ' . $quiz->session->get('user') . '</h4>'; ?>
</div><!--intro-->
<div id="quiz">
<?php 
if (! $quiz->session->get('last') ) : 
    $question = $quiz->getQuestion($num);
    $answers = $quiz->getAnswers($num);
?>
    <h2>Question <?php echo $num; ?>:</h2>
    <p>What does <strong><?php echo $question; ?></strong> stand for?</p>
    <form id="questionBox" method="post" action="process">
        <ul>
        <?php 
        $shuffledAnswers = shuffle_assoc($answers);

        $acount = 0;
        foreach ($shuffledAnswers as $answer) 
        {
            echo '<li><input type="radio" id="answer' . $acount . '" value="' . $answer . '" name="answers" />' .PHP_EOL;
            echo '<label for="answer' . $acount . '">' . $answer . '</label></li>' . PHP_EOL;
            $acount++;
        }
        ?>
        </ul>
        <p><input type="hidden" name="num" value="<?php echo $num; ?>" />
            <input type="hidden" name="submitter" value="TRUE" />
            <input type="submit" id="submit" name="submit" value="Submit Answer" />
        </p>
    </form>
<?php 
else :
    $quiz->addScore();

    echo '<h2 id="score">' . $quiz->session->get('user') . ', your final score is:</h2>' . PHP_EOL;
    echo '<h3>' . $quiz->session->get('score') . '/'. count($quiz->getQuestions()) .'</h3>' . PHP_EOL;
    echo '<h4>Verdict:</h4>' . PHP_EOL;
                                         
    if ( $quiz->session->get('score')  <= 5) 
    {
        $verdict = '<span>S</span>everely <span>H</span>indered <span>I</span>n the <span>T</span>est!';
    }
    if ($quiz->session->get('score') > 5) 
    {
        $verdict = '<span>C</span>ould <span>R</span>ead <span>A</span>nd <span>P</span>ractice more.';
    }
    if ($quiz->session->get('score') > 10) 
    {
        $verdict = '<span>A</span>cronyms a<span>R</span>e <span>S</span>o <span>E</span>asy!';
    }
    if ($quiz->session->get('score') > 15) 
    {
        $verdict = '<span>S</span>uper <span>A</span>cronym <span>S</span>pecialist';
    }
    
    echo '<p id="verdict">' . $verdict . '</p>';
    
    echo '<p id="compare"><a href="results">See how you compare! <img src="images/arrow.png" /></a></p>';
endif;
?>
</div><!--quiz-->
</div><!--wrapper-->
</body>
</html>