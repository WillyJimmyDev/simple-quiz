<?php
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
 		if (($counter <= $limit) && ($value <= 20)) {
 		
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
 if ($x % 2 == 0) { $output = "<div class=\"qanda clear\">\n";
  } else { $output = "<div class=\"qanda\">";
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
