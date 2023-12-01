<?php

namespace App\Policies;

use App\Models\Noticia;
use App\Models\User;

class NoticiaPolicy
{
    public function autor(User $user, Noticia $noticia) {
        if($noticia->autor_id == $user->id) {
            return true;
        } else {
            return false;
        }
    }
}
