<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class MainController extends Controller
{
    public function index(){
        /*Tag::create([
            'title' => 'Привет мир!',
        ]);*/
        return view('admin.index');
    }
}
