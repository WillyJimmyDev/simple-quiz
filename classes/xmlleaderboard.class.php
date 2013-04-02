<?php
class XmlLeaderBoard implements LeaderBoard {
    
    private $_leaderboard;
    private $_members;
    
    public function __construct($leaderboardfile) 
    {
        $this->_leaderboard = simplexml_load_file($leaderboardfile);
        $this->_members =  $this->_leaderboard->xpath("//user");
    }
    
    public function getMembers() 
    {
        return $this->_members;
    }

    public function getLeaders($number) 
    {
        arsort($this->_members);
        return array_slice($this->_members, 0, $number, true);
    }
}
?>
