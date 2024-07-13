<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function Login(){
        if(Auth::check()){
            return redirect('/dashboard');
        }else{
            return view("login");
        }
    }

    public function handleLogin(Request $request){
        $validate = $request->validate([
            "username" => ['required', 'min:2'],
            "password" => ['required', 'min:2']
        ]);
        $cred = [
            "username" => $validate['username'],
            "password" => $validate['password']
        ];
        if(Auth::attempt($cred)){
            return redirect('/dashboard');
        }else{
            return redirect('/')->with(['error' => "Wrong username or password"]);
        }
    }

    public function handleLogout(){
        Auth::logout();
        return redirect(URL::previous());
    }
}
