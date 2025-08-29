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
                            <h6>Manajemen Booking</h6>
                            <a href="#" class="btn btn-sm btn-primary">Export Data</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-4">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Booking ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Guide</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Durasi</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Orang</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Harga</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-secondary opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bookings as $booking)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="text-xs text-secondary mb-0">{{ $booking->booking_code }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $booking->customer->name }}</h6>
                                                    <a href="https://wa.me/{{ $booking->customer->phone }}" class="text-xs text-secondary mb-0">{{ $booking->customer->phone }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $booking->guide->name }}</p>
                                            <p class="text-xs text-secondary mb-0">Level: {{ ucfirst($booking->guide->guideProfile->level ?? '-') }}</p>
                                        </td>
                                        <td>
                                            <span class="text-xs">
                                                {{ $booking->start_time->format('d M Y H:i') }}<br>
                                                <small>s/d</small><br>
                                                {{ $booking->end_time->format('d M Y H:i') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-xs">{{ $booking->total_days }} hari</span>
                                        </td>
                                        <td>
                                            <span class="text-xs">{{ $booking->number_of_travelers }} orang</span>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">
                                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-gradient-{{ 
                                                $booking->status == 'confirmed' ? 'success' : 
                                                ($booking->status == 'pending' ? 'warning' : 
                                                ($booking->status == 'cancelled' ? 'danger' : 
                                                ($booking->status == 'completed' ? 'info' : 'secondary')))
                                            }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('admin.booking.status', $booking->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirm</option>
                                                    <option value="ongoing" {{ $booking->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Complete</option>
                                                    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancel</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            Belum ada booking.
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