<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\RestoreRequest;
use App\Services\Auth\DefaultAuthService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class AuthController extends BaseController
{


    public function showLogin()
    {
        return view('pages.auth.login');
    }


    public function handleLogin(LoginRequest $request, DefaultAuthService $service)
    {
        $credentials = $request->only('email', 'password');
        return $service->login($credentials);
    }

    public function logout(DefaultAuthService $service)
    {
        return $service->logout();
    }

    public function showRegistration()
    {
        return view('pages.auth.registration');
    }

    public function handleRegistration(RegistrationRequest $request, DefaultAuthService $service)
    {
        return $service->registration($request);
    }

    public function showRestore()
    {
        return view('pages.auth.restore');
    }

    public function handleRestore(RestoreRequest $request, DefaultAuthService $service)
    {
        return $service->restore($request->validated());
    }


}
