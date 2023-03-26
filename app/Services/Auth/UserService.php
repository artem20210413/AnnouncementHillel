<?php


namespace App\Services\Auth;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    public function create($name, $email, $password): User
    {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->setPasswordAttribute($password);
        $user->save();
        return $user;
    }
}
