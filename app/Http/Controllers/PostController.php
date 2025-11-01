<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Support\PostShowLoader;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index() 
    {

        $posts = Post::with([
            'category',
            'user'
        ])
        ->latest()
        ->paginate(24);

        return view('posts.index', [
            'posts' => $posts,
        ]);

    }

    public function create() 
    {
        $categories = Category::all();

        return view('posts.create',[
            'categories' => $categories,
        ]);


    }

    public function store (StorePostRequest $request)
    {

        $post = Post::create([
            'user_id' => Auth::id(),
            ...$request->validated(),
        ]);

        return redirect()->route('posts.show', $post);

    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('posts.edit',[
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    public function update( UpdatePostRequest $request, Post $post)
    {

        $post->update($request->validated());

        return redirect()->route('posts.show', $post);

    }

    public function show(Post $post, PostShowLoader $loader) 
    {

        $loader->load($post);


        return view('posts.show', [
            'post' => $post,
        ]);

    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('home');
    }
}
