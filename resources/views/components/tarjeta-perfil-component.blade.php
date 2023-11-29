<div>
    <div class="card">
        <div class="card-body profile-card pt-4">
            <div class="d-flex flex-column align-items-center">
                @if (Auth::user()->profile_photo_path)
                    <img class="h-8 w-8 rounded-circle object-cover" src="/storage/{{ Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->name }}" />
                @else
                    <img class="h-8 w-8 rounded-circle object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                @endif
                <h2 class="text-center">{{ auth()->user()->name }}</h2>
                <h3 class="pt-2 pb-0 mb-0">{{ auth()->user()->role }}</h3>
            </div>
            <hr class="mt-3 mb-3" />
            <div class="text-center mb-3">
                <i class="bi bi-envelope-fill me-2"></i>
                <span class="text-decoration-none text-primary">{{ auth()->user()->email }}</span>
            </div>
        </div>
    </div>
</div>
