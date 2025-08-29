@extends('layouts.master')
@section('main')
    <main class="main-content position-relative border-radius-lg">
        @include('layouts.header')

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Manajemen Pemandu Wisata</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-4">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Level</th>
                                            <th>Tarif Harian</th>
                                            <th>Booking Selesai</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($guides as $guide)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $guide->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $guide->phone }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.guide.level', $guide->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('POST')
                                                        <select name="level" onchange="this.form.submit()" class="form-select form-select-sm"
                                                            style="font-size: 0.875rem; padding: 0.25rem 0.5rem;">
                                                            <option value="junior" {{ $guide->guideProfile?->level == 'junior' ? 'selected' : '' }}>
                                                                Junior
                                                            </option>
                                                            <option value="intermediate" {{ $guide->guideProfile?->level == 'intermediate' ? 'selected' : '' }}>
                                                                Intermediate
                                                            </option>
                                                            <option value="expert" {{ $guide->guideProfile?->level == 'expert' ? 'selected' : '' }}>
                                                                Expert
                                                            </option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <span class="text-xs">
                                                        <center> Rp
                                                            {{ number_format($guide->guideProfile->daily_rate ?? 0, 0, ',', '.') }}
                                                        </center>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-xs">
                                                        <center>{{ $guide->bookings_as_guide_count }}</center>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-gradient-{{ ($guide->guideProfile->status ?? 'inactive') === 'active' ? 'success' : 'secondary' }}">
                                                        {{ ucfirst($guide->guideProfile->status ?? 'inactive') }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.guide.detail', $guide->id) }}"
                                                            class="btn btn-sm btn-info me-2">Detail</a>

                                                        <form action="{{ route('admin.guide.toggle', $guide->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-sm
                                                        {{ ($guide->guideProfile->status ?? 'inactive') === 'active' ? 'btn-warning' : 'btn-success' }}
                                                    ">
                                                                {{ ($guide->guideProfile->status ?? 'inactive') === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    Belum ada pemandu terdaftar.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('layouts.footer')
        </div>
    </main>
@endsection
