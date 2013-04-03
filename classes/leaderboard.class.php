<?php
interface LeaderBoard {
    
    public function getMembers();
    public function getLeaders($number);
    public function addMember($user,$score);
    public function hasMember();
}
?>
