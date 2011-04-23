<?php //processor.php
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
require_once('questionsandanswers.php');
require_once('functions.php');
if (!isset($_POST['submitter'])) {

    if(isset($_POST['register'])) {
		$username = trim(strip_tags(stripslashes($_POST['username'])));
		$file = "leaders.xml";
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
		$_SESSION['num'] = 0;
                header('Location: test.php');
	} else {
		$random = rand(1,1000);
		$_SESSION['user'] = 'Anon'. $random;
		$_SESSION['score'] = 0;
		$_SESSION['correct'] = array();
		$_SESSION['wrong'] = array();
		$_SESSION['finished'] = 'no';
		$_SESSION['num'] = 0;
                header('Location: test.php');
	}
} else {
    
	$_SESSION['num'] = (int) $_POST['num'];
        $num = $_SESSION['num'];
	$postedanswers = str_replace("_"," ",$_POST['answers']);
	if ($postedanswers == $answers[$num]['0']) {
		$_SESSION['score']++;
		$_SESSION['correct'][] = $postedanswers;
	} else {
		$_SESSION['wrong'][] = $postedanswers;
	}
	if ($_SESSION['num'] < count($questions)-1) {
		$_SESSION['num']++;
	} else {
		$_SESSION['last'] = true;
		$_SESSION['finished'] = 'yes';
	}
        header('Location: test.php');
}
?>
