<?php
interface LeaderBoard {
    
    public function getMembers($number);
    public function addMember($user,$score);
    public function hasMember();
}
?>
