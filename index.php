<?php
session_name("Acronym_Test");
session_start();
$_SESSION['score'] = 0;
$_SESSION['correct'] = array(); 
$_SESSION['wrong'] = array();
$_SESSION['finished'] = 'no'; 
$_SESSION['num'] = 0;
include_once ('functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>The Web Acronym Test</title>
<script type="text/javascript" src="start.js"></script>
</head>
<body id="splash">
<div id="wrapper">
<div id="intro">
<h1>Take the test and see how well you know your web acronyms</h1>
<p>Each acronym has 4 possible answers. Choose the answer you think is correct and click <strong>'Submit Answer'</strong>. You'll then be given the next acronym.</p>
<p>There are 20 acronyms, so let's get cracking! You'll get your score at the end of the test. It's just like facebook (honest!).</p>
<div id="leaderboard">
<h2>Top 10 Scorers</h2>
<?php 
 showLeaders('leaderboard.xml',10,5);
 ?>
 <script src="http://digg.com/tools/diggthis.js" type="text/javascript"></script>
</div><!-- leaderboard-->
</div><!--intro-->
<div id="quiz">
<h2>Start The Test</h2>
<p>If featuring on the Score Board is of absolutely no interest to you,</p>
<form id="jttt" method="post" action="test.php">
<p><input type="submit" value="Just Take The Test" /></p>
</form>
<form id="questionBox" method="post" action="test.php">
<p>If you want to be placed on the 'Top Scorers' list, please enter a username below.</p> 
<ul>
<li><label for="username">Create A Username:</label><br />
<input type="text" id="username" name="username" value="Username" />
<p id="exp">Username must be between 3 and 10 characters in length</p></li>
</ul>
<p><input type="hidden" name="register" value="TRUE" />
<input type="submit" id="submit" value="Register And Take The Test" /></p>
</form> 
<p id="helper"><?php if($_SESSION['error']) echo $_SESSION['error']; ?></p>
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
