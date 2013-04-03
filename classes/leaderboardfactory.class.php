<?php
class LeaderBoardFactory {
    
    public static function getLeaderBoard()
    {
        if (Config::$dbusers)
        {
            return new DBLeaderBoard();
        }
    
        return new XmlLeaderBoard(Config::$leaderboardfile);
    }
}
?>