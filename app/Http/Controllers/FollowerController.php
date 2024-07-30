<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user){
        // dd($request->all());
        //dd($user);
        //dd($user->followers()->attach($request->user_id));
        $user->followers()->attach(auth()->user()->id);
        return back(); //regresar a la vista del usuario con los seguidores actualizados
    }

    public function destroy(User $user){
        // dd($request->all());
        // dd($user);
        //dd($user->followers()->detach($request->user_id));
        $user->followers()->detach(auth()->user()->id);
        return back(); //regresar a la vista del usuario con los seguidores actualizados
    }
}
