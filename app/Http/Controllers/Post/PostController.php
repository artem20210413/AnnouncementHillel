<?php

namespace App\Http\Controllers\Post;

use App\Services\Ad\PostsService;
use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{
    public function __construct( public PostsService $postsService)
    {
    }

    public function list()
    {
        $posts = $this->postsService->getAll();
        return view('pages.post.listPosts', ['posts' => $posts]);
    }
}
