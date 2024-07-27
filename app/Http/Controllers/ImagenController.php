<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request){
        // $input = $request->all();
        // return response()->json($input); // (verificar en response netowrk)
        $imagen= $request->file('file'); //
        $nombreImagen = Str::uuid() . "." . $imagen->extension(); //genera un UUID (Identificador Único Universal) y lo concatena con la extension de la imagen

        $imagenServidor = Image::make($imagen); //Crear una instancia de Intervention Image:

        $imagenServidor->fit(1000, 1000); //Ajustar el tamaño de la imagen:

        $imagenPath = public_path('uploads'.'/'.$nombreImagen); //Definir la ruta de almacenamiento de la imagen:

        $imagenServidor->save($imagenPath); // Guardar la imagen en el servidor:
        
        return response()->json(['imagen' => $nombreImagen]); //respuesta JSON que contiene el nombre de la imagen guardada. 

        // return response()->json(['imagen' => $imagen->extension()]);

    }
}
