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
    private $_formattedAnswers = array();
    private $_output;
    private $_xml;
    //private $_reader;

    public function __construct($leaderboardfile, array $answers, array $questions) {
        try {
            $this->_answers = $answers;
            $this->_questions = $questions;
            try {
                $this->_xml = simplexml_load_file($leaderboard);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function shuffle_assoc($array) {

        $keys = array_keys($array);
        shuffle($keys);
        $shuffled = array();
        foreach ($keys as $key)
            $shuffled[$key] = $array[$key];

        return $shuffled;
    }

    public function showLeaders($limit, $group = null) {

        // Place all users and associated 
        // scores into the 'leaders' array.
        foreach ($this->xml->user as $user) {
            $name = (string) $user->name;
            $score = (string) $user->score;
            $this->_leaders[$name] = $score;
        }

        // Sort the leaders array numerically, highest scorers first.	
        arsort($this->_leaders, SORT_NUMERIC);

        // Initialise our $counter variable to '1'.
        $counter = 1;

        // Start a html ordered list to hold the leaders.
        $output = "<ul class=\"leaders\">\n";

        // Loop through the 'leaders' array and wrap each username and score
        // in <li> tags. If the user is the current $_SESSION['user'], wrap
        // the name/score in <strong> tags too.
        foreach ($this->_leaders as $key => $value) {
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
                    if ($counter % $group == 0) {
                        $output .= "</ul>\n<ul class=\"leaders\">\n";
                    }
                }
            }
            // Increment the $counter.	
            $counter++;
        }
        // End the ordered list.
        $output .= "</ul>\n";

        // return the ordered list.
        echo $output;
    }

    public function formatAnswers() {
        for ($x = 0; $x < count($this->_answers); $x++) {
            if ($x % 2 == 0) {
                $this->_formattedAnswers = "<div class=\"qanda clear\">\n";
            } else {
                $this->_formattedAnswers = "<div class=\"qanda\">";
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
            return $this->_formattedAnswers;
        }
    }

}
?>
