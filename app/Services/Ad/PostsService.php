<?php

namespace App\Services\Ad;

use App\Models\Posts;

class PostsService
{

    public function getAll()
    {
        return Posts::all();
    }

}
