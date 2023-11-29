<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticiaCategoria extends Model
{
    protected $fillable = [
        'noticia_id',
        'categoria_id',
        'created_at',
        'updated_at',
    ];

    use HasFactory;

    protected $table = 'noticias_categorias';
}
