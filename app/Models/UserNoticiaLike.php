<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNoticiaLike extends Model
{
    use HasFactory;

    protected $table = 'users_noticias_likes';

    protected $fillable = ['user_id', 'noticia_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function noticia()
    {
        return $this->belongsTo(Noticia::class);
    }

    public function user_like_bool($noticia)
    {
        dd($noticia);
    }
}
