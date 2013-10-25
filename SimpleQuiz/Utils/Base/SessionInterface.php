<?php
namespace SimpleQuiz\Utils\Base;
/*
 *
 * Base Session Interface
 * 
 *  
 */

interface SessionInterface {

    public function set($key, $value);
    
    public function get($key);
    
    public function remove($key);
    
    public function end();
    
    public function regenerate();
    
}
?>
