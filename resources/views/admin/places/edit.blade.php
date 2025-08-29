@extends('layouts.master')
@section('main')
<main class="main-content position-relative border-radius-lg">
    @include('layouts.header')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Form Update Places</h5>
                        <hr class="bg-primary">
                        <form action="{{ route('admin.places.update', $place->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input class="form-control" name="id" type="number" value="{{ $place->id }}" hidden>
                            <div class="mb-3">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                                <p>Photos: <img src="{{ asset('storage/'.$place->image) }}" width="100" class="mt-3"></p>
                            </div>
                            <div class="mb-3">
                                <label>Name of Place</label>
                                <input type="text" name="name_place" class="form-control" value="{{ old('name_place', $place->name_place) }}">
                            </div>
                            <div class="mb-3">
                                <label>Location</label>
                                <input type="text" name="location" class="form-control" value="{{ old('location', $place->location) }}">
                            </div>
                            <div class="mb-3">
                                <label>Content</label>
                                <textarea name="content" class="form-control">{{ old('content', $place->content) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Rating</label>
                                <input type="number" min="1" max="5" name="rating" class="form-control" value="{{ old('rating', $place->rating) }}">
                            </div>
                            <div class="mb-3">
                                <label>Description (SEO)</label>
                                <textarea name="description" class="form-control">{{ old('description', $place->description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Keywords (SEO)</label>
                                <textarea name="keywords" class="form-control">{{ old('keywords', $place->keywords) }}</textarea>
                            </div>
                            <button class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</main>
@endsection
@section('breadcrumb', 'Pesan Pemandu')
