<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AlbumsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\ImagesForAlbum;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Frontend\ContactController;

Route::group(['middleware' => 'guest'], function (){
    Route::get('register', [UserController::class, 'create'])->name('register.create');
    Route::post('register', [UserController::class, 'store'])->name('register.store');
    Route::get('login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('login', [UserController::class, 'login'])->name('login');
});

Route::get('logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function (){
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::resource('/sliders', SliderController::class);

    Route::get('album', [AlbumsController::class, 'getList'])->name('album.index');
    Route::get('album/createalbum', [AlbumsController::class, 'getForm'])->name('create_album_form');
    Route::post('album/createalbum', [AlbumsController::class, 'AlbumCreate'])->name('create_album');
    Route::delete('album/delete_album/{id}', [AlbumsController::class, 'DeleteAlbum'])->name('delete_album');
    Route::post('album/edit_album/{id}', [AlbumsController::class, 'EditAlbum'])->name('album_edit');
    Route::put('album/update_album/{id}', [AlbumsController::class, 'UpdateAlbum'])->name('album_update');
    Route::get('album/show_album/{id}', [AlbumsController::class, 'getAlbum'])->name('show_album');
    Route::post('album/add_images/{id}', [ImagesForAlbum::class, 'addImages'])->name('add_images');
    Route::delete('album/del_images/{id}', [ImagesForAlbum::class, 'destroy'])->name('delete_image');

    Route::get('categories/basket',[CategoryController::class, 'basket'])->name('categories.basket');
   /* Route::post('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');*/
    Route::post('posts/{post}/deleteImage', [PostController::class, 'deleteImage'])->name('posts.deleteImage');
    Route::post('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::post('categories/{category}/del', [CategoryController::class, 'forcedel'])->name('categories.del');

    Route::resource('/menu', MenuController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/posts', PostController::class);
});

Route::group(['namespace' => 'App\Http\Controllers\Frontend'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/sendmail', [ContactController::class,'send'])->name('sendmail');
    Route::get('{slug}', [HomeController::class, 'show'])->name('home.show');
    Route::get('{cat}/{slug?}', [HomeController::class, 'category'])->name('home.category');
    Route::get('tag/{slug}', [\App\Http\Controllers\Frontend\TagController::class, 'show'])->name('tags.single');
});


