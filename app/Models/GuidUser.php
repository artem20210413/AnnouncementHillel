<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class GuidUser
 * @package App\Models
 * @property integer id
 * @property integer userId
 * @property string guid
 * @property bool active
 */
class GuidUser extends Model
{
    use HasFactory;

    public $table = 'guidUsers';

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }
}
