<?php

class Formatter {
    
    private $_quiz;
    private $_answers;
    private $_questions;
    private $_formattedAnswers = '';
     
    public function __construct(Quiz $quiz) 
    {
        $this->_quiz = $quiz;
    }
    
    public function formatAnswers() 
    {
        $this->_answers = $this->_quiz->getAnswers();
        $this->_questions = $this->_quiz->getQuestions();
        
        $x = 0;
        
        foreach ($this->_answers as $answergroup) 
        {
            if ($x % 2 == 0) 
            {
                $this->_formattedAnswers .= "<div class=\"qanda clear\">\n";
            } 
            else 
            {
                $this->_formattedAnswers .= '<div class="qanda">';
            }
            $this->_formattedAnswers .= '<h4>Acronym' . ($x + 1) . ': ' . $this->_questions[$x] . '</h4>';
            $this->_formattedAnswers .= "<ol>\n";
            
            $y = 0;
            foreach( $answergroup as $answer) 
            {
                //first in array(correct by default) AND chosen by user
                if ( ($y === 0) && ( in_array( $answer, $_SESSION['correct']) ) ) 
                {
                    $this->_formattedAnswers .= "<li class=\"correctuser\">$answer (Correct!)</li>\n";
                } 
                //just first in array(correct by default) not chosen by user
                else if ($y === 0) 
                {
                    $this->_formattedAnswers .= "<li class=\"correct\">$answer</li>\n";
                } 
                //incorrect chosen by user
                else if ( in_array( $answer, $_SESSION['wrong'])) 
                {
                    $this->_formattedAnswers .= "<li class=\"wrong\">$answer (Woops!)</li>\n";
                } 
                //wrong but not chosen by user
                else 
                {
                    $this->_formattedAnswers .= "<li>$answer</li>\n";
                }
                
                $y++;
            }
            $this->_formattedAnswers .= "</ol></div>\n";
            
            $x++;
            
        }
        return $this->_formattedAnswers;
    }
}
?>