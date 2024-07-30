<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Middleware\Authorize;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(User $user){
        // if ($user->id !== auth()->user()->id) {
        //     abort(403);
        // }
        // Autorizar al usuario para editar su propio perfil
        //Laravel automáticamente pasa el usuario autenticado como primer argumento y  $user que proporcionaste como segundo argumento al método correspondiente en la policy.
        $this->authorize('update', $user);

        return view('perfil.index', compact('user'));
    }
    public function store(Request $request)
    {

        // dd($request->all());

        $request->request->add([
            'username' => Str::slug($request->username) //covertir en formato url(jhonier-rojas)
        ]);
        
        $this->validate($request,[
            'username' =>'required|string|max:255|unique:users,username,'.auth()->user()->id,
            'email' =>'required|email|max:255|unique:users,email,'.auth()->user()->id,
        ]);
        if ($request->imagen) {
            $imagen= $request->file('imagen'); //
            $nombreImagen = Str::uuid() . "." . $imagen->extension(); //genera un UUID (Identificador Único Universal) y lo concatena con la extension de la imagen

            $imagenServidor = Image::make($imagen); //Crear una instancia de Intervention Image:

            $imagenServidor->fit(1000, 1000); //Ajustar el tamaño de la imagen:

            $imagenPath = public_path('perfiles'.'/'.$nombreImagen); //Definir la ruta de almacenamiento de la imagen:

            $imagenServidor->save($imagenPath);
        }
        //validar email y contraseña (autenticandolos)
        if (!auth()->attempt($request->only('email', 'password'))) { 

            //redireccionar a la pagina anterior con un mensaje de error(with pasa en la variable de session message el mensaje de error)
            return back()->with(['message' => 'email o contraseña incorrectos']);
        }
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->email = $request->email;
        $usuario->password =  bcrypt($request->new_password);  //encriptar nueva contraseña
        $usuario->save();
        return redirect()->route('post.index', $usuario->username); //redireccionar a muro
        

        
    }
}
