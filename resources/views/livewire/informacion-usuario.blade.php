<div>
    <h5 class="card-title">Acerca de mí</h5> <!-- Acerca de mí -->
    <p class="small fst-italic">
        {{ $description }}
    </p>

    <h5 class="card-title">Detalles del perfil</h5>

    <div class="row"> <!-- Nombre -->
        <div class="col-lg-3 col-md-4 label">Nombre</div>
        <div class="col-lg-9 col-md-8">{{ $name }}</div>
    </div>

    <div class="row"> <!-- Estado -->
        <div class="col-lg-3 col-md-4 label">Estado</div>
        <div class="col-lg-9 col-md-8">{{ $state }}</div>
    </div>

    <div class="row"> <!-- Correo -->
        <div class="col-lg-3 col-md-4 label ">Correo</div>
        <div class="col-lg-9 col-md-8">{{ $email }}</div>
    </div>

    <div class="row"> <!-- Rol -->
        <div class="col-lg-3 col-md-4 label ">Rol</div>
        <div class="col-lg-9 col-md-8">{{ $role }}</div>
    </div>

    <div class="row"> <!-- Creación -->
        <div class="col-lg-3 col-md-4 label">Creación</div>
        <div class="col-lg-9 col-md-8">{{ $created_at->format('d/m/Y') }}</div>
    </div>
</div>
