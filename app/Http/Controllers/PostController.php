<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index() 
    {

        $posts = Post::with('category','user')->latest()->get();

        return view('posts.index', [
            'posts' => $posts,
        ]);

    }

    public function show(Post $post) 
    {

        $post->load('category', 'user');

        return view('posts.show', [
            'post' => $post,
        ]);

    }
}
