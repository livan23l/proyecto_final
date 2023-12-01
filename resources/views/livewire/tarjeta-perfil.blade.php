<div>
    <div class="card">
        <div class="card-body profile-card pt-4">
            <div class="d-flex flex-column align-items-center">
                @if ($photo) <!-- Con imagen -->
                    <img class="h-8 w-8 rounded-circle object-cover" src="/storage/{{$photo }}" alt="{{ $name }}" title="{{ $name }}" />
                @else <!-- Sin imagen -->
                    <img class="h-8 w-8 rounded-circle object-cover" src="{{ $photo_url }}" alt="{{ $name }}" title="{{ $name }}" />
                @endif
                <h2 class="text-center">{{ $name }}</h2>
                <h3 class="pt-2 pb-0 mb-0">{{ $role }}</h3>
            </div>
            <hr class="mt-3 mb-3" />
            <div class="text-center mb-3">
                <i class="bi bi-envelope-fill me-2"></i>
                <span class="text-decoration-none text-primary">{{ $email }}</span>
            </div>
        </div>
    </div>
</div>
