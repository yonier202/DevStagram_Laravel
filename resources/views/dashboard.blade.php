@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            @if ($user->imagen)
                <div class="w-8/12 lg:w-6/12 px-5">
                    <img src="{{asset('perfiles').'/'.$user->imagen}}" alt="imagen Perfil">
                </div>
            @else
                <div class="w-8/12 lg:w-6/12 px-5">
                    <img src="{{asset('img/perfil.png')}}" alt="imagen Perfil">
                </div>
            @endif
            <div class="md:w-8/12 lg:w-6/12 px-5 flex items-center flex-col md:justify-center md:items-start py-10 md:py-10">
                
                <div class="flex gap-3">
                    <p class="text-gray-700 text-2xl mb-3">{{$user->username}}</p>
                        @auth
                            @if ($user->id === auth()->user()->id) {{--verificar que solo el usuario dueño del muro puede editar--}}
                                <a href="{{route('perfil.index', $user)}}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                      
                                </a>
                            @endif
                        @endauth
                </div>
               

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Seguidores</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->posts->count()}}
                    <span class="font-normal">Publicaciones</span>
                </p>
                @auth
                    @if ($user->id != auth()->user()->id)
                        <form action="" method="POST">
                            @csrf
                            <input type="submit" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Seguir">

                        </form>
                    @endif
                @endauth
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