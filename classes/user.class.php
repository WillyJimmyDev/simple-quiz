<?php
class User 
{
    private $_session;
    private $_leaderboard;
    
    public function __construct(Session $session, LeaderBoard $leaderboard) 
    {
        $this->_session = $session; 
        $this->_leaderboard = $leaderboard;
    }

    public function register($username)
    {
        if ($this->_leaderboard->hasMember($username)) 
        {
            $this->_session->set('error', 'That name is already registered, please choose another.');
            header('Location: /');
            exit;
        }
        
        $this->_session->set('user',$username);
        $this->_session->set('score', 0);
        $this->_session->set('correct', array());
        $this->_session->set('wrong', array());
        $this->_session->set('finished','no');
        $this->_session->set('num',0);
        
        $this->_session->remove('error');
        
        header('Location: test.php');
        exit;
    }
    
    public function createRandom()
    {
        $random = rand(1,1000);
        $this->_session->set('user', 'Anon' . $random);
        $this->_session->set('score', 0);
        $this->_session->set('correct', array()); 
        $this->_session->set('wrong', array());
        $this->_session->set('finished','no');
        $this->_session->set('num',0);
        
        header('Location: test.php');
        exit();
    }
}
?>
