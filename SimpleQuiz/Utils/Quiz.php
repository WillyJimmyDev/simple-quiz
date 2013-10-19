<?php
namespace SimpleQuiz\Utils;

/*
 *
 * @author Ben Hall
 */

class Quiz implements Base\QuizInterface {
    
    protected $_id;
    protected $_db;
    protected $_answers = array();
    protected $_questions = array();
    protected $_question;
    protected $_users;
    protected $_leaderboard;
    
    public $session;
    
    public function __construct(\Pimple $container)
    {
        
        $this->session = $container['session'];
        $this->_leaderboard = $container['leaderboard'];
        
        try
        {
            $this->_db = $container['db'];
        }
        catch (\PDOException $e)
        {
            return $e;
        }
      
    }
    
    public function setId($id)
    {
        $quizsql = "SELECT count(id) as num from quizzes where id = :id";
        $stmt = $this->_db->prepare($quizsql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        if ($result = $stmt->fetchObject())
        {
            if ($result->num == 1)
            {
                $this->_id = $id;
                return true;
            }
        }
        
        return false;
    }
    
    public function getId()
    {
        return $this->_id;
    }
    
    public function getAnswers($questionid = false)
    {   
        if ($questionid)
        {
            //pull answers from db for only this question
            $answersql = "SELECT text FROM answers where question_id = :id and quiz_id = :quizid ORDER BY correct DESC";
            $stmt = $this->_db->prepare($answersql);
            $stmt->bindParam(':id', $questionid, \PDO::PARAM_INT);
            $stmt->bindParam(':quizid', $this->_id, \PDO::PARAM_INT);
            $stmt->execute();
            while ($result = $stmt->fetchObject())
            {
               array_push($this->_answers,$result->text);
            }
        }
        else
        {
            //pull all answers from db grouped by question
            $answersql = "SELECT group_concat( a.text ORDER BY a.correct DESC SEPARATOR '~' ) FROM answers a where a.quiz_id = :quizid GROUP BY a.question_id";
            $stmt = $this->_db->prepare($answersql);
            $stmt->bindParam(':quizid', $this->_id, \PDO::PARAM_INT);
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
        $questionsql = "select text from questions where id = :id and quiz_id = :quizid";
        $stmt = $this->_db->prepare($questionsql);
        $stmt->bindParam(':id', $questionid, \PDO::PARAM_INT);
        $stmt->bindParam(':quizid', $this->_id, \PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchObject();
        $this->_question = $row->text;
        
        return $this->_question;
    }
    
    public function getQuestions()
    {
        return $this->_questions;
    }
    
    public function populateQuestions() 
    {
        $questionsql = "select text from questions where quiz_id = :quizid order by id asc";
        $stmt = $this->_db->prepare($questionsql);
        $stmt->bindParam(':quizid', $this->_id, \PDO::PARAM_INT);
        $stmt->execute();
        while ($row = $stmt->fetchObject())
        {
            $this->_questions[] .= $row->text;
        }
    }
    
    public function populateUsers() 
    {
        $this->_users = $this->_leaderboard->getMembers($this->_id);
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
        return $this->_leaderboard->getMembers($this->_id, $num);
    }
    
    public function registerUser($username)
    {
        if ($this->_leaderboard->hasMember($this->_id, $username)) 
        {
            $this->session->set('error', 'That name is already registered, please choose another.');
            return false;
        }
        
        $this->session->set('user',$username);
        $this->session->set('score', 0);
        $this->session->set('correct', array());
        $this->session->set('wrong', array());
        $this->session->set('finished','no');
        $this->session->set('num',0);
        $this->session->set('starttime',date('Y-m-d H:i:s'));
        
        $this->session->remove('error');
        
        return true;
    }
    
    public function createRandomUser()
    {
        $random = rand(1,1000);
        $this->session->set('user', 'Anon' . $random);
        $this->session->set('score', 0);
        $this->session->set('correct', array()); 
        $this->session->set('wrong', array());
        $this->session->set('finished','no');
        $this->session->set('num',0);
        $this->session->set('starttime',date('Y-m-d H:i:s'));
        
//        header('Location: /quiz/'. $this->getId() . '/test');
//        exit();
        return true;
    }
    
    public function addQuizTaker($user,$score,$start,$end,$timetaken)
    {
        $this->_leaderboard->addMember($this->_id, $user,$score,$start,$end,$timetaken);
        return true;
    }
}
?>