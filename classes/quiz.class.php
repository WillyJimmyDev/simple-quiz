<?php
/*
 *
 * @author ElanMan
 */

class Quiz {

    private $_answers;
    private $_questions;
    private $_leaders = array();
    private $_formattedAnswers = '';
    private $_leaderboard;
    private $_xml;
    private $_verdict = '';
    private $_verdicttext = '';
    private $_session;

    public function __construct($session,$leaderboardfile) 
    {
        //need to delegate this shite
        if ( ! Config::$dbquestions)
        {
            require Config::$questionsandanswersfile;
            $this->_answers = $answers;
            $this->_questions = $questions;
        }
        else
        {
            //db query to pull questions and answers
            //$this->_answers = $answers;
            //$this->_questions = $questions;
        }
        
        try 
        {
            $this->_session = $session;
            $this->_xml = simplexml_load_file($leaderboardfile);
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }
    
    public function getAnswers()
    {
        return $this->_answers;
    }
    
    public function getQuestions() 
    {
        return $this->_questions;
    }
    
    public function shuffle_assoc($array) 
   {
        $keys = array_keys($array);
        shuffle($keys);
        $shuffled = array();
        foreach ($keys as $key) 
        {
            $shuffled[$key] = $array[$key];
        }
        
        return $shuffled;
    }
    
    public function registerUser() 
    {
        $username = trim(strip_tags(stripslashes($_POST['username'])));
        
        //replace this with a simple db lookup
        foreach ($this->_xml->user as $user) 
        {
            if ($user->name == $username) 
            {
                $this->_session->set('error', 'That name is already registered, please choose another.');
                header('Location: index.php');
                exit();
            }
        }
        
        $this->_session->set('user',$username);
        $this->_session->set('score', 0);
        $this->_session->set('correct', array());
        $this->_session->set('wrong', array());
        $this->_session->set('finished','no');
        $this->_session->set('num',0);
        
        $this->_session->remove('error');
        
        header('Location: test.php');
    }
    
    public function createRandomUser() 
    {
        $random = rand(1,1000);
        $this->_session->set('user', 'Anon' . $random);
        $this->_session->set('score', 0);
        $this->_session->set('correct', array()); 
        $this->_session->set('wrong', array());
        $this->_session->set('finished','no');
        $this->_session->set('num',0);
        
        header('Location: test.php');
    }
    
    public function giveVerdict() 
    {
        $user = $this->_xml->addChild('user');
        $uname = $user->addChild('name', $_SESSION['user']);
        $uscore = $user->addChild('score', $_SESSION['score']);
        $this->_xml->asXML('leaders.xml');

        $this->_verdict .= "<h2 id=\"score\">{$_SESSION['user']}, your final score is:</h2>\n
                                         <h3>{$_SESSION['score']}/20</h3>\n
                                         <h4>Verdict:</h4>";
                                         
        if ( $this->_session->get('score')  <= 5) 
        {
            $this->_verdicttext = Config::$poorScoreVerdict;
        }
        if ($this->_session->get('score') > 5) 
        {
            $this->_verdicttext = Config::$averageScoreVerdict;
        }
        if ($this->_session->get('score') > 10) 
        {
            $this->_verdicttext= Config::$goodScoreVerdict;
        }
        if ($this->_session->get('score') > 15) 
        {
            $this->_verdicttext= Config::$greatScoreVerdict;
        }
        
        $this->_verdict .= $this->_verdicttext;
        
        $this->_verdict .= "<p id=\"compare\"><a href=\"results.php\">See how you compare! <img src=\"images/arrow.png\" /></a></p>";
        
        return $this->_verdict;
    }

    public function showLeaders($limit, $group = null) 
    {

        // Place all users and associated 
        // scores into the 'leaders' array.
        foreach ($this->_xml->user as $user) 
        {
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
        foreach ($this->_leaders as $key => $value) 
        {
            // Check that $counter is less than $limit.
            if ($counter <= $limit) 
            {
                if ( ( $this->_session->get('user') ) && ($key == $this->_session->get('user') ) ) 
                {
                    $this->_leaderboard .= "<li><strong>$key:</strong> $value/". count($this->_questions) ."</li>\n";
                } 
                else 
                {
                    $this->_leaderboard .= "<li>$key: $value/". count($this->_questions) ."</li>\n";
                }
                // Check to see if $group parameter has been passed.
                // If it has, create separate lists according to the $group variable.
                if ($group) 
                {
                    // Use the modulus operator(%) to create new sub-list if required.
                    if ( ($counter % $group == 0) && ($counter != $limit ) ) 
                    {
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

    public function formatAnswers() 
    {
        for ($x = 0; $x < count($this->_answers); $x++) 
        {
            if ($x % 2 == 0) 
            {
                $this->_formattedAnswers .= "<div class=\"qanda clear\">\n";
            } 
            else 
            {
                $this->_formattedAnswers .= "<div class=\"qanda\">";
            }
            $this->_formattedAnswers .= '<h4>Acronym' . ($x + 1) . ': ' . $this->_questions[$x] . '</h4>';
            $this->_formattedAnswers .= "<ol>\n";
            for ($y = 0; $y < count($this->_answers[$x]); $y++) 
            {
                if (($this->_answers[$x][$y] === $this->_answers[$x][0]) && (in_array($this->_answers[$x][$y], $_SESSION['correct']))) 
                {
                    $this->_formattedAnswers .= "<li class=\"correctuser\">{$this->_answers[$x][$y]} (Correct!)</li>\n";
                } 
                else if ($this->_answers[$x][$y] === $this->_answers[$x][0]) 
                {
                    $this->_formattedAnswers .= "<li class=\"correct\">{$this->_answers[$x][$y]}</li>\n";
                } 
                else if (in_array($this->_answers[$x][$y], $_SESSION['wrong'])) 
                {
                    $this->_formattedAnswers .= "<li class=\"wrong\">{$this->_answers[$x][$y]} (Woops!)</li>\n";
                } 
                else 
                {
                    $this->_formattedAnswers .= "<li>{$this->_answers[$x][$y]}</li>\n";
                }
            }
            $this->_formattedAnswers .= "</ol></div>\n";
            
        }
        return $this->_formattedAnswers;
    }
}
?>