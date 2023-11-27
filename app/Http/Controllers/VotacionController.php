<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Estado;
use App\Models\Votacion;
use Illuminate\Http\Request;

class VotacionController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");  // ->only() para aplicárselo solo a ciertos métodos. ->except() para no aplicárselo a ciertos metodos
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $votaciones = Votacion::orderBy('created_at', 'desc')->get();
        return view("votacion.votacion_vista_index", compact("votaciones"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $candidatos = Candidato::orderBy('created_at', 'desc')->get();
        $estados = Estado::all();
        return view("votacion.votacion_vista_create", compact("candidatos", "estados"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $estados = Estado::pluck('nombre')->toArray();  // Convertimos los nombres a un arreglo.

        $request->validate([
            'nombre' => 'required|string|max:255|min:5',
            'tipo' => 'required|in:Presidencial,Diputación,Senaduría',
            'alcance' => 'required|in:Federal,Estatal',
            'zona' => 'required|in:' . implode(',', $estados),  // Convertimos el array en un string separado por comas
            'candidatos' => 'required|array|min:2', // Al menos dos candidatos.
            'candidatos.*' => 'exists:candidatos,id', // Todos los candidatos deben existir en la tabla 'candidatos'.
            'descripcion' => 'required|string|min:5'
        ]);


        // Guardamos la votación:
        $votacion = new Votacion([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'alcance' => $request->alcance,
            'zona' => ($request->alcance == "Federal") ? "México" : $request->zona,
            'descripcion' => $request->descripcion,
        ]);

        $votacion->save();

        // Guardamos los datos en la tabla pivote:
        $votacion->candidatos()->attach($request->candidatos);

        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('create_votacion', 'La votación ha sido creada exitosamente.');

        return redirect()->route("votacion.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Votacion $votacion)
    {
        return view("votacion.votacion_vista_show", compact("votacion"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Votacion $votacion)
    {
        $candidatos = Candidato::orderBy('created_at', 'desc')->get();
        $estados = Estado::all();
        return view("votacion.votacion_vista_edit", compact("votacion", "candidatos", "estados"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Votacion $votacion)
    {
        //dd($request);
        $estados = Estado::pluck('nombre')->toArray();  // Convertimos los nombres a un arreglo.

        $request->validate([
            'nombre' => 'required|string|max:255|min:5',
            'tipo' => 'required|in:Presidencial,Diputación,Senaduría',
            'alcance' => 'required|in:Federal,Estatal',
            'zona' => 'required|in:' . implode(',', $estados),  // Convertimos el array en un string separado por comas
            'candidatos' => 'required|array|min:2', // Al menos dos candidatos.
            'candidatos.*' => 'exists:candidatos,id', // Todos los candidatos deben existir en la tabla 'candidatos'.
            'descripcion' => 'required|string|min:5'
        ]);

        // Actualizamos la votación:
        $votacion->update([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'alcance' => $request->alcance,
            'zona' => ($request->alcance == "Federal") ? "México" : $request->zona,
            'descripcion' => $request->descripcion,
        ]);

        $votacion->candidatos()->sync($request->candidatos);

        Votacion::where('id', $votacion->id)->update(["votos" => $votacion->contarVotos($votacion->id)]);

        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('edit_votacion', 'La votación ha sido modificada exitosamente.');

        return redirect()->route("votacion.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Votacion $votacion)
    {
        // Desvincular (borrar) registros en users_votes antes de la eliminación de la votación:
        $votacion->userVotacion()->detach();

        // Desvincular (borrar) candidatos antes de la eliminación de la votación:
        $votacion->candidatos()->detach();

        // Eliminación la votación:
        $votacion->delete();

        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('destroy_votacion', 'La votación ha sido eliminada exitosamente.');

        return redirect()->route("votacion.index");
    }
}
