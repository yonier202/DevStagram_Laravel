<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        // dd($request);
        //lerr datos enviados en el formulario
        // dd($request->get('name'));

        //validar los datos
        $this->validate($request,[
            'name' =>'required|string|min:5',
            'email' =>'required|string|email|max:255|unique:users',
            'password' =>'required|string|min:8|confirmed',
        ]);
    }
}
