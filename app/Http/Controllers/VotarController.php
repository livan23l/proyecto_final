<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\UserVotacion;
use App\Models\Votacion;
use App\Models\VotacionCandidato;
use Illuminate\Http\Request;

class VotarController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->except("index");  // ->only() para aplicárselo solo a ciertos métodos. ->except() para no aplicárselo a ciertos metodos
    }

    public function index()
    {
        $votaciones = Votacion::orderBy('created_at', 'desc')->get();
        $votos_registrados = UserVotacion::all();
        return view("votar.votar_vista_index", compact("votaciones", "votos_registrados"));
    }

    public function show($id)
    {
        $votacion = Votacion::find($id);
        $voto_bool = UserVotacion::where(['user_id' => auth()->id(), 'votacion_id' => $id])->get();
        return view("votar.votar_vista_show", compact("votacion", "voto_bool"));
    }

    public function store(Request $request, $id)
    {
        $votacion = Votacion::find($id);

        $identificadores = $votacion->candidatos->pluck('id')->toArray();

        // Inicio de validaciones:
        $request->validate([
            'voto' => 'required|in:null,' . implode(',', $identificadores)
        ]);

        $userId = auth()->user()->id;

        $users_votaciones = UserVotacion::where(['user_id' => $userId, 'votacion_id' => $id]);

        if ($users_votaciones->exists()) {  // Si el usuario ya está en la base de datos (ya votó):
            session()->flash('voto_incorrect', 'Ya has votado, no puedes volver a votar.');
            return redirect()->route('votar.show', $id);
        }
        // Fin de las validaciones.

        // Modificaciones a la base de datos:
        $votacion->increment('votos');  // Incrementamos el total de los votos.

        // Registramos que el usuario voto en esta votación:
        UserVotacion::create(['user_id' => $userId, 'votacion_id' => $id]);

        // Verificar si fue un voto nulo o un voto a un candidato
        if ($request->input('voto') == 'null') {
            // Nulo:
            $votacion->increment('votos_null');
        } else {
            // Candidato:
            $candidatoId = $request->voto;
            VotacionCandidato::where(['votacion_id' => $id, 'candidato_id' => $candidatoId])->increment('votos');
        }
        // Fin de las modificaciones a la base de datos.


        session()->flash('voto_success', 'Tu voto se ha registrado correctamente.');

        return redirect()->route('votar.show', $id);
    }

    public function candidato_show($id)
    {
        $candidato = Candidato::find($id);
        return view("votar.votar_vista_candidato_show", compact("candidato"));
    }
}
