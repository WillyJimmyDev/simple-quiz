<?php


namespace SimpleQuiz\Utils\Exceptions;


class RegisterException extends \Exception {

    public function __construct()
    {
        parent::__construct("A user already exists with those credentials. Please try again.");
    }
}
