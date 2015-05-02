<?php


namespace SimpleQuiz\Utils;


class QuestionStorage extends \SplObjectStorage {

    /**
     * @param $num
     * @return bool|mixed|object
     */
    public function getById($num)
        {
            foreach( $this as $question)
            {
                if ($question->getNum() == $num)
                {
                    return $question;
                }
            }

            return false;
        }
}
