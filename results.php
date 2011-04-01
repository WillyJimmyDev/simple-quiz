<?php
session_name("Acronym_Test");
session_start();
if($_SESSION['finished'] != 'yes') {
header('Location: index.php');
}
include_once('qandas.php');
include_once('functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>The Web Acronym Test Results</title>
</head>
<body id="resultpage">
<div id="wrapresult">
<h1>The Results Page For <span><?php echo $_SESSION['user']; ?></span></h1>
<div id="intro">
<h2>Top 20 Scorers</h2>
<?php 
showLeaders('leaderboard.xml',20);
 ?>
</div><!--intro-->
<div id="quiz">
<?php 
 showAnswers($answers,$questions);
?>	
</div><!--quiz-->
<ul id="footer" class="clear">
<li><a href="index.php" title="Start The Quiz Again">Start Again</a></li>
<li><a href="http://www.elanman.co.uk/2009/03/make-your-own-php-quiz-part-1/" title="Return To ElanMan's Drawers">Return To The Blog</a></li>
</ul>
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
