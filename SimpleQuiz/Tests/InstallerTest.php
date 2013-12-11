<?php
namespace SimpleQuiz\Tests;

require 'vendor/autoload.php';
/**
*
* @author elanman
*/
class InstallerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->installer = new \SimpleQuiz\Utils\Base\Installer();
    }

    public function testgetRequirements()
    {
        $result = $this->installer->getRequirements();
        $this->assertInternalType('array', $result);
    }
}