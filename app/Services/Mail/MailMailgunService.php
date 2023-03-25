<?php


namespace App\Services\Mail;


use App\Mail\MailgunMail;
use Illuminate\Support\Facades\Mail;

class MailMailgunService implements MailInterface
{


    public function send(string $email, string $guid)
    {
        Mail::to($email)->send(new MailgunMail($guid));
    }
}
