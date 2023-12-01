<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Noticia;
use App\Policies\NoticiaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Noticia::class => NoticiaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('periodista', function ($user) {
            return $user->role == "Periodista";
        });

        Gate::define('administrador', function ($user) {
            return $user->role == "Administrador";
        });

        Gate::define('ciudadano', function ($user) {
            return $user->role == "Ciudadano";
        });

        Gate::after(function ($result) {
            if (!$result) {
                return response('No autorizado', 403);
            }
        });
    }
}
