@extends('layouts.master')
@section('main')
<main class="main-content position-relative border-radius-lg">
    @include('layouts.header')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>About Us</h4>
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <hr class="bg-primary">
                        <div class="mb-3">
                            <label>Logo:</label><br>
                            <img src="{{ asset('storage/' . $about->logo) }}" alt="Logo" width="500">
                        </div>
                        <div class="mb-3">
                            <label>Description:</label>
                            <p class="mt-2">{{ $about->description }}</p>
                        </div>
                        <a href="{{ route('admin.about.edit') }}" class="btn btn-primary mt-3">Edit</a>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</main>
@endsection
