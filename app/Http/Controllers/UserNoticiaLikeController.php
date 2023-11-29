<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Noticia;
use App\Models\UserNoticiaLike;
use Illuminate\Http\Request;

class UserNoticiaLikeController extends Controller
{
    public function toggleLike($noticiaId)
    {
        $noticia = Noticia::find($noticiaId);
        $user = auth()->user();

        $like = UserNoticiaLike::where('user_id', $user->id)
            ->where('noticia_id', $noticiaId)
            ->first();

        if ($like) {  // El usuario ya dio like, eliminamos el like
            $like->delete();
            $liked = false;
            $noticia->decrement('votos_tot');
        } else {  // El usuario no ha dado like, lo añadimos
            UserNoticiaLike::create([
                'user_id' => $user->id,
                'noticia_id' => $noticiaId,
            ]);
            $liked = true;
            $noticia->increment('votos_tot');
        }

        // Volvemos al index:
        $likes = UserNoticiaLike::all();
        $categorias = Categoria::all();
        $noticias = Noticia::orderBy('created_at', 'desc')->get();
        return view("noticia.noticia_vista_index", compact("noticias", "categorias", "likes"));
    }
}
