<?php

class Formatter {
    
    private $_quiz;
    private $_answers;
    private $_questions;
    private $_formattedAnswers;
     
    public function __construct(Quiz $quiz) 
    {
        $this->_quiz = $quiz;
    }
    
    public function formatAnswers() 
    {
        $this->_answers = $this->_quiz->getAnswers();
        $this->_questions = $this->_quiz->getQuestions();
        
        for ($x = 0; $x < count($this->_answers); $x++) 
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
            for ($y = 0; $y < count($this->_answers[$x]); $y++) 
            {
                if ( ($y === 0) && (in_array($this->_answers[$x][0], $_SESSION['correct']))) 
                {
                    $this->_formattedAnswers .= "<li class=\"correctuser\">{$this->_answers[$x][0]} (Correct!)</li>\n";
                } 
                else if ($y === 0) 
                {
                    $this->_formattedAnswers .= "<li class=\"correct\">{$this->_answers[$x][0]}</li>\n";
                } 
                else if (in_array($this->_answers[$x][$y], $_SESSION['wrong'])) 
                {
                    $this->_formattedAnswers .= "<li class=\"wrong\">{$this->_answers[$x][$y]} (Woops!)</li>\n";
                } 
                else 
                {
                    $this->_formattedAnswers .= "<li>{$this->_answers[$x][$y]}</li>\n";
                }
            }
            $this->_formattedAnswers .= "</ol></div>\n";
            
        }
        return $this->_formattedAnswers;
    }
}
?>
