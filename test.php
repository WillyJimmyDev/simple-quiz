<?php //test.php

include 'functions.php';
$session = SessionFactory::getsession();
$session->start();

$num = isset($_SESSION['num']) ? $_SESSION['num']: 0;

$quiz = new Quiz($session,  Config::$leaderboardfile);
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>The Web Acronym Test</title>
<?php 
if (! $session->get('last')) 
{
    echo "<script type=\"text/javascript\" src=\"form.js\"></script>";
}
?>
</head>
<body>
<div id="wrapper">
<div id="intro">
<h1>Take the test and see how well you know your web acronyms</h1>
<p>Each acronym has 4 possible answers. Choose the answer you think is correct and click <strong>'Submit Answer'</strong>. You'll then be given the next acronym.</p>
<p>There are 20 acronyms, so let's get cracking! You'll get your score at the end of the test. It's just like facebook (honest!).</p>
<?php if(isset($_SESSION['user'])) echo "<h4>Current tester: {$_SESSION['user']}</h4>"; ?>
</div><!--intro-->
<div id="quiz">
<?php 
if (!isset($_SESSION['last'])) { 
    $questions = $quiz->getQuestions();
    $answers = $quiz->getAnswers();
?>
<h2>Acronym <?php echo $num+1; ?>:</h2>
<p>What does <strong><?php echo $questions[$num]; ?></strong> stand for?</p>
<form id="questionBox" method="post" action="processor.php">
<ul>
<?php 
$pattern = ' ';
$replace = '_';
$shuffledAnswers = $quiz->shuffle_assoc($answers[$num]);

foreach ($shuffledAnswers as $answer) 
{
	$answer2 = str_replace($pattern,$replace,$answer);
	echo "<li><input type=\"radio\" id=\"$answer2\" value=\"$answer2\" name=\"answers\" />\n";
	echo "<label for=\"$answer2\">$answer</label></li>\n";
}
?>
</ul>
<p><input type="hidden" name="num" value="<?php echo $num; ?>" />
<input type="hidden" name="submitter" value="TRUE" />
<input type="submit" id="submit" name="submit" value="Submit Answer" /></p>
</form>
<?php } else { 
    echo $quiz->giveVerdict();
}
?>
</div><!--quiz-->
</div><!--wrapper-->
</body>
</html>