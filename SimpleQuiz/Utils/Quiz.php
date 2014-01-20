<?php
namespace SimpleQuiz\Utils;

/*
 *
 * @author Ben Hall
 */

class Quiz implements Base\QuizInterface {
    
    protected $_id;
    protected $_name;
    protected $_description;
    protected $_category;
    protected $_active;
    protected $_answers = array();
    protected $_questions = array();
    protected $_question;
    protected $_users;
    protected $_leaderboard;
    
    public function __construct(\Slim\Helper\Set $container)
    {
        $this->_leaderboard = $container->leaderboard;
    }
    
    public function setId($id)
    {
        $quizobj = \ORM::for_table('quizzes')->join('categories', array('quizzes.category', '=', 'categories.id'))->select_many('quizzes.name', 'quizzes.description', array('category' => 'categories.name'), 'quizzes.active')->find_one($id);
       
        if ($quizobj) {
            $this->_id = $id;
            $this->_name = $quizobj->name;
            $this->_description = $quizobj->description;
            $this->_category = $quizobj->category;
            $this->_active = $quizobj->active;
            
            return true;
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
            //pull answers from db for only this question ordered by correct answer first
            $obj = \ORM::for_table('answers')->where('question_num', $questionid)->where('quiz_id', $this->_id)->order_by_desc('correct')->find_many();
            foreach ($obj as $answer) {
                array_push($this->_answers,$answer->text);
            }
        }
        else
        {
            //pull all answers from db grouped by question
            $obj = \ORM::for_table('answers')->raw_query("SELECT group_concat( a.text ORDER BY a.correct DESC SEPARATOR '~' ) as grouped FROM answers a where a.quiz_id = :quizid GROUP BY a.question_num", array('quizid' => $this->_id) )->find_array();
            foreach ($obj as $answers)
            {   
                $answerarray = explode('~', $answers['grouped']);
                array_push($this->_answers,$answerarray);
            }
        }
        
        return $this->_answers;
    }
    
    public function updateAnswers(Array $answers, $questionid) 
    {
        $this->deleteAnswers($questionid);
       
        $this->addAnswers($questionid, $answers);

        return true;
    }
    
    public function deleteAnswers($questionid)
    {
        $deletedAnswers = \ORM::for_table('answers')->where('quiz_id', $this->_id)->where('question_num', $questionid)->delete_many();
        
        return true;
    }
    
    public function addAnswers($questionid, Array $answers)
    {
        foreach ($answers as $answer) {
            $newanswer = \ORM::for_table('answers')->create();
            $newanswer->question_num = $questionid;
            $newanswer->text = $answer[0];
            $newanswer->correct = $answer[1];
            $newanswer->quiz_id = $this->_id;
            $newanswer->save();
        }
        return true;
    }
    
    public function addQuestion($question, Array $answers)
    {
        $max = \ORM::for_table('questions')->where('quiz_id', $this->_id)->max('num');
        $num = $max + 1;
        
        //insert new question
        $newquestion = \ORM::for_table('questions')->create();
        $newquestion->num = $num;
        $newquestion->quiz_id = $this->_id;
        $newquestion->text = $question;
        $newquestion->save(); 
        
        $this->addAnswers($num, $answers);
        
        return true;
    }
    
    public function updateQuestion($questionid, $text) 
    {
        $q = \ORM::for_table('questions')->where('quiz_id', $this->_id)->where('num', $questionid)->find_one();
        $q->set('text',$text);
        $q->save();
        
        return true;
    }
    
    public function deleteQuestion($questionid)
    {
        //foreign_key constraints take care of deleting related answers
        $q = \ORM::for_table('questions')->where('quiz_id', $this->_id)->where('num', $questionid)->find_one();
        $q->delete();
        
        //reorder the num column in questions table
        //foreign_key constraints take care of updating related answers
        $toupdate = \ORM::for_table('questions')->where('quiz_id', $this->_id)->where_gt('num', $questionid)->find_many();
        foreach ($toupdate as $question) {
            $question->num = $question->num - 1;
        }
        $toupdate->save();
        
        return true;
    }

    public function getQuestion($questionid) 
    {
        $q = \ORM::for_table('questions')
                ->select('text')
                ->where('num', $questionid)
                ->where('quiz_id', $this->_id)
                ->find_one();
        $this->_question = $q->text;
        
        return $this->_question;
    }
    
    public function getQuestions()
    {
        return $this->_questions;
    }
    
    public function getCategory()
    {
        return $this->_category;
    }
    
    public function populateQuestions() 
    {
        $questions = \ORM::for_table('questions')->where('quiz_id', $this->_id)->order_by_asc('num')->find_array();
        foreach ($questions as $question)
        {
            $this->_questions[$question['num']] = $question['text'];
        }
    }
    //following 2 methods to be combined
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
        foreach ($this->_users as $user) {
            if ($user['name'] == $username) {
                return false;
            }
        }
        return true;
    }
    
    public function addQuizTaker($user,$score,$start,$end,$timetaken)
    {
        $this->_leaderboard->addMember($this->_id, $user,$score,$start,$end,$timetaken);
        return true;
    }
}
