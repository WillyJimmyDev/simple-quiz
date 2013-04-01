<?php
/*
 *
 * @author ElanMan
 */

class Quiz {
    
    private $_db;
    private $_answers;
    private $_questions;
    private $_xml;
    private $_users;
    private $_session;

    public function __construct($session,$leaderboardfile) 
    {
        try
        {
            $this->_db = new PDO('mysql:host='.Config::$dbhost.';dbname='.Config::$dbname,  Config::$dbuser,  Config::$dbpassword);
            $this->_session = $session;
            $this->_xml = simplexml_load_file($leaderboardfile);
            
            //load users from factory
            //$this->_users = new LeaderBoardFactory->getLeaderBoard();
        }
        catch (PDOException $e)
        {
            return $e;
        }
        
        //need to delegate this shite
        if ( ! Config::$dbquestions)
        {
            require Config::$questionsandanswersfile;//contains $answers and $questions arrays
            $this->_answers = $answers;
            $this->_questions = $questions;
        }
        else
        {
            //db query to pull questions and answers
            //$this->_answers = $answers;
            //$this->_questions = $questions;
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
    
    public  function getUsers()
    {
        return $this->_users;
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
        $rtn = '';
        
        $user = $this->_xml->addChild('user');
        $user->addChild('name', $this->_session->get('user') );
        $user->addChild('score', $this->_session->get('score') );
        $this->_xml->asXML('leaders.xml');

        $rtn .= '<h2 id="score">' . $this->_session->get('user') . ', your final score is:</h2>' . PHP_EOL;
        $rtn .= '<h3>' . $this->_session->get('score') . '/20</h3>' . PHP_EOL;
        $rtn .= '<h4>Verdict:</h4>' . PHP_EOL;
                                         
        if ( $this->_session->get('score')  <= 5) 
        {
            $rtn .= Config::$poorScoreVerdict;
        }
        if ($this->_session->get('score') > 5) 
        {
            $rtn .= Config::$averageScoreVerdict;
        }
        if ($this->_session->get('score') > 10) 
        {
            $rtn .= Config::$goodScoreVerdict;
        }
        if ($this->_session->get('score') > 15) 
        {
            $rtn .= Config::$greatScoreVerdict;
        }
        
        return $rtn;
    }

    public function showLeaders($limit, $group = null) 
    {
        $leaders = array();
        $numquestions = count($this->_questions);
        // Place all users and associated 
        // scores into the 'leaders' array.
        foreach ($this->_xml->user as $user) 
        {
            $name = (string) $user->name;
            $score = (string) $user->score;
            $leaders[$name] = $score;
        }

        // Sort the leaders array numerically, highest scorers first.	
        arsort($leaders, SORT_NUMERIC);

        // Initialise our $counter variable to '1'.
        $counter = 1;

        // Start a html ordered list to hold the leaders.
        $rtn = '<ul class="leaders">' . PHP_EOL;

        // Loop through the 'leaders' array and wrap each username and score
        // in <li> tags. If the user is the current $_SESSION['user'], wrap
        // the name/score in <strong> tags too.
        foreach ($leaders as $key => $value) 
        {
            // Check that $counter is less than $limit.
            if ($counter <= $limit) 
            {
                if ( ( $this->_session->get('user') ) && ($key == $this->_session->get('user') ) ) 
                {
                    $key = '<strong>' . $key . '</strong>';
                } 
                $rtn .= '<li>' . $key. ':' .  $value . '/' . $numquestions . '</li>';
                
                // Check to see if $group parameter has been passed.
                // If it has, create separate lists according to the $group variable.
                if ($group) 
                {
                    // Use the modulus operator(%) to create new sub-list if required.
                    if ( ($counter % $group == 0) && ($counter != $limit ) ) 
                    {
                        $rtn .= '</ul>' . PHP_EOL . '<ul class="leaders">' . PHP_EOL;
                    }
                }
            }
            // Increment the $counter.	
            $counter++;
        }
        // End the ordered list.
        $rtn .= '</ul>' . PHP_EOL;

        // return the ordered list.
        return $rtn;
    }
}
?>