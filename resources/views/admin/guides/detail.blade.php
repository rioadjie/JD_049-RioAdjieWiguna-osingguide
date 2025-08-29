@extends('layouts.master')
@section('main')
<main class="main-content position-relative border-radius-lg">
    @include('layouts.header')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Detail Pemandu: {{ $guide->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Email:</strong> {{ $guide->email }}</p>
                                <p><strong>HP:</strong> {{ $guide->phone ?? '-' }}</p>
                                <p><strong>Level:</strong> 
                                    <span class="badge bg-primary">{{ ucfirst($guide->guideProfile->level ?? '-') }}</span>
                                </p>
                                <p><strong>Status:</strong> 
                                    <span class="badge bg-{{ ($guide->guideProfile->status ?? 'inactive') === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($guide->guideProfile->status ?? 'inactive') }}
                                    </span>
                                </p>
                                <p><strong>Tarif Harian:</strong> 
                                    Rp {{ number_format($guide->guideProfile->daily_rate ?? 0, 0, ',', '.') }}
                                </p>
                                <p><strong>Maksimal Wisatawan:</strong> {{ $guide->guideProfile->max_travelers ?? '-' }} orang</p>
                                <p><strong>Bahasa:</strong> 
                                    {{ implode(', ', $guide->guideProfile->languages ?? []) }}
                                </p>
                                <p><strong>Skill:</strong> 
                                    {{ implode(', ', $guide->guideProfile->skills ?? []) }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Pengalaman:</strong><br>{{ $guide->guideProfile->experience ?? '-' }}</p>
                                <p><strong>Bio:</strong><br>{{ $guide->guideProfile->bio ?? '-' }}</p>
                                <p><strong>Rating Rata-rata:</strong> 
                                    <span class="badge bg-warning">{{ number_format($avgRating, 1) }}/5</span>
                                </p>
                                <p><strong>Total Booking Selesai:</strong> {{ $guide->total_bookings }}</p>
                            </div>
                        </div>

                        <hr>

                        <h6>Riwayat Booking Terbaru</h6>
                        @if($guide->bookingsAsGuide->isEmpty())
                            <p class="text-muted">Belum ada booking.</p>
                        @else
                            <ul class="list-group">
                                @foreach($guide->bookingsAsGuide as $booking)
                                <li class="list-group-item">
                                    <strong>{{ $booking->customer->name }}</strong> 
                                    ({{ $booking->start_time->format('d M') }} - {{ $booking->end_time->format('d M') }})
                                    <span class="badge bg-{{ 
                                        $booking->status == 'completed' ? 'success' : 
                                        ($booking->status == 'confirmed' ? 'info' : 'warning') 
                                    }} float-end">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('admin.guides') }}" class="btn btn-secondary">Kembali</a>
                            <form action="{{ route('admin.guide.toggle', $guide->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn 
                                    {{ ($guide->guideProfile->status ?? 'inactive') === 'active' ? 'btn-warning' : 'btn-success' }}
                                ">
                                    {{ ($guide->guideProfile->status ?? 'inactive') === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
</main>
@endsection