@extends('layouts.app') {{-- your app layout with @yield('content') --}}

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5 text-center">
                    <h5 class="card-title text-success fw-bold mb-3">🎉 {{ __("You're logged in!") }}</h5>
                    <p class="text-muted mb-4">You have successfully accessed your dashboard.</p>

                    <a href="{{ url('/') }}" class="btn btn-primary px-4">Go to Homepage</a>
                    <a href="{{ route('books.list') }}" class="btn btn-outline-primary px-4 ms-2">Books</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
