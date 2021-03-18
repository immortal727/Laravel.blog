<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Album\StoreCreate;
use App\Http\Requests\Album\StoreUdpate;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class AlbumsController extends Controller
{
    public function getList(){
        $albums = Album::with('Photos')->paginate(6);
        return view('admin.albums.index', compact('albums'));
    }

    public function getAlbum($id){
        $album = Album::with('Photos')->find($id);
        return view('admin.albums.album', compact('album'));
    }

    public function getForm() {
        $categories = Category::all();
        return view('admin.albums.createalbum',[
            'album' => '',
            'categories' => $categories,
            'delimetr' => '' // Знак уровня вложенности
        ]);
    }

    public function AlbumCreate(StoreCreate $request, Album $album ){
        $data = $request->all();
        $data['cover_image'] = Album::uploadImage($request);
        $data['post_id']=0;
        Album::create($data);

        return Redirect::route('album.index');
    }

    public function EditAlbum($id){
        $album = Album::find($id);
        $posts = Post::all();
        $album_post = $album->posts; // Узнаем все посты, связанные с альбомом
        return view('admin.albums.edit', [
            'album' => $album,
            'categories' => Category::with('children')->where('parent_id', 0)->get(),
            'delimetr' => '', // Знак уровня вложенности
            'posts' => $posts,
            'album_post' => $album_post,
        ]);
    }

    public function UpdateAlbum(StoreUdpate $request, $id){
        $album = Album::find($id);
        $data = $request->all();
       // dd($request->file('cover_image'));

        // Получаем значение скрытого поля, чтоб удалить старую картинку
        if ($file = Album::uploadImage($request, $request->old_image)) {
            $data['cover_image'] = $file;
        }

        $album->update($data);
        return Redirect::route('album.index')->with('success', 'Алюбом изменен');
    }

    public function DeleteAlbum($id)
    {
        $album = Album::find($id);
        if($album->Photos->count()){
            return redirect()->route('album.index')->with('error', 'Альбом не может быть удален, так как в нем есть изображения');
        }
        Storage::delete('albums/'.$album->cover_image);
        $album->delete();
        return Redirect::route('album.index')->with('success', "Альбом удален");
    }
}
