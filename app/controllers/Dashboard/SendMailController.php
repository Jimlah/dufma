<?php

namespace App\Controllers\Dashboard;


use App\Core\Http\Controller;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
use Swift_RfcComplianceException;

class SendMailController extends Controller
{

    /**
     * 
     * @param email: the email you are sending to
     * @param name: the name of the person
     * @param msg: the message
     */
    public static function send($email, $msg)
    {
        try {
            $transport = (new Swift_SmtpTransport('mail.dufma.ng', 25))
                ->setUsername('admin@fmcdufma.demisho.com.ng')
                ->setPassword('2-Jae1li1bm');

            $mailer = new Swift_Mailer($transport);


            $message = (new Swift_Message('WonderFul Subject'))
                ->setFrom(['admin@fmcdufma.demisho.com.ng' => 'Dufma'])
                ->setTo("$email")
                ->setBody($msg);


            $mailer->send($message);
            return;
        } catch (Swift_RfcComplianceException $e) {
            $msg = $e->getMessage();
            return $msg;
        }
    }
}
