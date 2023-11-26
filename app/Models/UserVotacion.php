<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVotacion extends Model
{
    use HasFactory;

    // Indicamos los campos que pueden ser llenados masivamente (por ejemplo con seeders).
    protected $fillable = ["user_id", "votacion_id"];

    // Ponemos 'users_votaciones' como el nombre en plural de la tabla:
    protected $table = 'users_votaciones';
}
