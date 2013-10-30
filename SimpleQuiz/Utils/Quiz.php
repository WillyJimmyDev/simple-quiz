<?php
namespace SimpleQuiz\Utils;

/*
 *
 * @author Ben Hall
 */

class Quiz implements Base\QuizInterface {
    
    protected $_id;
    protected $_db;
    protected $_name;
    protected $_description;
    protected $_active;
    protected $_answers = array();
    protected $_questions = array();
    protected $_question;
    protected $_users;
    protected $_leaderboard;
    
    public function __construct(\Slim\Helper\Set $container)
    {
        $this->_leaderboard = $container->leaderboard;
        
        try
        {
            $this->_db = $container->db;
        }
        catch (\PDOException $e)
        {
            return $e;
        }
      
    }
    
    public function setId($id)
    {
        $quizsql = "SELECT count(*) as num, name, description, active FROM quizzes where id = :id";
        $stmt = $this->_db->prepare($quizsql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        if ($result = $stmt->fetchObject())
        {
            if ($result->num == 1)
            {
                $this->_id = $id;
                $this->_name = $result->name;
                $this->_description = $result->description;
                $this->_active = $result->active;
                
                return true;
            }
            return false;
        }
        return false;
    }
    
    public function getId()
    {
        return $this->_id;
    }
    
    public function getName()
    {
        return ucwords($this->_name);
    }
    
    public function getDescription()
    {
        return $this->_description;
    }
    
    public function isActive()
    {
        return $this->_active == 1 ? true : false;
    }
    
    public function getAnswers($questionid = false)
    {   
        if ($questionid)
        {
            //pull answers from db for only this question with correct answer first
            $answersql = "SELECT text FROM answers where question_num = :id and quiz_id = :quizid ORDER BY correct DESC";
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
            $answersql = "SELECT group_concat( a.text ORDER BY a.correct DESC SEPARATOR '~' ) FROM answers a where a.quiz_id = :quizid GROUP BY a.question_num";
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
    
    public function updateAnswers(Array $answers, $quizid, $questionid) 
    {
        $this->deleteAnswers($quizid, $questionid);
        //insert new  answers
        $sql2 = "insert into answers (question_num, quiz_id, text, correct) values(:questionid, :quizid, :answer, :correct)";
        $stmt2 = $this->_db->prepare($sql2);
        $stmt2->bindParam(':questionid', $questionid, \PDO::PARAM_INT);
        $stmt2->bindParam(':quizid', $quizid, \PDO::PARAM_INT);
        $stmt2->bindParam(':answer', $text, \PDO::PARAM_STR);
        $stmt2->bindParam(':correct', $correct, \PDO::PARAM_INT);
        
        foreach ($answers as $answer) {
            $text = $answer[0];
            $correct = $answer[1];
            $stmt2->execute();
        }
        return true;
    }
    
    public function deleteAnswers($quizid, $questionid)
    {
        //get rid of old answers
        $sql = "delete from answers where quiz_id = :quizid and question_num = :questionid";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':questionid', $questionid, \PDO::PARAM_INT);
        $stmt->bindParam(':quizid', $quizid, \PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
    
    public function updateQuestion ($quizid, $questionnum, $text) 
    {
        $sql = "update questions set text = :text where quiz_id = :quizid and num = :num";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(':num', $questionnum, \PDO::PARAM_INT);
        $stmt->bindParam(':quizid', $quizid, \PDO::PARAM_INT);
        $stmt->bindParam(':text', $text, \PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }

    public function getQuestion($questionid) 
    {
        $questionsql = "select text from questions where num = :id and quiz_id = :quizid";
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
        $questionsql = "select num,text from questions where quiz_id = :quizid order by num asc";
        $stmt = $this->_db->prepare($questionsql);
        $stmt->bindParam(':quizid', $this->_id, \PDO::PARAM_INT);
        $stmt->execute();
        while ($row = $stmt->fetchObject())
        {
            $this->_questions[$row->num] = $row->text;
        }
    }
    
    public function populateUsers() 
    {
        $this->_users = $this->_leaderboard->getMembers($this->_id);
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
        return ! array_key_exists($username,$this->_users);
    }
    
    public function addQuizTaker($user,$score,$start,$end,$timetaken)
    {
        $this->_leaderboard->addMember($this->_id, $user,$score,$start,$end,$timetaken);
        return true;
    }
}
?>