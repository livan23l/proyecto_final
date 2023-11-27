<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    // Relación de pertenencia 1:n a la tabla "partido" (Un partido tiene muchos candidatos).
    public function candidatos()
    {
        return $this->hasMany(Candidato::class, 'partido', 'abreviacion');
    }
}
