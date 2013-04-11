<?php
/*
 *
 * @author ElanMan
 */

class Quiz {
    
    protected $_db;
    protected $_answers;
    protected $_questions;
    protected $_users;
    protected $_leaderboard;
    protected $_currentuser;
    
    public $session;
    
    public function __construct(Session $session, LeaderBoard $leaderboard)
    {
        $this->_currentuser = new User($session, $leaderboard);
        
        $this->session = $session;
        $this->_leaderboard = $leaderboard;
        $this->_users = $this->_leaderboard->getMembers();
        
        //below is only dependenacy on db config preference
        if (Config::$dbquestions)
        {
            try
            {
                $this->_db = new PDO('mysql:host='.Config::$dbhost.';dbname='.Config::$dbname,  Config::$dbuser,  Config::$dbpassword);
            }
            catch (PDOException $e)
            {
                return $e;
            }
            //db query to pull questions and answers
            //$this->_answers = $answers;
            //$this->_questions = $questions;
        }
        
        else 
        {
            //load $questions and $answers arrays from include file
            require Config::$questionsandanswersfile;
            $this->_answers = $answers;
            $this->_questions = $questions;
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
    
    public function getUsers()
    {
        return $this->_users;
    }
    
    public function registerUser($username)
    {
        $this->_currentuser->register($username);
        return true;
    }
    
    public function createRandomUser ()
    {
        $this->_currentuser->createRandom();
        return true;
    }

    public function giveVerdict() 
    {
        $rtn = '';
        
        $this->_leaderboard->addMember($this->session->get('user'),$this->session->get('score'));

        $rtn .= '<h2 id="score">' . $this->_session->get('user') . ', your final score is:</h2>' . PHP_EOL;
        $rtn .= '<h3>' . $this->session->get('score') . '/20</h3>' . PHP_EOL;
        $rtn .= '<h4>Verdict:</h4>' . PHP_EOL;
                                         
        if ( $this->session->get('score')  <= 5) 
        {
            $rtn .= Config::$poorScoreVerdict;
        }
        if ($this->session->get('score') > 5) 
        {
            $rtn .= Config::$averageScoreVerdict;
        }
        if ($this->session->get('score') > 10) 
        {
            $rtn .= Config::$goodScoreVerdict;
        }
        if ($this->session->get('score') > 15) 
        {
            $rtn .= Config::$greatScoreVerdict;
        }
        
        return $rtn;
    }

    public function showLeaders($limit, $group = null) 
    {
        $leaders = $this->_leaderboard->getMembers($limit);
        $numquestions = count($this->_questions);

        $counter = 1;

        // Start a html ordered list
        $rtn = '<ul class="leaders">' . PHP_EOL;

        // wrap each username and score in <li> tags. 
        // If the user->name == current user,wrap the name/score in <strong> tags too.
        foreach ($leaders as $key => $value) 
        {
            if ( ( $this->session->get('user') ) && ($key == $this->session->get('user') ) ) 
            {
                $key = '<strong>' . $key . '</strong>';
            } 
            $rtn .= '<li>' . $key. ':' .  $value . '/' . $numquestions . '</li>';
                
            // If $group, create separate lists according to the $group variable.
            if ($group) 
            {
                // Use the modulus operator(%) to create new sub-list if required.
                if ($counter % $group == 0)  
                {
                    $rtn .= '</ul>' . PHP_EOL . '<ul class="leaders">' . PHP_EOL;
                }
            }
            
            $counter++;
        }
       
        $rtn .= '</ul>' . PHP_EOL;

        return $rtn;
    }
}
?>