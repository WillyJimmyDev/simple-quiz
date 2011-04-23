<?php //test.php
/*********Copyright (c) 2009 Ben Hall*********

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
 */

session_name("Acronym_Test");
session_start();
$num = isset($_SESSION['num']) ? $_SESSION['num']: 0;
require_once('questionsandanswers.php');
require_once('functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>The Web Acronym Test</title>
<?php 
if (!isset($_SESSION['last'])) {
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
if (!isset($_SESSION['last'])) {  ?>
<h2>Acronym <?php echo $num+1; ?>:</h2>
<p>What does <strong><?php echo $questions[$num]; ?></strong> stand for?</p>
<form id="questionBox" method="post" action="processor.php">
<ul>
<?php 
$pattern = ' ';
$replace = '_';
$shuffledAnswers = shuffle_assoc($answers[$num]);
#var_dump($newanswers);
foreach ($shuffledAnswers as $answer) {
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
$file = "leaders.xml";
 $xml = simplexml_load_file($file);
 $user = $xml->addChild('user');
 $uname = $user->addChild('name',$_SESSION['user']);
 $uscore = $user->addChild('score',$_SESSION['score']);
 $xml->asXML("leaders.xml");

echo "<h2 id=\"score\">{$_SESSION['user']}, your final score is:</h2>\n
 <h3>{$_SESSION['score']}/20</h3><h4>Verdict:</h4>";
 if($_SESSION['score'] <= 5) echo "<p id=\"verdict\"><span>S</span>everely <span>H</span>indered <span>I</span>n the <span>T</span>est!</p>\n";
 if(($_SESSION['score'] > 5) && ($_SESSION['score'] <= 10)) echo "<p id=\"verdict\"><span>C</span>ould <span>R</span>ead <span>A</span>nd <span>P</span>ractice more.</p>\n";
 if(($_SESSION['score'] > 10) && ($_SESSION['score'] <= 15)) echo "<p id=\"verdict\"><span>A</span>cronyms a<span>R</span>e <span>S</span>o <span>E</span>asy!</p>\n";
 if($_SESSION['score'] > 15) echo "<p id=\"verdict\"><span>S</span>uper <span>A</span>cronym <span>S</span>pecialist</p>";
 echo "<p id=\"compare\"><a href=\"results.php\">See how you compare! <img src=\"images/arrow.png\" /></a></p>";
}
?>
</div><!--quiz-->
</div><!--wrapper-->
</body>
</html>
