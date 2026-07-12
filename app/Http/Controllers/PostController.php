<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{

    public function home()
    {
        $posts = Post::where('published', 'yes')
                    ->latest('event_date')
                    ->get();


        return view('home', compact('posts'));
    }

    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
}