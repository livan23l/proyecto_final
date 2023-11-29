@props(['id', 'tipo', 'icono', 'mensaje'])

<div>
    <div id="{{ $id }}" class="alert alert-{{ $tipo }} alert-dismissible bg-{{ $tipo }} text-light pos-abs-crud border-0 fade show">
        <i class="bi {{ $icono }} me-1"></i>
        {{ $mensaje }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
