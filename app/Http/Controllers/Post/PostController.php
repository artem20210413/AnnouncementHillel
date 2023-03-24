<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\Ad\PostsService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class PostController extends BaseController
{
    public function __construct(public PostsService $postsService)
    {
    }

    public function list()
    {
        $posts = $this->postsService->getAll();
        return view('pages.post.listPosts', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        $user = $this->postsService->getUser($post);
        return view('pages.post.showPosts', ['post' => $post, 'user' => $user]);
    }

    public function edit(Post $post)
    {
        return view('pages.post.editPosts', ['post' => $post]);
    }

    public function create()
    {
        return view('pages.post.editPosts');
    }

    public function save(PostRequest $request)
    {
        $user = Auth::user();
        return $this->postsService->save($user, ...$request->validated());
    }

    public function delete(Post $post)
    {
        return $this->postsService->delete($post);
    }
}
