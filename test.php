<?php
session_name("Acronym_Test");
session_start();
include_once('qandas.php');

if (isset($_POST['submitter'])) {
$num = (int) $_POST['num'];
$postedanswers = str_replace("_"," ",$_POST['answers']);
	if ($postedanswers == $answers[$num]['0']) {
	$_SESSION['score']++;
	$_SESSION['correct'][] = $postedanswers; 
	} else {
		$_SESSION['wrong'][] = $postedanswers;
		} 
	if ($num < count($questions)-1) {
		$num++;
		} else {
		$last = true;
		$_SESSION['finished'] = 'yes';
		}
} 
else if(isset($_POST['register'])) {
	$username = trim(strip_tags(stripslashes($_POST['username'])));
	
	$file = "leaderboard.xml";
 	$xml = simplexml_load_file($file);
	foreach($xml->user as $user) {
	 if ($user->name == $username) {
 	$_SESSION['error'] = 'That name is already registered, please choose another.';
 	header('Location: index.php');
 	exit();
 	}
 	}

	$_SESSION['user'] = $username;
	$_SESSION['score'] = 0;
	$_SESSION['correct'] = array(); 
	$_SESSION['wrong'] = array();
	$_SESSION['finished'] = 'no';
	if (isset($_SESSION['error']))
	unset($_SESSION['error']); 
	$num = 0;
	}
	else {
$random = rand(1,1000);
$_SESSION['user'] = 'Anon'. $random;
$_SESSION['score'] = 0;
$_SESSION['correct'] = array(); 
$_SESSION['wrong'] = array(); 
$_SESSION['finished'] = 'no';
$num = 0;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>The Web Acronym Test</title>
<?php 
if (!$last) {
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
if(!$last) {  ?>
<h2>Acronym <?php echo $num+1; ?>:</h2>
<p>What does <strong><?php echo $questions[$num]; ?></strong> stand for?</p>
<form id="questionBox" method="post" action="test.php">
<ul>
<?php 
$pattern = ' ';
$replace = '_';
shuffle_assoc($answers[$num]);
foreach ($answers[$num] as $answer) {

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
if ($_SESSION['score'] <= 20) { 
$file = "leaderboard.xml";
 $xml = simplexml_load_file($file);
 $user = $xml->addChild('user');
 $uname = $user->addChild('name',$_SESSION['user']);
 $uscore = $user->addChild('score',$_SESSION['score']);
 $xml->asXML("leaderboard.xml");
 }
echo "<h2 id=\"score\">{$_SESSION['user']}, your final score is:</h2>\n
 <h3>{$_SESSION['score']}/20</h3><h4>Verdict:</h4>";
 if($_SESSION['score'] <= 5) echo "<p id=\"verdict\"><span>S</span>everely <span>H</span>indered <span>I</span>n the <span>T</span>est!</p>\n";
 if(($_SESSION['score'] > 5) && ($_SESSION['score'] <= 10)) echo "<p id=\"verdict\"><span>C</span>ould <span>R</span>ead <span>A</span>nd <span>P</span>ractice more.</p>\n";
 if(($_SESSION['score'] > 10) && ($_SESSION['score'] <= 15)) echo "<p id=\"verdict\"><span>A</span>cronyms a<span>R</span>e <span>S</span>o <span>E</span>asy!</p>\n";
 if(($_SESSION['score'] > 15) && ($_SESSION['score'] <= 20)) echo "<p id=\"verdict\"><span>S</span>uper <span>A</span>cronym <span>S</span>pecialist</p>";
 if($_SESSION['score'] > 20) echo "<p id=\"verdict\">Refreshing the browser is cheating isn't it?</p>";
 echo "<p id=\"compare\"><a href=\"results.php\">See how you compare! <img src=\"images/arrow.png\" /></a></p>";
}
?>
</div><!--quiz-->
</div><!--wrapper-->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-2845820-2");
pageTracker._trackPageview();
</script>
</body>
</html>
