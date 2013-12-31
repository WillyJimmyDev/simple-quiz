<?php
namespace SimpleQuiz\Utils\Base;

interface LeaderBoardInterface {
    
    public function getMembers($quizid, $number = false);
    
    public function addMember($quizid, $user, $score, $start,$end, $timetaken);
}
?>
