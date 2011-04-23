<?php //functions.php

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
**********************************************************/

function shuffle_assoc($array) {

  $keys = array_keys($array);
  shuffle($keys);
  $shuffled = array();
  foreach ($keys as $key)
    $shuffled[$key] = $array[$key];

  return $shuffled;
} 
  
function showLeaders($file,$limit,$group = null) { 
	$leaders = array();
	
	// Load the xml file and place all users and associated 
 	// scores into the 'leaders' array.
 	$xml = simplexml_load_file($file);
 	foreach($xml->user as $user) {
 		$name = (string)$user->name;
 		$score = (string)$user->score;
 		$leaders[$name] = $score;
 	}
 		
 	// Sort the leaders array numerically, highest scorers first.	
 	arsort($leaders,SORT_NUMERIC);
 	
 	// Initialise our $counter variable to '1'.
 	$counter = 1;
 	
 	// Start a html ordered list to hold the leaders.
 	$output = "<ul class=\"leaders\">\n";
 	
 	// Loop through the 'leaders' array and wrap each username and score
 	// in <li> tags. If the user is the current $_SESSION['user'], wrap
 	// the name/score in <strong> tags too.
 	foreach ($leaders as $key => $value) {
 		// Check that $counter is less than $limit.
 		if ($counter <= $limit) {
 			if ($key == $_SESSION['user']) {
 				$output .= "<li><strong>$key:</strong> $value/20</li>\n";
 			} else {
 				$output .= "<li>$key: $value/20</li>\n";
 			}
 			// Check to see if $group parameter has been passed.
 			// If it has, create separate lists according to the $group variable.
 			if ($group) {
 				// Use the modulus operator(%) to create new sub-list.
 				if($counter % $group == 0) {
 					$output .= "</ul>\n<ul class=\"leaders\">\n";
 				}
 			}
 		}
 	// Increment the $counter.	
 	$counter++;
 	}
 	// End the ordered list.
 	$output .= "</ul>\n";
 	
 	// Print out the ordered list.
	echo $output;
 }
 
function showAnswers($answers,$questions) { 
	for($x = 0; $x< count($answers); $x++) {
		if ($x % 2 == 0) { 
		 	$output = "<div class=\"qanda clear\">\n";
		} else { 
			$output = "<div class=\"qanda\">";
  		}
 	$output .= '<h4>Anacronym' . ($x+1) . ': ' . $questions[$x] . '</h4>'; 
	$output .= "<ol>\n";
 	for ($y = 0;$y< count($answers[$x]); $y++) {
 		if (($answers[$x][$y] === $answers[$x][0]) && (in_array($answers[$x][$y],$_SESSION['correct']))) {
 			$output .= "<li class=\"correctuser\">{$answers[$x][$y]} (Correct!)</li>\n";
 		} else if ($answers[$x][$y] === $answers[$x][0]) {
 			$output .= "<li class=\"correct\">{$answers[$x][$y]}</li>\n";
 		} else if (in_array($answers[$x][$y],$_SESSION['wrong'])) {
 			$output .= "<li class=\"wrong\">{$answers[$x][$y]} (Woops!)</li>\n";
 		} else { 
 			$output .= "<li>{$answers[$x][$y]}</li>\n";
		}
	}
	$output .= "</ol></div>\n";
	echo $output;
	}
}
?>	
