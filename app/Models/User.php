<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class UserSeeder
 * @package App\Models
 * @property integer id
 * @property string name
 * @property string emails
 * @property string password
 */
class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';

    protected $hidden = [
        'password'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Posts::class, 'userId', 'id');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
