<?php
class SessionFactory {
    
    static function getsession()
    {
        if (Config::$dbsessions)
        {
            return new SessionDB();
        }
    
         return new Session();
    }
    
}
?>
