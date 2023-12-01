<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilUsuarioController extends Controller
{
    public function configuration($id) {
        return view("profile.configuration", compact("id"));
    }
}
