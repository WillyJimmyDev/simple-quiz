<?php
namespace SimpleQuiz\Utils;

use SimpleQuiz\Utils\Base\User;
use Slim\Helper\Set;

class Quiz implements Base\IQuiz {

    protected $_id;
    protected $_name;
    protected $_description;
    protected $_category;
    protected $_active;
    protected $_answers = array();
    protected $_questions;
    protected $_question;
    protected $_users;
    protected $_leaderboard;

    /**
     * @param Set $container
     */
    public function __construct(Set $container)
    {
        $this->_leaderboard = $container->leaderboard;
        $this->_questions = new QuestionStorage();
    }

    /**
     * @param $id
     * @return bool
     */
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

    /**
     * @return int
     */
    public function getId()
    {
        return (int) $this->_id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return ucwords($this->_name);
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->_active == 1 ? true : false;
    }


    /**
     * @param $questionid
     * @return bool
     */
    public function getAnswers($questionid)
    {
        if ($questionid)
        {
            return $this->getQuestion($questionid)->getAnswers();
        }
        else {
            throw new \InvalidArgumentException("You must supply a question id");
        }
        
        return false;
    }

    /**
     * @return array
     */
    public function getAllAnswersGroupedByQuestion()
    {
        //pull all answers from db grouped by question
        $obj = \ORM::for_table('answers')->raw_query("SELECT group_concat( a.text ORDER BY a.correct DESC SEPARATOR '~' ) as grouped FROM answers a where a.quiz_id = :quizid GROUP BY a.question_num", array('quizid' => $this->_id) )->find_array();
        foreach ($obj as $answers)
        {
            $answerarray = explode('~', $answers['grouped']);
            array_push($this->_answers,$answerarray);
        }

        return $this->_answers;
    }

    /**
     * @param array $answers
     * @param $questionid
     * @return bool
     */
    public function updateAnswers(Array $answers, $questionid)
    {
        $this->getQuestion($questionid)->updateAnswers($answers);

        return true;
    }

    /**
     * @param $questionid
     * @return bool
     */
    public function deleteAnswers($questionid)
    {
        $this->getQuestion($questionid)->deleteAnswers();
        return true;
    }

    /**
     * @param $questionid
     * @param array $answers
     * @return bool
     */
    public function addAnswers($questionid, Array $answers)
    {
        $this->getQuestion($questionid)->addAnswers($answers);
    }

    /**
     * @param $text
     * @param $type
     * @param array $answers
     * @return bool
     */
    public function addQuestion($text, $type, Array $answers)
    {
        $max = \ORM::for_table('questions')->where('quiz_id', $this->_id)->max('num');
        $num = $max + 1;

        //insert new question
        $newquestion = \ORM::for_table('questions')->create(
            array(
                'num' => $num,
                'quiz_id' => $this->_id,
                'text' => $text
            )
        );
        //save the new question in db then add to the question storage
        if ($newquestion->save())
        {
            //create a question of desired type
            $questionType = __NAMESPACE__  . '\\' . ucfirst($type) . 'Question';
            //create a new Question instance
            $this->_question = new $questionType($newquestion->id(),$num, $this->_id, $text);
            $this->_question->addAnswers($answers);
            $this->_questions->attach($this->_question);

            return true;
        }
        
        return false;
    }

    /**
     * @param $questionid
     * @param $text
     * @return bool
     */
    public function updateQuestion($questionid, $text)
    {
        $this->getQuestion($questionid)->update($text);

        return true;
    }

    /**
     * @param $questionid
     * @return bool
     */
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

        return $toupdate->save();
    }

    /**
     * @param $questionid
     * @return bool|mixed|object
     */
    public function getQuestion($questionid)
    {
        return $this->_questions->getById($questionid);
    }

    public function getQuestions()
    {
        return $this->_questions;
    }

    /**
     * @return int
     */
    public function countQuestions()
    {
        return count($this->_questions);
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->_category;
    }


    /**
     * @return $this
     */
    public function populateQuestions()
    {
        $quizquestions = \ORM::for_table('questions')->where('quiz_id', $this->_id)->order_by_asc('num')->find_array();

        foreach ($quizquestions as $question)
        {
            /**
             * @todo make the instance name dynamic
             */
            $questionObject = new RadioQuestion($question['id'], $question['num'], $this->_id, $question['text']);
            $this->_questions->attach($questionObject);
        }

        return $this;
    }

    //following 2 methods to be combined
    /**
     *
     */
    public function populateUsers()
    {
        $this->_users = $this->_leaderboard->getMembers($this->_id);
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->_users;
    }

    /**
     * @param $num
     * @return mixed
     */
    public function getLeaders($num)
    {
        return $this->_leaderboard->getMembers($this->_id, $num);
    }

    /**
     * @param User $user
     * @param $score
     * @param $start
     * @param $end
     * @param $timetaken
     * @return bool
     */
    public function addQuizTaker(User $user,$score,$start,$end,$timetaken)
    {
        return $this->_leaderboard->addMember($this->_id, $user,$score,$start,$end,$timetaken);
    }
}
