<?php


namespace SimpleQuiz\Utils\User;


use SimpleQuiz\Utils\Base\User;

class AdminUser extends User{

    function __construct($email, $name)
    {
        parent::__construct($email, $name);
    }
}
