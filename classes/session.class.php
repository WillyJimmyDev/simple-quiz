<?php

/*
 *
 * Base Session Class
 * 
 *  
 */

class Session {
    
    public function __construct()
    {
    }
    
     public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
    public function get($key)
    {
        if (isset($_SESSION[$key]))
        {
            return $_SESSION[$key]; 
        }
        return false;
     }
    
     public function remove($key)
    {
        if (isset($_SESSION[$key]))
        {
            unset($_SESSION[$key]); 
        }
        return;
    }
    
}
?>
