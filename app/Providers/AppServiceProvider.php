<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Slider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->menuLoad();
        View::composer('layouts.columnLeft', function ($view){
            if(Cache::has('cats')){
                $cats = Cache::get('cats');
            }else{
                $cats = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();
                Cache::put('cats', $cats, 30);
            }
            $home = Menu::where('home', 1)->firstOrFail(); // получаем элемент меню у которого home = 1
            $popular_posts = Post::where('id', '<>', $home->post_id)->orderBy('view', 'desc')->limit(3)->get();
            $view->with('popular_posts', $popular_posts);
            $view->with('cats', $cats);
        });
        DB::listen(function($query){
            Log::channel('sqllogs')->info($query->sql);
        });
    }

    public function menuLoad(){
        // С помощью composer передаем в макет
        View::composer(['layouts.layout', 'layouts.columnLeft' ], function ($view){
            $view->with('items', Menu::with('children')->where('parent_id', 0)->get());
            $view->with('categories', Category::with('children')->where('parent_id', 0)->get());
            $view->with('sliders', Slider::orderBy('weight', 'desc')->where('active', 1)->get());
        });

    }
}
