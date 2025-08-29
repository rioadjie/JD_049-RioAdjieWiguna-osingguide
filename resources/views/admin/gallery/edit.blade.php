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
                        <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label>Image</label><br>
                                <input type="file" name="image" class="form-control">
                                <img src="{{ asset('storage/' . $gallery->image) }}" width="150" class="mt-2">
                            </div>
                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control">{{ $gallery->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Kembali</a>
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
