@extends('layouts.master')
@section('main')
<main class="main-content position-relative border-radius-lg">
    @include('layouts.header')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fw-bold">Management Place to Visits</h4>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.places.create') }}">
                                    <button class="btn btn-primary text-white fw-bold"><i
                                            class="ni ni-fat-add me-2"></i>Add Place</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive p-4">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Name Place</th>
                                        <th>Location</th>
                                        <th>Content</th>
                                        <th>Rating</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($places as $index => $place)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/'.$place->image) }}" width="100">
                                        </td>
                                        <td>
                                            <p class="text-sm">{{ $place->name_place ?? '-' }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">{{ $place->location }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">{{ Str::limit(strip_tags($place->content), 25, '...') }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm">{{ $place->rating }} / 5 <i class="bi bi-star me-2"></i>
                                            </p>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#placeDetailModal{{ $place->id }}">
                                                Detail
                                            </button>
                                            <a href="{{ route('admin.places.edit', $place->id ) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.places.destroy', $place->id ) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Yakin hapus?')"
                                                    class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            Nothing Place Destination Added.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @forelse ($places as $place)
                            <div class="modal fade" id="placeDetailModal{{ $place->id }}" tabindex="-1"
                                aria-labelledby="placeDetailLabel{{ $place->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="placeDetailLabel{{ $place->id }}">
                                                {{ $place->name_place }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if($place->image)
                                            <img src="{{ asset('storage/'.$place->image) }}" class="img-fluid mb-3"
                                                alt="{{ $place->name_place }}">
                                            @endif
                                            <div>
                                                <p><strong>Content:</strong></p>
                                                <p>{!! $place->content !!}</p>
                                            </div>
                                            <hr class="bg-primary">
                                            <p><strong>Rating:</strong> {{ $place->rating }} / 5 <i
                                                    class="bi bi-star me-2"></i></p>
                                            <p><strong>Location:</strong> {{ $place->location }}</p>
                                            <p><strong>Description:</strong> {{ $place->description }}</p>
                                            <p><strong>Keywords:</strong> {{ $place->keywords }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-center text-muted"></p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</main>
@endsection
