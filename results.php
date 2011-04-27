<?php //results.php
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
$_SESSION['last'] = null;
if($_SESSION['finished'] != 'yes') {
header('Location: index.php');
exit();
}
require('questionsandanswers.php');
require('classes/Quiz.php');
$quiz = new Quiz('leaders.xml', $answers, $questions);
?>
<!DOCTYPE html>
<html>
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
<?php echo $quiz->showLeaders(20); ?>
</div><!--intro-->
<div id="quiz">
<?php echo $quiz->formatAnswers(); ?>	
</div><!--quiz-->
<ul id="footer" class="clear">
<li><a href="index.php" title="Start The Quiz Again">Start Again</a></li>
<li><a href="http://www.elanman.co.uk/2009/03/make-your-own-php-quiz-part-1/" title="Return To ElanMan's Drawers">Return To The Blog</a></li>
</ul>
</div><!--wrapper-->
</body>
</html>
