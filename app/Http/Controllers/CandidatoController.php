<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;

class CandidatoController extends Controller
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
        //dd($request);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'f_nac' => 'required|date|before_or_equal:-18 years',
            'partido' => 'required|string|in:MC,MORENA,PAN,PRD,PRI,PT,PVEM',
            'descripcion' => 'required|string'
        ]);

        // $contacto = new Candidato();
        // $contacto->nombre = $request->nombre;
        // $contacto->f_nac = $request->f_nac;
        // $contacto->partido = $request->partido;
        // $contacto->descripcion = $request->descripcion;
        // $contacto->save();

        Candidato::create($request->all());

        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('create_candidato', 'El candidato ha sido creado exitosamente.');

        return redirect()->route("candidato.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidato $candidato)
    {
        // Mapeo de valores
        $partidos = [
            'MC' => 'Movimiento Ciudadano',
            'MORENA' => 'Movimiento de Regeneración Nacional',
            'PAN' => 'Partido Acción Nacional',
            'PRD' => 'Partido Revolucionario Democrático',
            'PRI' => 'Partido Revolucionario Institucional',
            'PT' => 'Partido del Trabajo',
            'PVEM' => 'Partido Verde Ecologista de México',
        ];

        // Transformar el valor del partido
        $candidato->partido = $partidos[$candidato->partido];
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
        //dd($request);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'f_nac' => 'required|date|before_or_equal:-18 years',
            'partido' => 'required|string|in:MC,MORENA,PAN,PRD,PRI,PT,PVEM',
            'descripcion' => 'required|string'
        ]);

        // $candidato->nombre = $request->nombre;
        // $candidato->f_nac = $request->f_nac;
        // $candidato->partido = $request->partido;
        // $candidato->descripcion = $request->descripcion;
        // $candidato->save();


        Candidato::where('id', $candidato->id)->update($request->except('_token', '_method'));

        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('edit_candidato', 'El candidato ha sido modificado exitosamente.');

        return redirect()->route("candidato.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidato $candidato)
    {
        $candidato->delete();

        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('destroy_candidato', 'El candidato ha sido eliminado exitosamente.');

        return redirect()->route("candidato.index");
    }
}
