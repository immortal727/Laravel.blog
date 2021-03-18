<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(3);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create',[
            'category' => [],
            'categories' => Category::with('children')->where('parent_id', 0)->get(),
            'delimetr' => '', // Знак уровня вложенности
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Сохранение формы
    public function store(StoreCategory $request)
    {
        // Валидируем только title,
        // так как sluggable придет к нужному виду slug за нас
        /*$request->validate([
            'title' => 'required',
        ]);*/

       // Валидация происходит в StoreCategory

        Category::create($request->all());
        //        $request->session()->flash('success', 'Категория добавлена');
        return redirect()->route('categories.index')->with('success', 'Категория добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Находим категорию
        $category = Category::find($id);
        return view('admin.categories.edit',[
            'category' => $category,
            'categories' => Category::with('children')->where('parent_id', 0)->get(),
            'delimetr' => '', // Знак уровня вложенности
        ]);

        // Передаем в представлениие
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategory $request, $id)
    {
        $category = Category::find($id);
        // Если хотим менять slug
       // $category->slug = null;
        $category->update($request->all());

        // Редирект на список категорийй
        return redirect()->route('categories.index')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->posts->count()) {
            return redirect()->route('categories.index')->with('error', 'Категория не может быть удалена, так как у нее есть записи. В начале удалите записи, принадлежащие к ней');
        }
        Category::destroy($id);
        return redirect()->route('categories.index')->with('error', 'Категория перемещена в корзину');
    }

    public function basket(){
        $categories = Category::onlyTrashed()->get();

        return view('admin.categories.basket', compact('categories'));
    }

    // Восстановление категории из корзины
    public function restore($id){
        Category::withTrashed()->where('id', $id)->restore();
        $categories = Category::find($id);
        return redirect()->route('categories.index', compact('categories'));
    }

    // Полное удаление категории из базы
    // или удаление псевдоудаленной модели
    public  function forcedel($id){
        Category::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('categories.basket')->with('success', 'Категория удалена');
    }
}
