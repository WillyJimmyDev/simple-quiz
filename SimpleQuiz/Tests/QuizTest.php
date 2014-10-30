<?php
namespace SimpleQuiz\Tests;

use SimpleQuiz\Utils\LeaderBoard;
use SimpleQuiz\Utils\Quiz;
use Slim\Helper\Set;

require 'vendor/autoload.php';

/**
 * Class QuizTest
 * @package SimpleQuiz\Tests
 */
class QuizTest extends \PHPUnit_Framework_TestCase
{
    public $app;
    public $quiz;

    public function setUp()
    {
        \ORM::configure('mysql:dbname=simple-quiz;host=localhost');
        \ORM::configure('username', 'travis');
        \ORM::configure('password', '');
        \ORM::configure('return_result_sets', true);

        $this->app = new Set();
        $this->app->leaderboard = function() {
            return new LeaderBoard();
        };
        $this->quiz = new Quiz($this->app);
    }

    public function testCantSetIdToString()
    {
        $result = $this->quiz->setId('ghj');
        
        $this->assertFalse($result);
    }

    public function testGetIdReturnsInt()
    {
        $this->quiz->setId(1);
        $result = $this->quiz->getId();

        $this->assertInternalType('int', $result);
    }

    public function testGetQuestionReturnsObject() {

        $this->quiz->setId(8);
        $this->quiz->populateQuestions();
        $question = $this->quiz->getQuestion(1);
        $this->assertInternalType('object', $question);
    }
}