<?php
namespace SimpleQuiz\Utils;

/*
 * Basic session class to store sessions in db
 */

class Session implements Base\ISession {

    public function __construct() {
        
        \session_set_save_handler(array($this,'open'),
                                 array($this,'close'),
                                 array($this,'read'),
                                 array($this,'write'),
                                 array($this,'destroy'),
                                 array($this,'clean')
                                );
        
        \session_name("Simple-Quiz");
        \session_cache_limiter(false);
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
    
    public function end() 
    {
        \session_destroy();
        return true;
    }
    
    public function open()
    {
        return true;
    }

    public function close()
    {
        return true;
    }
    
    public function regenerate() 
    {
        return session_regenerate_id();
    }

    public function read($id)
    {
        $sql = \ORM::for_table('sessions')->find_one($id);
        if ($sql) {
            return $sql->data;
        }
    }

    public function write($id,$data)
    {
        $access = time();
        $session =  \ORM::for_table('sessions')->where('id', $id)->find_one();
        
        if (! $session) {
           $newsession = \ORM::for_table('sessions')->create();
           $newsession->set('id', $id);
           $newsession->set('access', $access);
           $newsession->set('data', $data);
           $newsession->save();
        } else {
           $session->set('id', $id);
           $session->set('access', $access);
           $session->set('data', $data);
           $session->save();
        }
        return true;
    }

    public function destroy($id)
    {
        // delete the session cookie if necessary.
        if (ini_get("session.use_cookies")) 
        {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        }
        
        $session = \ORM::for_table('sessions')->find_one($id);
        $session->delete();
        return true;
    }


    public function clean($max)
    {
        $old = time() - $max;
        \ORM::for_table('sessions')->where_lt('access', $old)->delete_many();
        
        return true;
    }

}
