<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Models\Categoria;
use App\Models\Estado;
use App\Models\Noticia;
use App\Models\NoticiaCategoria;
use App\Models\UserNoticiaLike;
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
        // Obtener todas las noticias
        $noticias = Noticia::orderBy('created_at', 'desc')->get();

        // Obtener las categorías y likes para la vista
        $categorias = Categoria::all();
        $likes = UserNoticiaLike::all();

        // Ponderación para el estado (ejemplo: si es igual, valor 5; si no, valor 1)
        $estadoUsuario = auth()->user()->estado;

        function validar_estado($estado)
        {
            if ($estado == auth()->user()->estado) {
                return 5;
            } elseif ($estado == "Baja California") {
                return -10;
            } else {
                return -2;
            }
        }

        function validar_categoria($categoria)
        {
            if ($categoria == 'Ciencia' || $categoria == 'Tecnologia') {
                return 5;
            } else {
                return -2;
            }
        }


        $noticiasRelevantes = [];
        foreach ($noticias as $noticia) {
            // Añadimos un nuevo elemento al array por cada noticia
            $noticiasRelevantes[] = [
                'noticia' => $noticia,
                'puntuacion' => 0,
            ];

            // Actualizamos la puntuación de la noticia actual
            $noticiasRelevantes[count($noticiasRelevantes) - 1]['puntuacion'] += validar_estado($noticia->estado);
            $noticiasRelevantes[count($noticiasRelevantes) - 1]['puntuacion'] += validar_categoria($noticia->categoria);
        }



        $noticiasRelevantes = array_values($noticiasRelevantes);

        // Ordenamos el array por 'puntuacion' de mayor a menor
        arsort($noticiasRelevantes);

        // Pasar los datos a la vista
        return view("noticia.noticia_vista_index", compact("noticiasRelevantes", "categorias", "likes"));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $estados = Estado::all();
        return view("noticia.noticia_vista_create", compact("estados", "categorias"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->categ_select);
        $estados = Estado::pluck('nombre')->toArray();  // Convertimos los nombres a un arreglo.

        $request->validate([
            'categ_select' => 'required|string',
            'categorias' => 'required|array|min:1|max:5', // Entre 1 y 5 categorías.
            'categorias.*' => 'exists:categorias,id',  // Validamos los id (que existan).
            "titulo" => "required|max:255|min:2",
            "origen" => "required|in:Federal,Estatal",
            'zona' => 'required|in:' . implode(',', $estados),  // Convertimos el array en un string separado por comas,
            "contenido" => "required|min:10",
        ]);

        // Guardamos la votación:
        $noticia = new Noticia([
            'categ_select' => $request->categ_select,
            'titulo' => $request->titulo,
            'origen' => $request->origen,
            'zona' => ($request->origen == "Federal") ? "México" : $request->zona,
            'contenido' => $request->contenido,
        ]);

        $noticia->save();

        $noticia->categorias()->attach($request->categorias);

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
        $categorias = Categoria::all();
        $estados = Estado::all();
        return view("noticia.noticia_vista_edit", compact("noticia", "estados", "categorias"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Noticia $noticia)
    {
        // dd($request->categ_select);
        $estados = Estado::pluck('nombre')->toArray();  // Convertimos los nombres a un arreglo.

        $request->validate([
            'categ_select' => 'required|string',
            'categorias' => 'required|array|min:1|max:5', // Entre 1 y 5 categorías.
            'categorias.*' => 'exists:categorias,id',  // Validamos los id (que existan).
            "titulo" => "required|max:255|min:2",
            "origen" => "required|in:Federal,Estatal",
            'zona' => 'required|in:' . implode(',', $estados),  // Convertimos el array en un string separado por comas,
            "contenido" => "required|min:10",
        ]);

        // Guardamos la votación:
        $noticia->update([
            'categ_select' => $request->categ_select,
            'titulo' => $request->titulo,
            'origen' => $request->origen,
            'zona' => ($request->origen == "Federal") ? "México" : $request->zona,
            'contenido' => $request->contenido,
        ]);

        $noticia->categorias()->sync($request->categorias);

        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('noticia', [true, 'La noticia ha sido modificada exitosamente.']);

        return redirect()->route("noticia.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noticia $noticia)
    {
        // Desvincular (borrar) registros en categorias antes de la eliminación de la noticia:
        $noticia->categorias()->detach();

        // Eliminación la noticia:
        $noticia->delete();

        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('noticia', [true, 'La noticia ha sido eliminada exitosamente.']);

        return redirect()->route("noticia.index");
    }
}
