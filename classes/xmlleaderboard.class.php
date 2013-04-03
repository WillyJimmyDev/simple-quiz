<?php
class XmlLeaderBoard implements LeaderBoard {
    
    private $_leaderboardfile;
    private $_leaderboard;
    private $_members;
    
    public function __construct($leaderboardfile) 
    {
        $this->_leaderboardfile = $leaderboardfile;
        $this->_leaderboard = simplexml_load_file($leaderboardfile);
        $this->_members =  $this->_leaderboard->xpath("//user");
    }
    
    public function getMembers() 
    {
        return $this->_members;
    }

    public function getLeaders($number) 
    {
        arsort($this->_members,SORT_NUMERIC);
        return array_slice($this->_members, 0, $number, true);
    }
    
    public function addMember($user,$score)
    {
        $user = $this->_leaderboard->addChild('user');
        $user->addChild('name', $user );
        $user->addChild('score', $score );
        $this->_leaderboard->asXML($this->_leaderboardfile);
    }
    
    public function hasMember($username) 
    {
        //replace this with a simple xpath query
        foreach ($this->_members as $member) 
        {
            if ($member->name == $username) 
            {
                return true;
            }
        }
        return false;
    }
}
?>
