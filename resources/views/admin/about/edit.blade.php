@extends('layouts.master')
@section('main')
<main class="main-content position-relative border-radius-lg">
    @include('layouts.header')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Form Update About Us</h5>
                        <hr class="bg-primary">
                        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label>Logo</label><br>
                                <input type="file" name="logo" class="form-control">
                                <img src="{{ asset('storage/' . $about->logo) }}" width="100" class="mt-2">
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" rows="5"
                                    class="form-control">{{ $about->description }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Simpan</button>
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
