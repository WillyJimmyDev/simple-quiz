<?php
namespace SimpleQuiz\Utils;

/*
 * Basic session class to store sessions in db
 */

class Session implements Base\SessionInterface {

    private  $db;
    
    public function __construct(\SimpleQuiz\Utils\Base\DB $db) {
        
        try
        {
            $this->db = $db;
        }
        catch (\PDOException $e)
        {
            return $e;
        }
        
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
        $this->db = null;
    }
    
    public function regenerate() 
    {
        return session_regenerate_id();
    }

    public function read($id)
    {
        $sql = "SELECT * FROM sessions WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id',$id,\PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['data'];
    }

    public function write($id,$data)
    {
        $access = time();
        $sql = "REPLACE INTO sessions VALUES  (:id, :access, :data)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id',$id,\PDO::PARAM_STR);
        $stmt->bindParam(':access',$access,\PDO::PARAM_STR);
        $stmt->bindParam(':data',$data,\PDO::PARAM_STR);
        $stmt->execute();
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
        
        $sql = 'DELETE FROM sessions WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id',$id,\PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }


    public function clean($max)
    {
        $old = time() - $max;
        $sql = 'DELETE FROM sessions WHERE  access < :old';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':old',$old,\PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }

}
?>