<?php
class QuizFactory {
    
    public static function getQuiz()
    {
        if (Config::$usedb)
        {
            $leaderboard = new DBLeaderBoard();
            $session = new SessionDB();
        }
        else 
        {
            $leaderboard = new XmlLeaderBoard();
            $session = new Session(); 
        }
    
        return new Quiz($session, $leaderboard);
    }
}
?>