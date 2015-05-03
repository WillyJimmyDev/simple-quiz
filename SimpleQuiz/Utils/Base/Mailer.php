<?php


namespace SimpleQuiz\Utils\Base;


use Swift_SmtpTransport;

class Mailer {

    private $instance;
    private $message;
    private $decorator;

    function __construct()
    {
        // Create the SwiftMailer Instance
        $transport = Swift_SmtpTransport::newInstance(Config::$mailHost, Config::$mailPort)
            ->setUsername(Config::$mailUser)
            ->setPassword(Config::$mailPass)
        ;

        $this->instance = \Swift_Mailer::newInstance($transport);
        $this->message = \Swift_Message::newInstance();
        $this->message->setFrom(array(Config::$appEmail => Config::$appname));
    }


    /**
     * @param User $user
     * @return bool
     */
    public function sendConfirmationEmail(User $user)
    {
        // Build the message
        $this->message->setSubject('Welcome to Simple Quiz, please confirm your email address');

        $replacements = array();
        $confirmHash = sha1($user->getEmail() .mt_rand() . $user->getId());

        $replacements[$user->getEmail()] = array(
            '{username}'=>$user->getName(),
            '{hash}'=> $confirmHash,
            '{sitename}' => Config::$siteurl
        );

        $this->decorator = new \Swift_Plugins_DecoratorPlugin($replacements);

        $this->instance->registerPlugin($this->decorator);

        $this->readFromFile('registerconfirm');
        $this->message->setTo(array($user->getEmail() => $user->getName()));

        // Send the message
        if ($this->instance->send($this->message) > 0)
        {
            $record = \ORM::for_table('users')->find_one($user->getId());
            $record->set('confirmhash', $confirmHash);
            $record->set_expr('hashstamp', 'now()');
            $record->save();
            return true;
        }
        return false;
    }

    /**
     * @param $template
     * @return $this
     */
    private function readFromFile($template)
    {
        $bodyhtml = file_get_contents("../templates/email/$template.html");
        $bodytxt = file_get_contents("../templates/email/$template.txt");
        $this->message->setBody($bodyhtml, 'text/html');
        $this->message->addPart($bodytxt, 'text/plain');
        return $this;
    }
}
