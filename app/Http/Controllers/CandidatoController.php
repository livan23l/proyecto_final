<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$candidatos = Candidato::all();
        $candidatos = Candidato::select('id', 'nombre', 'f_nac', 'partido', 'descripcion')->get();
        return view("candidato.candidato_vista_index", compact('candidatos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("candidato.candidato_vista_create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'candidato_nombre' => 'required|string|max:255',
            'candidato_f_nac' => 'required|date',
            'candidato_partido' => 'required|string|max:255',
            'candidato_descripcion' => 'required|string'
        ]);
    
        $contacto = new Candidato();
        $contacto->nombre = $request->candidato_nombre;
        $contacto->f_nac = $request->candidato_f_nac;
        $contacto->partido = $request->candidato_partido;
        $contacto->descripcion = $request->candidato_descripcion;
        $contacto->save();
        
        return redirect()->route("candidato.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidato $candidato)
    {
        return view("candidato.candidato_vista_show", compact('candidato'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidato $candidato)
    {
        return view("candidato.candidato_vista_edit", compact('candidato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidato $candidato)
    {
        $request->validate([
            'candidato_nombre' => 'required|string|max:255',
            'candidato_f_nac' => 'required|date',
            'candidato_partido' => 'required|string|max:255',
            'candidato_descripcion' => 'required|string'
        ]);
    
        $candidato->nombre = $request->candidato_nombre;
        $candidato->f_nac = $request->candidato_f_nac;
        $candidato->partido = $request->candidato_partido;
        $candidato->descripcion = $request->candidato_descripcion;
        $candidato->save();
        
        return redirect()->route("candidato.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidato $candidato)
    {
        $candidato->delete();
        return redirect()->route("candidato.index");
    }
}
