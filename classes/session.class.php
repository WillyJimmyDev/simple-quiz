<?php

/*
 * Basic session class to store sesssions in db
 */

class Session {

    public function __construct(){
    }
/*
 * OPEN - replace with direct database handle if required
 */
    public function open(){
        try{
           $this->db = new PDO('mysql:host='.Config::$dbhost.';dbname='.Config::$dbname,  Config::$dbuser,  Config::$dbpassword);
           return true;
        }catch(PDOException $e){
            $this->error = $e;
            return false;
        }
    }

    public function close(){
        $this->db = null;
    }

    public function read($id){
        $sql = 'SELECT * FROM sessions WHERE id =\''.$id.'\'';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['data'];
    }

    public function write($id,$data){
        $access = time();
        $sql = "REPLACE INTO sessions VALUES  (:id, :access, :data)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_STR);
        $stmt->bindParam(':access',$access,PDO::PARAM_STR);
        $stmt->bindParam(':data',$data,PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }

    public function destroy($id){
        $sql = 'DELETE FROM sessions WHERE id = '.$id;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return true;

    }


    public function clean($max){
        $old = time() - $max;
        $sql = 'DELETE FROM sessions WHERE  access < :old';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':old',$old,PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }


    public function start(){
        session_set_save_handler(array($this,'open'),
                                 array($this,'close'),
                                 array($this,'read'),
                                 array($this,'write'),
                                 array($this,'destroy'),
                                 array($this,'clean')
                                );
        session_start();
    }


}
?>
