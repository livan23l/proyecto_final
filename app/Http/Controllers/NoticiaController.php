<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Models\Categoria;
use App\Models\Estado;
use App\Models\Noticia;
use App\Models\NoticiaCategoria;
use App\Models\Peticion;
use App\Models\UserNoticiaLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $this->authorize('periodista');
        $noticias = Noticia::where('autor_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view("noticia.noticia_vista_index", compact("noticias"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('periodista');
        $categorias = Categoria::all();
        $estados = Estado::all();
        return view("noticia.noticia_vista_create", compact("estados", "categorias"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('periodista');
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

        if (isset(auth()->user()->name)) {
            $autor = auth()->user()->name;
        } else {
            $autor = "Anónimo";
        }

        // Guardamos la votación:
        $noticia = new Noticia([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'autor' => $autor,
            'autor_id' => auth()->user()->id,
            'origen' => $request->origen,
            'zona' => ($request->origen == "Federal") ? "México" : $request->zona,
            'categ_select' => $request->categ_select,
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
        $this->authorize('periodista');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Noticia $noticia)
    {
        $this->authorize('periodista');
        $this->authorize('autor', $noticia);
        $categorias = Categoria::all();
        $estados = Estado::all();
        return view("noticia.noticia_vista_edit", compact("noticia", "estados", "categorias"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Noticia $noticia)
    {
        $this->authorize('periodista');
        $this->authorize('autor', $noticia);
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
        $this->authorize('periodista');
        $this->authorize('autor', $noticia);
        // Desvincular (borrar) registros en categorias antes de la eliminación de la noticia:
        $noticia->categorias()->detach();

        // Eliminación la noticia:
        $noticia->delete();

        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('noticia', [true, 'La noticia ha sido eliminada exitosamente.']);

        return redirect()->route("noticia.index");
    }

    public function ver()
    {
        // Obtener todas las noticias
        $noticias = Noticia::orderBy('created_at', 'desc')->get();

        $noticiasRelevantes = [];

        foreach ($noticias as $noticia) {
            $noticiasRelevantes[] = [
                'noticia' => $noticia,
                'puntaje' => 0,
            ];
        }

        $compilador = [];
        // Primera parte (El mismo estado que el usuario):

        for ($i = 0; $i < (count($noticiasRelevantes)); $i++) {
            $compilador[$i] = 0;
        }

        $i = 0;

        foreach ($noticiasRelevantes as $noticia) {
            if ($noticia["noticia"]->zona == auth()->user()->state) {
                $compilador[$i] += 8;
            } elseif ($noticia["noticia"]->zona == "México") {
                $compilador[$i] += 4;
            } else {
                $compilador[$i] -= 1;
            }
            $i++;
        }

        for ($i = 0; $i < (count($noticiasRelevantes)); $i++) {
            $noticiasRelevantes[$i]["puntaje"] = $compilador[$i];
        }


        // Segunda parte (Contenido menor a 30 caracteres):

        for ($i = 0; $i < (count($noticiasRelevantes)); $i++) {
            $compilador[$i] = 0;
        }
        $i = 0;


        foreach ($noticiasRelevantes as $noticia) {
            if (strlen($noticia["noticia"]->contenido) < 30) {
                $compilador[$i] -= 3;
            } else {
                $compilador[$i] += 3;
            }
            $i++;
        }

        for ($i = 0; $i < (count($noticiasRelevantes)); $i++) {
            $noticiasRelevantes[$i]["puntaje"] += $compilador[$i];
        }



        // Tercera parte (Valoración de categorías):

        $categorias_good = ["Tecnologia", "Ciencia", "Politica"];  // Categorías sobrevaloradas
        $categorias_bad = ["Arte", "Viajes", "Comercio"];  // Categorías infravaloradas

        for ($i = 0; $i < (count($noticiasRelevantes)); $i++) {
            $compilador[$i] = 0;
        }

        $i = 0;

        foreach ($noticiasRelevantes as $noticia) {
            foreach ($noticia["noticia"]->categorias as $categoria) {
                if (in_array($categoria->nombre, $categorias_good)) {
                    $compilador[$i] += 4;
                } elseif (in_array($categoria->nombre, $categorias_bad)) {
                    $compilador[$i] -= 4;
                } else {
                    $compilador[$i] += 1;
                }
            }
            $i++;
        }

        for ($i = 0; $i < (count($noticiasRelevantes)); $i++) {
            $noticiasRelevantes[$i]["puntaje"] += $compilador[$i];
        }


        usort($noticiasRelevantes, function ($a, $b) {
            return $b['puntaje'] - $a['puntaje'];
        });

        // dd($noticiasRelevantes);

        $categorias = Categoria::all();
        $likes = UserNoticiaLike::all();
        // Pasar los datos a la vista
        return view("noticia.noticia_vista_ver", compact("noticiasRelevantes", "categorias", "likes"));
    }

    public function periodista()
    {
        $this->authorize('ciudadano');
        $peticion = Peticion::where("user_id", auth()->user()->id)->get();
        return view("noticia.noticia_vista_periodista", compact("peticion"));
    }

    public function periodista_store(Request $request)
    {
        $this->authorize('ciudadano');

        $request->validate([
            'motivo' => 'required|string|min:20|max:255',
            'identificacion' => 'required|mimes:pdf',
        ]);

        $peticiones = Peticion::where("user_id", auth()->user()->id)->get();
        if (!$peticiones->isEmpty()) {  // Si el usuario ya mandó la petición.
            session()->flash('peticion', [false, 'Ya has aplicado para ser periodista']);
            return redirect(route("noticia.periodista"));
        }

        // Almacenar el archivo en el servidor
        $archivoRuta = $request->file('identificacion')->store('archivos_peticiones', 'public');

        // Guardamos la petición:
        $peticion = new Peticion([
            'user_id' => auth()->user()->id,
            'motivo' => $request->motivo,
            'identificacion' => $archivoRuta,
        ]);

        $peticion->save();

        session()->flash('peticion', [true, 'La petición fue enviada correctamente.']);

        return redirect(route("noticia.periodista"));
    }

    public function periodista_destroy(Peticion $peticion)
    {
        // Obtener la ruta del archivo
        $archivoRuta = $peticion->identificacion;

        // Eliminamos la petición
        $peticion->delete();

        // Eliminamos también el archivo asociado
        if ($archivoRuta) {
            Storage::delete('public/' . $archivoRuta);
        }

        // Almacenar mensaje de éxito en la sesión flash:
        session()->flash('peticion', [true, 'La petición ha sido eliminada exitosamente.']);

        return redirect()->route("noticia.periodista");
    }
}
