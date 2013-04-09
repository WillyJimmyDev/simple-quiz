<?php
class XmlLeaderBoard extends LeaderBoard {
    
    private $_leaderboardfile;
    private $_leaderboard;
    
    public function __construct($leaderboardfile) 
    {
        $this->_leaderboardfile = $leaderboardfile;
        $this->_leaderboard = simplexml_load_file($this->_leaderboardfile);
        $this->_members =  $this->_leaderboard->xpath("//user");
    }
    
    public function addMember($user,$score)
    {
        $user = $this->_leaderboard->addChild('user');
        $user->addChild('name', $user );
        $user->addChild('score', $score );
        $this->_leaderboard->asXML($this->_leaderboardfile);
        return true;
    }
}
?>
