<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){

        //modificar el request
        $request->request->add([
            'username' => Str::slug($request->username)
        ]);
        // dd($request);
        //lerr datos enviados en el formulario
        // dd($request->get('name'));
        //validar los datos
        $this->validate($request,[
            'name' =>'required|string|min:5',
            'username' =>'required|unique:users|min:3|max:50',
            'email' =>'required|email|max:60|unique:users',
            'password' =>'required|confirmed|min:6',
        ]);

        // dd('Creando Usuario');
        //user create = inser into
        User::create([
            'name' => $request->name,
            'username' => $request->username, //convertir sin espacio y en minuscula
            'email' => $request->email,
            'password' => Hash::make($request->password), //encriptar contraseña

        ]);

        //autenticar Usuario
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        //otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        //redireccionar al usuario a la ruta con name ('post.index')
        return redirect()->route('post.index'); //redireccionar a muro
    }
}
