<?php


namespace App\Services\Auth;

use App\Facades\MailFacade;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\RestoreRequest;
use App\Mail\mailgunMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Mailgun\Mailgun;

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
        MailFacade::send($email, $guid);
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
    }


}
