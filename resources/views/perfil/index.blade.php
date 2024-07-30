@extends('layouts.app')

@section('titulo')
    Editar perfil {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{route('perfil.store', $user)}}" method="POST" class="mt-10 md:mt-0" enctype="multipart/form-data">
                @csrf
                {{--credenciales incorrectas --}}
                @if (session('message'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('message')}}</p>
                @endif

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text" id="username" name="username" placeholder="Tu Nombre" class="border p-3 w-full rounded-lg 
                    @error('username') border-red-500 @enderror" value="{{auth()->user()->username}}"/>

                    
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen perfil
                    </label>
                    <input type="file" id="imagen" name="imagen" class="border p-3 w-full rounded-lg 
                    accept=".jpg, .jpeg, .png"/>
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Correo
                    </label>
                    <input type="email" id="email" name="email" placeholder="Tu Nombre" class="border p-3 w-full rounded-lg 
                    @error('email') border-red-500 @enderror" value="{{auth()->user()->email}}"/>

                    
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
            
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input type="password" id="password" name="password" class="border p-3 w-full rounded-lg
                    @error('password') border-red-500 @enderror">

                    
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">Nueva Contraseña</label>
                    <input type="password" id="new_password" name="new_password" class="border p-3 w-full rounded-lg
                    @error('new_password') border-red-500 @enderror">

                    
                    @error('new_password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <input type="submit" value="Guardar Cambios"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                font-bold w-full p-3 text-white rounded-lg"/>
            </form>
        </div>
    </div>
@endsection