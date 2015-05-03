<?php


namespace SimpleQuiz\Utils;


use SimpleQuiz\Utils\Base\IQuestion;

class RadioQuestion implements IQuestion {

    protected $_id;
    protected $_num;
    protected $_quizid;
    protected $_text;
    protected $_answers = array();

    function __construct($_id, $_num, $_quizid, $_text)
    {
        $this->_id = $_id;
        $this->_num = $_num;
        $this->_quizid = $_quizid;
        $this->_text = $_text;
    }


    public function getId()
    {
        return $this->_id;
    }

    public function getNum()
    {
        return $this->_num;
    }

    public function getText()
    {
        return $this->_text;
    }

    public function update($text)
    {
        $q = \ORM::for_table('questions')->where('quiz_id', $this->_quizid)->where('num', $this->_num)->find_one();
        $q->set('text',$text);
        $q->save();

        return true;
    }

    /**
     * @return array
     */
    public function getAnswers()
    {
        //pull answers from db for only this question ordered by correct answer first
        $obj = \ORM::for_table('answers')->where('question_num', $this->_num)->where('quiz_id', $this->_quizid)->order_by_desc('correct')->find_many();
        foreach ($obj as $answer) {
            array_push($this->_answers,$answer->text);
        }
        return $this->_answers;
    }

    /**
     * @param array $answers
     * @return bool
     */
    public function addAnswers( Array $answers)
    {
        foreach ($answers as $answer) {
            $newanswer = \ORM::for_table('answers')->create();
            $newanswer->question_num = $this->_num;
            $newanswer->text = $answer[0];
            $newanswer->correct = $answer[1];
            $newanswer->quiz_id = $this->_quizid;
            $newanswer->save();
        }
        return true;
    }

    /**
     * @param array $answers
     * @return bool
     */
    public function updateAnswers(Array $answers)
    {
        $this->deleteAnswers();

        $this->addAnswers($answers);

        return true;
    }

    /**
     * @return bool
     */
    public function deleteAnswers()
    {
        \ORM::for_table('answers')->where('quiz_id', $this->_quizid)->where('question_num',
            $this->_num)->delete_many();

        return true;
    }
}
