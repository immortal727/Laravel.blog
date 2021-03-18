<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function create(){
        return view('user.create');
    }

    public function store(StoreUser $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'checkbox' => $request->checkbox,
        ]);

        session()->flash('success', 'Регистрация пройдена');

        Auth::login($user);
        return redirect()->home();
    }

    public function loginForm(){
        return view('user.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required | email',
            'password' => 'required',
        ]);
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])){
            session()->flash('success', 'Вы авторизованы');
            // Является ли автор. пользователь администратором
            if(Auth::user()->is_admin){
                return redirect()->route('admin.index');
            }else return redirect()->home();
        }
        // Если авторизация была не успешна
        return redirect()->back()->with('error', 'Некорректный логин или пароль');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
