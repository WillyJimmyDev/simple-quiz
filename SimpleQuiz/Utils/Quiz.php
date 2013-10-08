<?php
namespace SimpleQuiz\Utils;

/*
 *
 * @author Ben Hall
 */

class Quiz implements Base\QuizInterface {
    
    protected $_db;
    protected $_answers = array();
    protected $_questions = array();
    protected $_question;
    protected $_users;
    protected $_leaderboard;
    protected $_currentuser;
    
    public $session;
    
    public function __construct(\Pimple $container)
    {
        $this->_currentuser = $container['user'];
        
        $this->session = $container['session'];
        $this->_leaderboard = $container['leaderboard'];
        $this->_users = $this->_leaderboard->getMembers();
        
        try
        {
            $this->_db = $container['db'];
            $this->_populateQuestions();
        }
        catch (\PDOException $e)
        {
            return $e;
        }
      
    }
    
    public function getAnswers($questionid = false)
    {   
        if ($questionid)
        {
            //pull answers from db for only this question
            $answersql = "SELECT text FROM answers where question_id = :id ORDER BY correct DESC";
            $stmt = $this->_db->prepare($answersql);
            $stmt->bindParam(':id', $questionid, \PDO::PARAM_INT);
            $stmt->execute();
            while ($result = $stmt->fetchObject())
            {
               array_push($this->_answers,$result->text);
            }
        }
        else
        {
            //pull all answers from db grouped by question
            $answersql = "SELECT group_concat( a.text ORDER BY a.correct DESC SEPARATOR '~' ) FROM answers a GROUP BY a.question_id";
            $stmt = $this->_db->query($answersql);
            $stmt->execute();
            $resultset = $stmt->fetchAll(\PDO::FETCH_NUM);
        
            foreach ($resultset as $csv)
            {   
                $tmparray = explode('~', $csv[0]);
                array_push($this->_answers,$tmparray);
            }
        }
        
        return $this->_answers;
    }
    
    
    public function getQuestion($questionid) 
    {
        $questionsql = "select text from questions where id = :id";
        $stmt = $this->_db->prepare($questionsql);
        $stmt->bindParam(':id', $questionid, \PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchObject();
        $this->_question = $row->text;
        
        return $this->_question;
    }
    
    public function getQuestions()
    {
        return $this->_questions;
    }
    
    public function _populateQuestions() 
    {
        $questionsql = "select text from questions order by id asc";
        $stmt = $this->_db->query($questionsql);
        $stmt->execute();
        while ($row = $stmt->fetchObject())
        {
            $this->_questions[] .= $row->text;
        }
    }
    
    public function getUser($username)
    {
        
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
    }
    
    public function createRandomUser ()
    {
        $this->_currentuser->createRandom();
    }
    
    public function addQuizTaker($user,$score,$start,$end,$timetaken)
    {
        $this->_leaderboard->addMember($user,$score,$start,$end,$timetaken);
        return true;
    }
}
?>