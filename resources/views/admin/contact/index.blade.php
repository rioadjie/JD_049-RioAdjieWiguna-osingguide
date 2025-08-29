@extends('layouts.master')
@section('main')
<main class="main-content position-relative border-radius-lg">
    @include('layouts.header')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Contact Us</h4>
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <hr class="bg-primary">
                        @if($contact)
                        <p><strong>No Telp:</strong> {{ $contact->no_telp }}</p>
                        <p><strong>Email:</strong> {{ $contact->email }}</p>
                        <p><strong>Address:</strong> {{ $contact->address }}</p>
                        <a href="{{ route('admin.contact.edit') }}" class="btn btn-primary mt-3">Edit</a>
                        @else
                        <p>No contact information available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</main>
@endsection
