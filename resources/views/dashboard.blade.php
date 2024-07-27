@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{asset('img/perfil.png')}}" alt="imagen Perfil">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex items-center flex-col md:justify-center md:items-start py-10 md:py-10">
                <p class="text-gray-700 text-2xl mb-3">{{$user->username}}</p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Seguidores</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$posts->count()}}
                    <span class="font-normal">Publicaciones</span>
                </p>
            </div>
        </div>
    </div>

    @if ($posts->count())
        <section class="container mx-auto mt-10">
            <h2 class="text-4xl text-center font-black my-10">
                Publicaciones
            </h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{route('post.show', ['post' => $post, 'user' => $user])}}">
                            <img src="{{ asset('uploads') . '/' .$post->imagen}}" alt="Imagen del post {{$post->titulo}}">
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @else
        <section class="container mx-auto mt-10">
            <h2 class="text-4xl text-center font-black my-10">
                No hay Publicaciones
            </h2>
        </section>
    @endif

   <div class="my-10 ">
        {{$posts->links('pagination::tailwind')}}
   </div>

    
@endsection