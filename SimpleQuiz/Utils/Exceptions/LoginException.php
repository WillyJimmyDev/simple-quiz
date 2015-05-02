<?php


namespace SimpleQuiz\Utils\Exceptions;


class LoginException extends \Exception {

        public function __construct()
        {
            parent::__construct("There was an error trying to log you in to the application. If the proble persists,
            please contact the site administrator.");
        }
}
