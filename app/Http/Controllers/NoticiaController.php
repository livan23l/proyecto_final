<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
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
        $noticias = Noticia::orderBy('created_at', 'desc')->get();
        return view("noticia.noticia_vista_index", compact("noticias"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estados = Estado::all();
        return view("noticia.noticia_vista_create", compact("estados"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->contenido);
        $estados = Estado::pluck('nombre')->toArray();  // Convertimos los nombres a un arreglo.

        $request->validate([
            "titulo" => "required|max:255|min:5",
            "alcance" => "required|in:Federal,Estatal",
            'zona' => 'required|in:' . implode(',', $estados),  // Convertimos el array en un string separado por comas,
            "contenido" => "required|min:10",
        ]);

        // Guardamos la votación:
        $noticia = new Noticia([
            'titulo' => $request->titulo,
            'alcance' => $request->alcance,
            'zona' => ($request->alcance == "Federal") ? "México" : $request->zona,
            'contenido' => $request->contenido,
        ]);

        $noticia->save();


        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('noticia', [true, 'La noticia ha sido creada exitosamente.']);

        return redirect()->route("noticia.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Noticia $noticia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Noticia $noticia)
    {
        $estados = Estado::all();
        return view("noticia.noticia_vista_edit", compact("noticia", "estados"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Noticia $noticia)
    {
        // dd($request->contenido);
        $estados = Estado::pluck('nombre')->toArray();  // Convertimos los nombres a un arreglo.

        $request->validate([
            "titulo" => "required|max:255|min:5",
            "alcance" => "required|in:Federal,Estatal",
            'zona' => 'required|in:' . implode(',', $estados),  // Convertimos el array en un string separado por comas,
            "contenido" => "required|min:10",
        ]);

        // Guardamos la votación:
        $noticia->update([
            'titulo' => $request->titulo,
            'alcance' => $request->alcance,
            'zona' => ($request->alcance == "Federal") ? "México" : $request->zona,
            'contenido' => $request->contenido,
        ]);

        $noticia->save();


        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('noticia', [true, 'La noticia ha sido modificada exitosamente.']);

        return redirect()->route("noticia.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noticia $noticia)
    {
        //
    }
}
