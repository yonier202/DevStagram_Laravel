<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    public function __construct(){
       $this->middleware('auth')->except(['show', 'index']); //proteger ruta, si no esta autenticado, enviar al login
    }
    public function index(User $user){
        //revisar si el suaurio esta autenticado
        // dd(auth()->user());
        //mostrar los posts del usuario autenticado
        // dd(auth()->user()->posts);

        $posts = Post::where('user_id', $user->id)->paginate(2); //traer los posts del usuario autenticado
        return view('dashboard', compact('user', 'posts'));
    }
    //metodo para mostrar el formulario de crear un post
    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' =>'required',
            'imagen' =>'required',
        ]);
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('post.index', auth()->user()->username);
    }
    public function show(User $user, Post $post, ) {
        return view('posts.show', compact('post', 'user'));
    }

    public function destroy(Post $post) {
        // php artisan make:policy PostPolicy --model=Post //crear un policy y asociarlo al modelo
        $this->authorize('delete', $post);
        $post->delete();

        //Eliminar la imagen
        $imagen_patch=  public_path('uploads' . '/' .$post->imagen);
        if (File::exists($imagen_patch)) {
            unlink($imagen_patch);
        }

        return redirect()->route('post.index', auth()->user()->username);
    }
    

}
