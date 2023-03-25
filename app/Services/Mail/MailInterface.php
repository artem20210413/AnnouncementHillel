<?php


namespace App\Services\Mail;


interface MailInterface
{

    public function send(string $email, string $guid);

}
