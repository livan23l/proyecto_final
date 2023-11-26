<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotacionCandidato extends Model
{
    use HasFactory;

    // Ponemos 'votaciones_candidatos' como el nombre en plural de la tabla:
    protected $table = 'votaciones_candidatos';
}
