<?php
namespace SimpleQuiz\Utils\Base;

class Installer 
{
    public $requirements = array();
    public $version;
    public $versionimg;
    public $versionmsg = 'PHP Version 5.3.7 or greater is required.';
    public $random = false;
    public $randomimg = 'ok';
    public $randommsg = 'This is needed to generate random numbers for use with the PasswordLib library';

    public function __construct() {
        $this->version = phpversion();
    }
    
    public function getRequirements() {
        
        $this->versionimg = version_compare($this->version, '5.3.7', '>=') ? 'ok' : 'remove';
        
        try {
            $this->random = file_exists('/dev/urandom');
        } catch (\Exception $e) {
            $this->randomimg = 'remove';
            $this->randommsg .= "\n" . $e->getMessage();
        }

        $this->requirements['version'] = array('vers' => $this->version, 'img' =>  $this->versionimg, 'msg' => $this->versionmsg);
        $this->requirements['random'] = array('random' => $this->random, 'img' => $this->randomimg, 'msg' => $this->randommsg);

        return $this->requirements;
    }
}
