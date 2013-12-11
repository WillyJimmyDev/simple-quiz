<?php
namespace SimpleQuiz\Tests;

require 'vendor/autoload.php';
/**
* Description of QuizTest
*
* @author elanman
*/
class QuizTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        \ORM::configure('mysql:dbname=simple-quiz;host=localhost');
        \ORM::configure('username', 'travis');
        \ORM::configure('password', '');
        \ORM::configure('return_result_sets', true);

        $this->app = new \Slim\Helper\Set();
        $this->app->leaderboard = function() {
            return new \SimpleQuiz\Utils\LeaderBoard();
        };
        $this->quiz = new \SimpleQuiz\Utils\Quiz($this->app);
    }

    public function testsetId()
    {
        
        $result = $this->quiz->setId('ghj');
        
        $this->assertFalse($result);
    }
}