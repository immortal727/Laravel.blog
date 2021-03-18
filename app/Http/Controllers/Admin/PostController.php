<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreShow;
use App\Http\Requests\StorePost;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'tags')->paginate(7);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // При помощи метода pluck указываем,
        //  каким ключом мы хотим получить коллекцию
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();
        return view('admin.posts.create',[
            'post' => [],
            'categories' =>  $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Сохранение формы
    public function store(StorePost $request)
    {
        // Валидация происходит в StorePost
        $data = $request->all();

        $data['thumbnail'] = Post::uploadImage($request);

        // Добавляем в начале сам пост (статью)
        // Исключаем поле с категориями
        $post = Post::create($data);
        $post->tags()->sync($request->tags);

        return redirect()->route('posts.index')->with('success', 'Cтатья добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Получаем сам пост
        $post = Post::find($id);
        // Получаем категории и тэги
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        return view('admin.posts.edit', compact('categories', 'tags', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, Post $post)
    {
        // Производим транслитерацию
        $post->slug=$post::MakeUrlCode($request->slug);
        // Получаем все элементы коллекции кроме указанных ключей
        $data = $request->except('slug');

        if ($file = Post::uploadImage($request, $post->thumbnail)) {
            $data['thumbnail'] = $file;
        }

        // Обновляем пост
        $post->update($data);
         // Синхронизируем тэги
        $post->tags()->sync($request->tags);
        // Редирект на список категорийй
        return redirect()->route('posts.index')->with('success', 'Изменения сохранены');
    }

    public function deleteImage(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $requestImag = $request->get('picture');
       \Illuminate\Support\Facades\File::delete($post->$requestImag);

        $post->thumbnail = null;
        $post->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        // Удаляем связннаые данные через sing, передавая пустой массив
        $post->tags()->sync([]);
        Storage::delete($post->thumbnail);
        $post->delete($id);
        return redirect()->route('posts.index')->with('success', 'Статья удалена');
    }

    public function show(StoreShow $request, $id){
        $data= $request->all();
        $post = Post::find($id);
        $post->live = $data['show'];
        //dd($post->view);
        $post->save();

        return response()->json([
            'status' => 'ok'
        ]);

        /*Post::withTrashed()->where('id', $id)->restore();
        $post = Category::find($id);
        return redirect()->route('categories.index', compact('post'));*/
    }

    public function basket(){
        $posts = Post::onlyTrashed()->get();
        return view('admin.posts.basket', compact('posts'));
    }
}
