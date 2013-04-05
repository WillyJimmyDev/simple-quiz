<?php
abstract class LeaderBoard {
    
    public function getMembers($number = false)
    {  
        if ($number)
        {
            arsort($this->_members,SORT_NUMERIC);
            return array_slice($this->_members, 0, $number, true);
        }
        
        return $this->_members;
    }
    
    public function hasMember($username)
    {
        foreach ($this->_members as $member) 
        {
            if ($member->name == $username) 
            {
                return true;
            }
        }
        return false;
    }
    
    abstract protected function addMember($user,$score);
}
?>
