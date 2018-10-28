<?php

namespace LPPMKP\Library;

require_once BASE_PATH . '/vendor/autoload.php';

use Swift_Message as SMsg;
use Swift_SmtpTransport as Smtp;
use Swift_Mailer as Smailer;

class Mail
{
    public function send($smtp,$user,$message)
    {
        $transport = new Smtp(
            $smtp['host'],
            $smtp['port'],
            $smtp['security']
        );
        if ($transport) {
            $transport->setUsername($user['username'])
                ->setPassword($user['password']);

            // Create the Mailer using your created Transport
            $mailer = new Smailer($transport);

            $smsg = new SMsg();

            $smsg
                ->setFrom($user['from'])
                ->setTo($message['to'])
                ->setSubject($message['subject'])
                ->addPart($message['body'], 'text/html');
        }

        // Send the message
        return $mailer->send($smsg);
    }

}