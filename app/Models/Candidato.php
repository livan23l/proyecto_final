<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    protected $fillable = ["nombre", "f_nac", "partido", "descripcion"];

    public function partido()
    {
        return $this->belongsTo(Partido::class, 'partido', 'abreviacion');
    }
}
