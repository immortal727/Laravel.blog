<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\StoreCreate;
use App\Http\Requests\Menu\StoreShow;
use App\Http\Requests\Menu\StoreUpdate;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Menu;
use Ramsey\Collection\Collection;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_items = Menu::paginate(5);
        return view('admin.menu.index', compact('menu_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('children')->where('parent_id', 0)->get();
        $posts = Post::orderBy('id', 'desc')->get();
        return view('admin.menu.create', ['menu_item' => [], 'menu_items' => Menu::with('children')->where('parent_id', 0)->get(), 'categories' => $categories, 'delimetr' => '', // Знак уровня вложенности
            'posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreate $request)
    {
        $data = $request->all();
        // Получаем ссылку по нужному типу
        switch ($data['type']) {
            case 'page_link':
                $post = Post::where('id', $data['post_id'])->first('slug');
                $data['url'] = $post['slug'];
                $data['category_id'] = 0;
                break;
            case 'category_link':
                $category = Category::where('id', $data['category_id'])->first('slug');
                //  dd($category['slug']);
                $data['url'] = $category['slug'];
                $data['post_id'] = 0;
                break;
            case 'external_link':
                $data['url'] = $data['external_link'];
                break;
        }
        $data['home'] = (empty($data['home'])) ? '0' : $data['home'];

        // Проверяем, есть ли уже поле home со значением 1
        if (Menu::val_home() == $data['home']) {
            $menu_item = Menu::where('home', 1); // получаем его id
            // Пересохраняем его на 0
            $menu_item->home = 0;
            $menu_item->save();
        };

        Menu::create($data);
        return redirect()->route('menu.index')->with('success', 'Пункт меню добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(StoreShow $request, $id)
    {
        $data = $request->all();
        $menu_item = Menu::find($id);
        $menu_item->save();

        return response()->json(['status' => 'ok']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu_item = Menu::find($id);
        $categories = Category::with('children')->where('parent_id', 0)->get();
        $posts = Post::orderBy('id', 'desc')->get();
        return view('admin.menu.edit', ['menu_item' => $menu_item, 'menu_items' => Menu::with('children')->where('parent_id', 0)->get(), 'categories' => $categories, 'delimetr' => '', // Знак уровня вложенности
            'posts' => $posts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdate $request, $id)
    {
        $data = $request->all();
        $menu_item = Menu::find($id);
        switch ($data['type']) {
            case('page_link'):
                $data['category_id'] = 0;
                if($data['parent_id']){
                    $parent_item = Menu::where('category_id', $data['parent_id'])->first('url');
                    $post = Post::where('id', $data['post_id'])->first('slug');
                    $data['url'] = $parent_item->url.'/'.$post->slug;
                }else{
                    $post = Post::where('id', $data['post_id'])->first('slug');
                    $data['url'] = $post['slug'];
                }

                break;
            case('category_link'):
                $data['post_id'] = 0;
                //$category = Category::where('id', $data['category_id'])->first('slug');
                $category = Category::find($data['category_id']);
                $data['url'] = $category->slug.'/'.$menu_item::MakeUrlCode($data['name']);
                /*if($category->parent_id!=0){
                    // Производим транслитерацию $category->name
                    $data['url'] = $menu_item::MakeUrlCode($data['name']);
                }else{
                    $data['url'] =$category->slug;
                }*/
                break;
        }

        $data['home'] = (empty($data['home'])) ? '0' : $data['home'];
        // Проверяем, есть ли уже поле home со значением 1
        if (Menu::val_home() == $data['home']) {
            $item = Menu::where('home', 1); // получаем его id
            // Пересохраняем его на 0
            $item->home = 0;
            $item->save();
        };
        $menu_item->update($data);
        return redirect()->route('menu.index')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu_item = Menu::find($id);
        if ($menu_item->children->count()) {
            return redirect()->route('menu.index')->with('error', 'Пункт не может быть удалён, так как содержит вложеные пукты');
        }

        // Проверяем, есть ли уже поле home со значением 1
        if (Menu::val_home() == $menu_item->home) {
            return redirect()->route('menu.index')->with('error', 'Пункт не может быть удалён, так как он является главным.
            Назначьте главной страницу другой пункт, а затем можете удалить уже этот');
        };

        $menu_item->delete($id);
        return redirect()->route('menu.index')->with('success', 'Статья удалена');
    }
}
