<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreTag;
use App\Models\Tag;

class TagController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::paginate(2);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Сохранение формы
    public function store(StoreTag $request)
    {
        // Валидируем только title,
        // так как sluggable придет к нужному виду slug за нас
        /*$request->validate([
            'title' => 'required',
        ]);*/

        // Валидация происходит в StoreTag

        Tag::create($request->all());
        //        $request->session()->flash('success', 'Категория добавлена');
        return redirect()->route('tags.index')->with('success', 'Тэг добавлен');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Находим нужный тэг
        $tag = Tag::find($id);
        // Передаем в представлениие
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTag $request, $id)
    {
        $tag = Tag::find($id);
        // Если хотим менять slug
        // $category->slug = null;
        $tag->update($request->all());

        // Редирект на список категорийй
        return redirect()->route('tags.index')->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if($tag->posts->count()) {
            return redirect()->route('tags.index')->with('error', 'Ошибка при удалении. Тэг может быть прикреплен к одной или к нескольим записям (статьям)');
        }
        $tag->destroy($id);
        return redirect()->route('tags.index')->with('success', 'Тэг удален');
    }

}
