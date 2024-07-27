<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function store(Request $request){
        // dd('Autenticando');
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //si el usuario y contraseña son correctos
        //redireccionar a la home
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) { //$request->remember(mantener sesion iniciada)

            //redireccionar a la pagina anterior con un mensaje de error(with pasa en la variable de session message el mensaje de error)
            return back()->with(['message' => 'email o contraseña incorrectos']);
        }else{
            return redirect()->route('post.index', auth()->user()->username); //redireccionar a muro
        }

        
    }
}
