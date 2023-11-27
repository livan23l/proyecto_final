<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votacion extends Model
{
    use HasFactory;

    // Indicamos los campos que pueden ser llenados masivamente (por ejemplo con seeders).
    protected $fillable = ["nombre", "tipo", "alcance", "zona", "descripcion"];

    // Ponemos 'votaciones' como el nombre de la tabla (ya que laravel dice que se llama 'votacions'):
    protected $table = 'votaciones';

    // Configuramos la relacion n:m con la tabla "candidatos" en la tabla pivote "votaciones_candidatos".
    public function candidatos()
    {
        return $this->belongsToMany(Candidato::class, 'votaciones_candidatos')
            ->withPivot('votos')->withTimestamps();
        // Especificamos el campo adicional a recuperar de la tabla pivote.
    }

    // Configuramos la relacion n:m con la tabla "users" en la tabla pivote "users_votaciones":
    public function userVotacion()
    {
        return $this->belongsToMany(UserVotacion::class, 'users_votaciones')
            ->withTimestamps(); // Le decimos que tenemos columnos timestamps en "users_votaciones".
    }

    // Función que cuenta el total de votos.
    public function contarVotos($votacionId)
    {
        $totalVotos = 0;
        
        // Variable con la votación:
        $votacion = Votacion::find($votacionId);

        // Sumar los votos de cada candidato
        foreach ($votacion->candidatos as $candidato) {
            $totalVotos += $candidato->pivot->votos;
        }

        $totalVotos += $votacion->votos_null;

        return $totalVotos;  // Regresamos la suma de votos
    }
}
