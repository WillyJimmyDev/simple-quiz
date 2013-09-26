<?php
namespace SimpleQuiz\Utils;

/*
 *
 * Base Session Class
 * 
 *  
 */

class Session {
    
    public function __construct() 
    {
        
        \session_name("Simple-Quiz");
        \session_start();
        //the following is needed to a bug with php 5.2 and apc 3.1.6
        \register_shutdown_function('session_write_close');
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
        return true;
    }
    
//    public function start()
//    {
//        session_name("Simple-Quiz");
//        session_start();
//        //the following is needed to a bug with php 5.2 and apc 3.1.6
//        register_shutdown_function('session_write_close');
//    }
    
    
    public function end() 
    {
        \session_destroy();
        return true;
    }
    
}
?>
