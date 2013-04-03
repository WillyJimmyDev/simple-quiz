<?php
/*
 *
 * @author ElanMan
 */

class Quiz {
    
    private $_db;
    private $_answers;
    private $_questions;
    private $_users;
    private $_session;
    private $_leaderboard;

    public function __construct($session) 
    {
        try
        {
            $this->_db = new PDO('mysql:host='.Config::$dbhost.';dbname='.Config::$dbname,  Config::$dbuser,  Config::$dbpassword);
        }
        catch (PDOException $e)
        {
            return $e;
        }
        
        $this->_session = $session;
        $this->_leaderboard = LeaderBoardFactory::getLeaderBoard();
        $this->_users = $this->_leaderboard->getMembers();
        
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

    public function registerUser($username) 
    {   
        if ($this->_leaderboard->hasMember($username)) 
        {
            $this->_session->set('error', 'That name is already registered, please choose another.');
            header('Location: index.php');
            exit();
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
        
        $this->_leaderboard->addMember($this->_session->get('user'),$this->_session->get('score'));

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
        $leaders = $this->_leaderboard->getLeaders($limit);
        $numquestions = count($this->_questions);

        $counter = 1;

        // Start a html ordered list
        $rtn = '<ul class="leaders">' . PHP_EOL;

        // wrap each username and score in <li> tags. 
        // If the user->name == current user,wrap the name/score in <strong> tags too.
        foreach ($leaders as $key => $value) 
        {
            if ( ( $this->_session->get('user') ) && ($key == $this->_session->get('user') ) ) 
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