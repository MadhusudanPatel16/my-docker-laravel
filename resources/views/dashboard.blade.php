<x-app-layout>
    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Header --}}
    <div class="bg-light border-bottom shadow-sm py-3 mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h2 class="h4 fw-bold mb-0 text-primary">{{ __('Dashboard') }}</h2>
            <span class="text-muted small">Welcome, {{ Auth::user()->name ?? 'User' }}</span>
        </div>
    </div>

    {{-- Content --}}
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5 text-center">
                        <h5 class="card-title text-success fw-bold mb-3">🎉 {{ __("You're logged in!") }}</h5>
                        <p class="text-muted mb-4">You have successfully accessed your dashboard.</p>

                        <a href="{{ url('/') }}" class="btn btn-primary px-4">Go to Homepage</a>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                           class="btn btn-outline-danger px-4 ms-2">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
