@extends('layouts.master')
@section('main')
<main class="main-content position-relative border-radius-lg">
    @include('layouts.header')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h6>Reviews From Customer</h6>
                            <div>
                                <span class="badge bg-info">Rata-rata: {{ number_format($avgRating, 1) }}/5</span>
                                <span class="badge bg-secondary">Total: {{ $totalReviews }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if($reviews->isEmpty())
                            <p class="text-center text-muted">Belum ada ulasan dari customer.</p>
                        @else
                            <div class="timeline timeline-one-side">
                                @foreach($reviews as $review)
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        <i class="ni ni-satisfied text-info text-gradient"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">
                                            {{ $review->customer->name }} 
                                            <span class="badge bg-{{ ['','danger','danger','warning','success','success'][$review->rating] }}">
                                                {{ $review->rating }} ⭐
                                            </span>
                                        </h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                            {{ $review->booking->start_time->format('d M Y') }} 
                                            • {{ $review->created_at->diffForHumans() }}
                                        </p>
                                        <p class="text-sm mt-2">
                                            "{{ $review->comment ?? 'Tidak ada komentar.' }}"
                                        </p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
</main>
@endsection