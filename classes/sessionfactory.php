<?php
class SessionFactory {
    
    public function __construct()
    {
        if (Config::$dbsessions)
        {
            return new SessionDB();
        }
    
         return new Session();
    }
    
}
?>
