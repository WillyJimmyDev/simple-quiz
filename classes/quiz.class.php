<?php
/**
 * Description of Quiz
 *
 * @author ben
 */
class Quiz {

    private $_answers;
    private $_questions;
    private $_leaders = array();
    private $_formattedAnswers = '';
    private $_leaderboard;
    private $_xml;
    private $_verdict = '';

    public function __construct($leaderboardfile, array $answers, array $questions) {
        try {
            // need to have singleton db class that pulls specific quiz info from db based on quiz name params
            $this->_answers = $answers;
            $this->_questions = $questions;
            $this->_xml = simplexml_load_file($leaderboardfile);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function shuffle_assoc($array) {

        $keys = array_keys($array);
        shuffle($keys);
        $shuffled = array();
        foreach ($keys as $key) {
            $shuffled[$key] = $array[$key];
        }
        return $shuffled;
    }
    
    public function registerUser() {
        $username = trim(strip_tags(stripslashes($_POST['username'])));
        foreach ($this->_xml->user as $user) {
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
    }
    
    public function createRandomUser() {
        $random = rand(1,1000);
        $_SESSION['user'] = 'Anon' . $random;
        $_SESSION['score'] = 0;
        $_SESSION['correct'] = array();
        $_SESSION['wrong'] = array();
        $_SESSION['finished'] = 'no';
        $_SESSION['num'] = 0;
        header('Location: test.php');
    }
    
    public function giveVerdict() {
        $user = $this->_xml->addChild('user');
        $uname = $user->addChild('name', $_SESSION['user']);
        $uscore = $user->addChild('score', $_SESSION['score']);
        $this->_xml->asXML('leaders.xml');

        $this->_verdict .= "<h2 id=\"score\">{$_SESSION['user']}, your final score is:</h2>\n
 <h3>{$_SESSION['score']}/20</h3><h4>Verdict:</h4>";
        if ($_SESSION['score'] <= 5) {
            $this->_verdict .= "<p id=\"verdict\"><span>S</span>everely <span>H</span>indered <span>I</span>n the <span>T</span>est!</p>\n";
        }
        if (($_SESSION['score'] > 5) && ($_SESSION['score'] <= 10)) {
            $this->_verdict .= "<p id=\"verdict\"><span>C</span>ould <span>R</span>ead <span>A</span>nd <span>P</span>ractice more.</p>\n";
        }
        if (($_SESSION['score'] > 10) && ($_SESSION['score'] <= 15)) {
            $this->_verdict .= "<p id=\"verdict\"><span>A</span>cronyms a<span>R</span>e <span>S</span>o <span>E</span>asy!</p>\n";
        }
        if ($_SESSION['score'] > 15) {
            $this->_verdict .= "<p id=\"verdict\"><span>S</span>uper <span>A</span>cronym <span>S</span>pecialist</p>";
        }
        $this->_verdict .= "<p id=\"compare\"><a href=\"results.php\">See how you compare! <img src=\"images/arrow.png\" /></a></p>";
        
        return $this->_verdict;
    }

    public function showLeaders($limit, $group = null) {

        // Place all users and associated 
        // scores into the 'leaders' array.
        foreach ($this->_xml->user as $user) {
            $name = (string) $user->name;
            $score = (string) $user->score;
            $this->_leaders[$name] = $score;
        }

        // Sort the leaders array numerically, highest scorers first.	
        arsort($this->_leaders, SORT_NUMERIC);

        // Initialise our $counter variable to '1'.
        $counter = 1;

        // Start a html ordered list to hold the leaders.
        $this->_leaderboard = "<ul class=\"leaders\">\n";

        // Loop through the 'leaders' array and wrap each username and score
        // in <li> tags. If the user is the current $_SESSION['user'], wrap
        // the name/score in <strong> tags too.
        foreach ($this->_leaders as $key => $value) {
            // Check that $counter is less than $limit.
            if ($counter <= $limit) {
                if ( (isset($_SESSION['user'])) && ($key == $_SESSION['user']) ) {
                    $this->_leaderboard .= "<li><strong>$key:</strong> $value/". count($this->_questions) ."</li>\n";
                } else {
                    $this->_leaderboard .= "<li>$key: $value/". count($this->_questions) ."</li>\n";
                }
                // Check to see if $group parameter has been passed.
                // If it has, create separate lists according to the $group variable.
                if ($group) {
                    // Use the modulus operator(%) to create new sub-list if required.
                    if ( ($counter % $group == 0) && ($counter != $limit ) ) {
                        $this->_leaderboard .= "</ul>\n<ul class=\"leaders\">\n";
                    }
                }
            }
            // Increment the $counter.	
            $counter++;
        }
        // End the ordered list.
        $this->_leaderboard .= "</ul>\n";

        // return the ordered list.
        return $this->_leaderboard;
    }

    public function formatAnswers() {
        for ($x = 0; $x < count($this->_answers); $x++) {
            if ($x % 2 == 0) {
                $this->_formattedAnswers .= "<div class=\"qanda clear\">\n";
            } else {
                $this->_formattedAnswers .= "<div class=\"qanda\">";
            }
            $this->_formattedAnswers .= '<h4>Acronym' . ($x + 1) . ': ' . $this->_questions[$x] . '</h4>';
            $this->_formattedAnswers .= "<ol>\n";
            for ($y = 0; $y < count($this->_answers[$x]); $y++) {
                if (($this->_answers[$x][$y] === $this->_answers[$x][0]) && (in_array($this->_answers[$x][$y], $_SESSION['correct']))) {
                    $this->_formattedAnswers .= "<li class=\"correctuser\">{$this->_answers[$x][$y]} (Correct!)</li>\n";
                } else if ($this->_answers[$x][$y] === $this->_answers[$x][0]) {
                    $this->_formattedAnswers .= "<li class=\"correct\">{$this->_answers[$x][$y]}</li>\n";
                } else if (in_array($this->_answers[$x][$y], $_SESSION['wrong'])) {
                    $this->_formattedAnswers .= "<li class=\"wrong\">{$this->_answers[$x][$y]} (Woops!)</li>\n";
                } else {
                    $this->_formattedAnswers .= "<li>{$this->_answers[$x][$y]}</li>\n";
                }
            }
            $this->_formattedAnswers .= "</ol></div>\n";
            
        }
        return $this->_formattedAnswers;
    }

}
?>