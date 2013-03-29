<?php

class Formatter {
    
    private $_answers;
    private $_questions;
     
    public function __construct(Quiz $quiz) 
    {
        $this->_answers = $quiz->getAnswers();
        $this->_questions = $quiz->getQuestions();
    }
    
    public function formatAnswers() 
    {
        $rtn = '';
        $x = 0;
        
        foreach ($this->_answers as $answergroup) 
        {
            $rtn .= ($x % 2 == 0) ? '<div class="qanda clear">'  :  '<div class="qanda">';
            
            $rtn  .= '<h4>Acronym' . ($x + 1) . ': ' . $this->_questions[$x] . '</h4>';
            $rtn  .= '<ol>' . PHP_EOL;
            
            $y = 0;
            foreach( $answergroup as $answer) 
            {
                //first in array(correct by default) AND chosen by user
                if ( ($y === 0) && ( in_array( $answer, $_SESSION['correct']) ) ) 
                {
                    $rtn  .= '<li class="correctuser">'. $answer. ' (Correct!)</li>' . PHP_EOL;
                } 
                //just first in array(correct by default) not chosen by user
                else if ($y === 0) 
                {
                    $rtn  .= '<li class="correct">' . $answer . '</li>'  . PHP_EOL;
                } 
                //incorrect chosen by user
                else if ( in_array( $answer, $_SESSION['wrong'])) 
                {
                    $rtn  .= '<li class="wrong">' . $answer . ' (Woops!)</li>' . PHP_EOL;
                } 
                //wrong but not chosen by user
                else 
                {
                    $rtn  .= "<li>$answer</li>\n";
                }
                //move on to next answer in group
                $y++;
            }
            $rtn  .= '</ol></div>' . PHP_EOL;
            
            //move on to next set of answers
            $x++;
         }
        return $rtn ;
    }
}
?>