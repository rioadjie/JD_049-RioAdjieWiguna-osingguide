@extends('layouts.master')
@section('main')
<main class="main-content position-relative border-radius-lg">
    @include('layouts.header')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Form Add Places</h5>
                        <hr class="bg-primary">
                        <form action="{{ route('admin.places.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label>Name of Place</label>
                                    <input type="text" name="name_place" class="form-control">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label>Image <i
                                        class="bi bi-file-image text-danger" title="Photo Maksimum 2 MB">(Maks. 2 MB)</i></label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label>Location</label>
                                    <input type="text" name="location" class="form-control">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label>Rating (1-5)</label>
                                    <input type="number" name="rating" class="form-control" min="1" max="5">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Content</label>
                                <textarea name="content" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Description (SEO)</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Keywords (SEO)</label>
                                <textarea name="keywords" class="form-control"></textarea>
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
