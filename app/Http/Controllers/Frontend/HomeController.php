<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(6);
        return view('home.index', compact('posts'));
    }

    public function show($slug){
        $post = Post::where('slug', $slug)->firstOrFail();

        // Увеличиваем счетчик просмотров
        $post->view += 1;
        $post->update();
        return view('home.show', compact('post'));
    }
}
