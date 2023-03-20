<?php


namespace App\Services\Auth;

use App\Http\Requests\RegistrationRequest;
use App\Mail\mailgunMail;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Mailgun\Mailgun;

class DefaultAuthService
{

    public function login($credentials)
    {
        if (Auth::attempt($credentials)) {

            return redirect(route('list'));
        }

        return redirect(route("login"))->with('errorLogin', 'Login details are not valid');
    }


    public function registration(RegistrationRequest $request)
    {
        $userRequest = $request->only('name', 'email', 'password');
        $user = (new  UserService())->create(...$userRequest);
        Auth::login($user);

        return redirect(route('list'));
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();

        return redirect(route('login'));
    }

    public function restore($request)
    {
        //https://documentation.mailgun.com/en/latest/quickstart-sending.html#send-via-smtp
        //password Nbotyrj123
        //https://github.com/mailgun/mailgun-php
        $email = $request['email'];
        dd(env('MAILGUN_DOMAIN'), env('MAILGUN_SECRET'));
        Mail::to('artemwbtv@gmail.com')->send(new MailgunMail());

# Include the Autoloader (see "Libraries" for install instructions)


        $domain = "sandbox6edfccaf984744b4bb00ca5ca35d6942.mailgun.org";
        $kay = 'b4cc2ffa1becdeb1d6e51a6e7920b0b9-30344472-bce4be7f';


        $mgClient = Mailgun::create($kay);

        $mgClient->messages()->send('example.com', [
            'from' => 'bob@example.com',
            'to' => 'artemwbtv@gmail.com',
            'subject' => 'The PHP SDK is awesome!',
            'text' => 'It is so simple to send a message.'
        ]);
# Issue the call to the client.
        $result = $mgClient->domains()->updateWebScheme($domain, 'https');

        print_r($result);
        dd($result);
        dd('success');


    }


}
