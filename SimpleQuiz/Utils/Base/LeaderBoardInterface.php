<?php
namespace SimpleQuiz\Utils\Base;

interface LeaderBoardInterface {
    
    public function getMembers($number = false);
    
    public function hasMember($username);
    
    public function addMember($user, $score, $start,$end, $timetaken);
}
?>
