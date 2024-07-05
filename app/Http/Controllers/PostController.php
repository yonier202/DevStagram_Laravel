<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(){
       $this->middleware('auth'); 
    }
    public function index(){
        //revisar si el suaurio esta autenticado
        // dd(auth()->user());
        //mostrar los posts del usuario autenticado
        // dd(auth()->user()->posts);
        return view('dashboard');
    }
}
