<?php
namespace SimpleQuiz\Tests;

use SimpleQuiz\Utils\Base\Installer;

require 'vendor/autoload.php';
/**
*
* @author elanman
*/
class InstallerTest extends \PHPUnit_Framework_TestCase
{
    public $installer;

    public function setUp()
    {
        $this->installer = new Installer();
    }

    public function testgetRequirements()
    {
        $result = $this->installer->getRequirements();
        $this->assertInternalType('array', $result);
    }
}