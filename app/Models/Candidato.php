<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    // Indicamos los campos que pueden ser llenados masivamente (por ejemplo con seeders).
    protected $fillable = ["nombre", "f_nac", "partido", "descripcion"];

    // Relación de pertenencia n:1 a la tabla "partido" (Un candidato tiene un partido).
    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partido', 'abreviacion');
    }
}
