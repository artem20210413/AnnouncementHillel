<?php


namespace App\Services\Mail;


class MailService implements MailInterface
{


    public function send(string $email, string $guid)
    {
        $to = 'artemwbtv@gmail.com';
        $subject = "Password recovery";
        $message = "Follow this link\nhttp://hillel.loc/restore/$guid";

        $headers = "From: artem.tishchnko.work@gmail.com\r\n";
        $headers .= "Reply-To: artem.tishchnko.work@gmail.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail($to, $subject, $message, $headers);
    }
}
