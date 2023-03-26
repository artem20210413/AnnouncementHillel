<?php

namespace App\Services\Ad;

use App\Models\Post;

class PostsService
{

    public function getAll()
    {
        return Post::with('user')->orderBy('created_at', 'desc')->paginate(5);
//        return Post::all();
    }

    public function getUser(Post $post)
    {
        return $post->user()->first();
    }

    public function edit(Post $post)
    {
        return $post->user()->first();
    }

    public function save($user, int $id, string $title, string $description)
    {
        if ($id != 0) {
            $post = Post::find($id);
        } else {
            $post = new Post();
            $post->userId = $user->id;
        }
        $post->title = $title;
        $post->description = $description;
        $post->save();

        return redirect("/{$post->id}/show");
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect(route('list'));
    }

}
