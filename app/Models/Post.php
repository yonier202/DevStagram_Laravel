<?php

namespace App\Models;

use App\Http\Controllers\LikeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'titulo', 'descripcion', 'imagen'];

    public function user(){
        return $this->belongsTo(User::class); //RELACION INVERSA 1 A MUCHOS
    }
    public function comentarios(){
        return $this->hasMany(Comentario::class); //RELACION 1 A MUCHOS
    }
    public function likes(){
        return $this->hasMany(Like::class); //RELACION muchos a muchos
    }

    public function checkLike(User $user){
        return $this->likes->contains('user_id', $user->id); //RETORNA SI EL USUARIO YA DIO LIKE A LA PUBLICACIÓN
    }

}
