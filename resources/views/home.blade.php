{{-- directiva para cargar desde otra vista (trear un nav)--}}
@extends('layouts.app')


    @section('titulo')
        Pagina principal
    @endsection

    @section('contenido')
        
        <x-listar-post :posts="$posts" />  {{--pasar la variable al componente--}}
    @endsection
