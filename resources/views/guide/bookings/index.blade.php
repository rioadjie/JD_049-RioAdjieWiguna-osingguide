@extends('layouts.master')
@section('main')
    <main class="main-content position-relative border-radius-lg">
        @include('layouts.header')

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Pemesanan Saya</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-4">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Booking ID</th>
                                            <th>Customer</th>
                                            <th>Tanggal</th>
                                            <th>Durasi</th>
                                            <th>Jumlah Orang</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bookings as $booking)
                                            <tr>
                                                <td>{{ $booking->booking_code }}</td>
                                                <td>{{ $booking->customer->name }}</td>
                                                <td>
                                                    {{ $booking->start_time->format('d M Y H:i') }}<br>
                                                    <small>s/d</small><br>
                                                    {{ $booking->end_time->format('d M Y H:i') }}
                                                </td>
                                                <td>{{ $booking->total_days }} hari</td>
                                                <td>{{ $booking->number_of_travelers }} orang</td>
                                                <td>
                                                    <span
                                                        class="badge bg-gradient-{{ $booking->status == 'confirmed'
                                                            ? 'info'
                                                            : ($booking->status == 'ongoing'
                                                                ? 'warning'
                                                                : ($booking->status == 'completed'
                                                                    ? 'success'
                                                                    : 'secondary')) }}">
                                                        {{ ucfirst($booking->status) }}
                                                    </span>
                                                    @if($booking->status === 'ongoing')
                                                        <form action="{{ route('guide.booking.complete', $booking->id) }}" method="POST" class="mt-2">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success" 
                                                                    onclick="return confirm('Apakah perjalanan ini sudah selesai?')">
                                                                Tandai Selesai
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Belum ada pemesanan.</td>
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
