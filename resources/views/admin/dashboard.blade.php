@extends('layouts.master')

@section('main')
<main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
    @include('layouts.header')
    <!-- End Navbar -->

    <div class="container-fluid py-4">
        <div class="row">
            <!-- Total Bookings -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Booking</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $totalBookings }}
                                    </h5>
                                    <p class="mb-0 text-sm">
                                        <span class="text-success font-weight-bolder">+{{ $pendingBookings }}</span>
                                        pending
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Bookings -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Booking Pending</p>
                                    <h5 class="font-weight-bolder text-warning">
                                        {{ $pendingBookings }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-danger font-weight-bolder">Aksi diperlukan</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-time-alarm text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Guides -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Guide</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $totalGuides }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success font-weight-bolder">Aktif</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Customers -->
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Customer</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $totalCustomers }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success font-weight-bolder">Terdaftar</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                    <i class="ni ni-single-copy-04 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Booking Terbaru -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Booking Terbaru</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-4">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Guide</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Durasi</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-secondary opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $booking->customer->name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $booking->customer->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $booking->guide->name }}</p>
                                        </td>
                                        <td>
                                            <span class="text-xs">{{ $booking->start_time->format('d M') }} - {{ $booking->end_time->format('d M') }}</span>
                                        </td>
                                        <td>
                                            <span class="text-xs">{{ $booking->total_days }} hari</span>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-gradient-{{ 
                                                $booking->status == 'confirmed' ? 'success' : 
                                                ($booking->status == 'pending' ? 'warning' : 
                                                ($booking->status == 'cancelled' ? 'danger' : 'info'))
                                            }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('admin.booking.status', $booking->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()" class="form-control form-control-sm">
                                                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirm</option>
                                                    <option value="ongoing" {{ $booking->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Complete</option>
                                                    <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancel</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
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
