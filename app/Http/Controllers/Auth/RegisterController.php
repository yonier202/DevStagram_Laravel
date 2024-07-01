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
            'username' =>'required|unique:users|min:3|max:50',
            'email' =>'required|email|max:60|unique:users',
            'password' =>'required',
        ]);
    }
}
