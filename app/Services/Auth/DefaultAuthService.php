<?php


namespace App\Services\Auth;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\RestoreRequest;
use App\Mail\mailgunMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DefaultAuthService
{

    public function __construct(public GuidLinkService $guidLinkService)
    {
    }

    private function authUserLogin($user)
    {
        Auth::login($user);
        return redirect(route('list'));
    }

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

        return $this->authUserLogin($user);
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();

        return redirect(route('login'));
    }

    public function sendGuidMail($email, $guid)
    {

        Mail::to($email)->send(new MailgunMail());

//        $mgClient = new Mailgun(env('MAILGUN_SECRET'));
//        $domain = env("MAILGUN_DOMAIN");
//# Make the call to the client.
//        $result = $mgClient->sendMessage($domain, array(
//            'from'	=> 'Excited User <mailgun@YOUR_DOMAIN_NAME>',
//            'to'	=> 'Baz <YOU@YOUR_DOMAIN_NAME>',
//            'subject' => 'Hello',
//            'text'	=> 'Testing some Mailgun awesomness!'
//        ));


//        //https://documentation.mailgun.com/en/latest/quickstart-sending.html#send-via-smtp
//        //password Nbotyrj123
//        //https://github.com/mailgun/mailgun-php
//# Include the Autoloader (see "Libraries" for install instructions)
//
//
//        $domain = "sandbox6edfccaf984744b4bb00ca5ca35d6942.mailgun.org";
//        $kay = 'b4cc2ffa1becdeb1d6e51a6e7920b0b9-30344472-bce4be7f';
//
//
//        $mgClient = Mailgun::create($kay);
//
//        $mgClient->messages()->send('example.com', [
//            'from' => 'bob@example.com',
//            'to' => 'artemwbtv@gmail.com',
//            'subject' => 'The PHP SDK is awesome!',
//            'text' => 'It is so simple to send a message.'
//        ]);
//# Issue the call to the client.
//        $result = $mgClient->domains()->updateWebScheme($domain, 'https');
//
//        print_r($result);
//        dd($result);
//        dd('success');

    }

    public function restore(RestoreRequest $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();

        if ($user != null) {
            $guid = $this->guidLinkService->createGuid($user);
            $this->sendGuidMail($email, $guid);
        }

        return redirect(route('login'))->with('message', 'Check your mail');
    }

    public function restoreByGuid($guid)
    {
        if ($user = $this->guidLinkService->checkGuid($guid)) {

            return view('pages.auth.changePassword', ['user' => $user]);
        }

        return redirect(route('login'))->with('error', 'link is not active');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $userId = $request->id;
        $password = $request->password;
        $user = User::find($userId);
        $user->setPasswordAttribute($password);
        $user->update();
        (new GuidLinkService())->deactivationGuidUser($user);

        return redirect(route('login'))->with('message', 'Password changed successfully');
//        return $this->authUserLogin($user);
    }


}
