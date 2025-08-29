@extends('layouts.master')
@section('main')
<main class="main-content position-relative border-radius-lg">
    @include('layouts.header')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Detail Customer: {{ $customer->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Email:</strong> {{ $customer->email }}</p>
                                <p><strong>HP:</strong> {{ $customer->phone ?? '-' }}</p>
                                <p><strong>Total Booking:</strong> {{ $customer->bookings_as_customer_count }}</p>
                            </div>
                        </div>

                        <hr>

                        <h6>Riwayat Pemesanan</h6>
                        @if($customer->bookingsAsCustomer->isEmpty())
                            <p class="text-muted">Belum pernah memesan pemandu.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Guide</th>
                                            <th>Tanggal</th>
                                            <th>Durasi</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customer->bookingsAsCustomer as $booking)
                                        <tr>
                                            <td>{{ $booking->guide->name }}</td>
                                            <td>{{ $booking->start_time->format('d M Y') }} - {{ $booking->end_time->format('d M Y') }}</td>
                                            <td>{{ $booking->total_days }} hari</td>
                                            <td>
                                                <span class="badge bg-{{ 
                                                    $booking->status == 'completed' ? 'success' : 
                                                    ($booking->status == 'confirmed' ? 'info' : 'warning') 
                                                }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('admin.customers') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
</main>
@endsection