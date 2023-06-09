<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::query()->paginate(20);
        return Post::all();
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
    
        return Post::create([
            'title' => request('title'),
            'content' => request('content')
        ]);
    }

    public function update(Post $post)
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        
        $success = $post->update([
            'title' => request('title'),
            'content' => request('content')
        ]);
    
        return [
            'success' => $success
        ];
    }

    public function remove(Post $post)
    {
        $success = $post->delete();
    return [
        'success' => $success
    ];
    }
}
