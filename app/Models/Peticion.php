<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'motivo',
        'identificacion',
    ];

    protected $table = 'peticiones';
}
