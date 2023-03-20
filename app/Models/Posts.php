<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Posts
 * @package App\Models
 * @property integer id
 * @property  string title
 * @property string description
 * @property integer userId
 */
class Posts extends Model
{
    use HasFactory;

    public function category(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }
}
