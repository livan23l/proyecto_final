<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    // Indicamos los campos que pueden ser llenados masivamente (por ejemplo con seeders).
    protected $fillable = ["titulo", "alcance", "zona", "contenido"];

    use HasFactory;
}
