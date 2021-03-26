<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(){
      //  $posts = Post::with('category')->orderBy('id', 'desc')->paginate(6);
        $home = Menu::where('home', 1)->firstOrFail(); // получаю элемент меню у которого home = 1
        $post = Post::where('id', $home->post_id)->firstOrFail(); // по значению post_id нахожу нужный post
        return view('home.index', compact('post'));
    }

    public function show($slug){
        $item_menu = Menu::where('url', $slug)->firstOrFail();
        switch($item_menu->type){
            case 'page_link':
                $post = Post::where('slug', $slug)->firstOrFail();
                // Увеличиваем счетчик просмотров
                $post->view += 1;
                $post->update();
                if($item_menu->home==1){
                    return redirect('/');
                }
                return view('home.show', compact('post'));
            case 'category_link':
                $category = Category::where('slug', $slug)->firstOrFail();
                $posts = Post::where('category_id', $category->id)->get();
                return view('home.category', compact('category', 'posts'));
            case 'external_link':
                return redirect($item_menu->url);
        }
    }

    public function category($cat, $slug = null){
        if($slug){
            $post = Post::where('slug', $slug)->firstOrFail();
            // Увеличиваем счетчик просмотров
            $post->view += 1;
            $post->update();
            return view('home.show', compact('post'));
        }else{
            $category = Category::where('slug', $cat)->firstOrFail();
            if($category){
                $posts = Post::where('category_id', $category->id)->get();
                return view('home.category', compact('category', 'posts'));
            }
        }
    }
}
