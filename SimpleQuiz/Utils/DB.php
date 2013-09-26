<?php
namespace SimpleQuiz\Utils;

class DB extends \PDO {

    function __construct() {
        parent::__construct('mysql:host='.Config::$dbhost.';dbname='.Config::$dbname,  Config::$dbuser,  Config::$dbpassword);
    }
}
?>
