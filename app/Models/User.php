<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //valores que espera recibir para insertar en la base de datos
    protected $fillable = [
        'name',
        'username', //tambien registramos username
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //aqui se crea la relacion con la tabla de posts
    public function posts(){
        return $this->hasMany(Post::class); //RELACION 1 A MUCHOS
    }

    //aqui se crea la relacion con la tabla de likes
    public function likes(){
        return $this->hasMany(Like::class); //RELACION 1 A MUCHOS
    }

    //almacena los seguidores de un usuario
    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id'); //RELACION MUCHOS A MUCHOS
    }

    //almacena los usuarios a los que sigue un usuario
    public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id'); //RELACION MUCHOS A MUCHOS
    }

    public function siguiendo(User $user){
        return $this->followers->contains($user->id); //comprobar si y asigue ese usuario
    }
}
