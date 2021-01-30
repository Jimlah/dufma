<?php

/**
 * Send emails
 *
 * @param string $to
 * @param string $subject
 * @param string $content
 * @return bool
 */
function mailer(string $to, string $subject, string $content): bool {

    try {

        $transport = (new Swift_SmtpTransport(env('MAIL_HOST'), env('MAIL_PORT'), 'ssl'))
            ->setUsername(env('MAIL_USERNAME'))
            ->setPassword(env('MAIL_PASSWORD'));

        $mailer = new Swift_Mailer($transport);


        $message = (new Swift_Message($subject))
            ->setFrom([env('MAIL_USERNAME') => env('MAIL_SENDER_NAME')])
            ->setTo($to)
            ->setBody($content, 'text/html');

        $mailer->send($message);

    } catch (Swift_RfcComplianceException $e) {
        $msg = $e->getMessage();
        return false;
    }

    return true;
} 