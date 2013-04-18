<?php
/*
 *
 * @author ElanMan
 */

class Quiz {
    
    protected $_db;
    protected $_answers = array();
    protected $_questions = array();
    protected $_question;
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
        
        try
        {
            $this->_db = new PDO('mysql:host='.Config::$dbhost.';dbname='.Config::$dbname,  Config::$dbuser,  Config::$dbpassword);
        }
        catch (PDOException $e)
        {
            return $e;
        }
      
    }
    
    public function getAnswers($questionid = false)
    {   
        if ($questionid)
        {
            //pull answers from db for just this question
            $answersql = "SELECT text FROM answers where question_id = :id ORDER BY correct DESC";
            $stmt = $this->_db->prepare($answersql);
            $stmt->bindParam(':id', $questionid, PDO::PARAM_INT);
            $stmt->execute();
            while ($result = $stmt->fetchObject())
            {
               array_push($this->_answers,$result->text);
            }
        }
        else
        {
            //pull all answers from db grouped by question
            $answersql = "SELECT group_concat( a.text ORDER BY a.correct DESC ) FROM answers a GROUP BY a.question_id";
            $stmt = $this->_db->query($answersql);
            $stmt->execute();
            $resultset = $stmt->fetchAll(PDO::FETCH_NUM);
        
            foreach ($resultset as $csv)
            {   
                $tmparray = explode(',', $csv[0]);
                array_push($this->_answers,$tmparray);
            }
        }
        
        return $this->_answers;
    }
    
    
    public function getQuestion($questionid) 
    {
        $questionsql = "select text from questions where id = :id";
        $stmt = $this->_db->prepare($questionsql);
        $stmt->bindParam(':id', $questionid, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchObject();
        $this->_question = $row->text;
        
        return $this->_question;
    }
    
    public function getQuestions() 
    {
        $questionsql = "select text from questions order by id asc";
        $stmt = $this->_db->query($questionsql);
        $stmt->execute();
        while ($row = $stmt->fetchObject())
        {
            $this->_questions[] .= $row->text;
        }
        return $this->_questions;
    }
    
    public function getUsers()
    {
        return $this->_users;
    }
    
    public function getLeaders($num)
    {
        return $this->_leaderboard->getMembers($num);
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

        $rtn .= '<h2 id="score">' . $this->session->get('user') . ', your final score is:</h2>' . PHP_EOL;
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

    public function showLeaders($limit, $group = false) 
    {
        //need to remove this from quiz class
        //unnecessary, should be in client code
        $leaders = $this->getLeaders($limit);
        $numquestions = count($this->getQuestions());

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
            $rtn .= '<li>' . $key. ': ' .  $value . '/' . $numquestions . '</li>';
                
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