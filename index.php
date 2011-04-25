<?php //index.php
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
$_SESSION['score'] = 0;
$_SESSION['correct'] = array(); 
$_SESSION['wrong'] = array();
$_SESSION['finished'] = 'no'; 
$_SESSION['num'] = 0;
require('Quiz.php');
$quiz = new Quiz('leaders.xml', $answers, $questions);
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
 echo $quiz->showLeaders(20, 5);
 ?>
</div><!-- leaderboard-->
</div><!--intro-->
<div id="quiz">
<h2>Start The Test</h2>
<p>If featuring on the Score Board is of absolutely no interest to you,</p>
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
<p id="helper"><?php if(isset($_SESSION['error'])) echo $_SESSION['error']; ?></p>
</div><!--quiz-->
</div><!--wrapper-->
</body>
</html>
