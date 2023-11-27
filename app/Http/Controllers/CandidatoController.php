<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use App\Models\Partido;
use App\Models\VotacionCandidato;
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
        $candidatos = Candidato::select('id', 'nombre', 'f_nac', 'partido', 'descripcion')->orderBy('created_at', 'desc')->get();
        return view("candidato.candidato_vista_index", compact('candidatos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partidos = Partido::all();
        return view("candidato.candidato_vista_create", compact('partidos'));
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
            'descripcion' => 'required|string|min:5'
        ]);

        Candidato::create($request->all());

        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('candidato', ['create', true, 'El candidato ha sido creado exitosamente.']);

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
        $partidos = Partido::all();
        return view("candidato.candidato_vista_edit", compact('candidato', 'partidos'));
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
            'descripcion' => 'required|string|min:5'
        ]);

        Candidato::where('id', $candidato->id)->update($request->except('_token', '_method'));

        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('candidato', ['edit', true, 'El candidato ha sido modificado exitosamente.']);

        return redirect()->route("candidato.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidato $candidato)
    {
        // Obtener las votaciones en las que participa el candidato.
        $votaciones = $candidato->votacion;
        
        // Verificar si el candidato participa en alguna votación antes de intentar restar votos
        if ($votaciones && $votaciones->isNotEmpty()) {

            // Iterar sobre cada votación y restar los votos del candidato
            foreach ($votaciones as $votacion) {
                $votos_candidato = VotacionCandidato::where(['votacion_id' => $votacion->id, 'candidato_id' => $candidato->id])->pluck('votos')->first();
                if($votos_candidato != null) {
                    $votacion->decrement('votos', $votos_candidato);
                }
            }

            // Desvincular al candidato de todas las votaciones
            $candidato->votacion()->detach();
        }

        $candidato->delete();

        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('candidato', ['destroy', true, 'El candidato ha sido eliminado exitosamente.']);

        return redirect()->route("candidato.index");
    }
}
