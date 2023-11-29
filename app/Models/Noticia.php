<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    // Indicamos los campos que pueden ser llenados masivamente (por ejemplo con seeders).
    protected $fillable = ["titulo", "origen", "zona", "contenido", "categ_select", "votos_tot"];

    use HasFactory;

    // Configuramos la relacion n:m con la tabla "categorias" en la tabla pivote "noticias_categorias":
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'noticias_categorias')->withTimestamps(); // Le decimos que tenemos columnos timestamps en "noticias_categorias".
    }
}
