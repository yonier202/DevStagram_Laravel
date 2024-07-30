<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke(){
        //obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(10);
         // $seguidores = auth()->user()->followings;
        // //obtener los posteos de los seguidores
        // $posteos = collect();
        // foreach($seguidores as $seguidor){
        //     $posteos = $posteos->merge($seguidor->posts);
        // }
        // dd($posteos);

        // //ordenar los posteos por fecha descendiente
        // $posteos = $posteos->sortByDesc('created_at');

        // //obtener los likes de los posteos
        // $likes = collect();
        // foreach($posteos as $posteo){
        //     $likes = $likes->merge($posteo->likes);
        // }

        // //obtener los comentarios de los posteos
        // $comentarios = collect();
        // foreach($posteos as $posteo){
        //     $comentarios = $comentarios->merge($posteo->comentarios);
        // }
        return view('home', compact('posts'));
    }
}
