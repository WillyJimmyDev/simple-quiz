<?php
namespace SimpleQuiz\Utils\Base;

class DB extends \PDO {

    function __construct() {
        parent::__construct('mysql:host='.Config::$dbhost.';dbname='.Config::$dbname,  Config::$dbuser,  Config::$dbpassword);
    }
}
?>
