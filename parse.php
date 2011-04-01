<?php 
$file = "leaderboard.xml";
 $xml = simplexml_load_file($file);
 $name = 'Bobby';
 foreach($xml->user as $user) {
 if ($user->name == $name)
 $error = 'That name is already registered, please choose another.';
 }
 if($error) { echo $error;} else {echo 'available';}
?>
