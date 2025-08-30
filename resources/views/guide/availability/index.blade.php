@extends('layouts.master')
@section('main')
    <main class="main-content position-relative border-radius-lg">
        @include('layouts.header')

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5>Kelola Ketersediaan</h5>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <!-- Form: Set Rentang Tanggal -->
                            <form action="{{ route('guide.availability.bulk') }}" method="POST" class="mb-4">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Dari Tanggal</label>
                                        <input type="date" name="start_date" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Sampai Tanggal</label>
                                        <input type="date" name="end_date" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="available">Tersedia</option>
                                            <option value="unavailable">Tidak Tersedia</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                                {{-- <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan untuk Semua Tanggal</button>
                                </div> --}}
                            </form>

                            <hr>

                            <!-- Kalender -->
                            <div class="text-center">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <a href="?month={{ $month == 1 ? 12 : $month - 1 }}&year={{ $month == 1 ? $year - 1 : $year }}"
                                        class="btn btn-sm btn-secondary">&laquo; Bulan Lalu</a>
                                    <h5>{{ \Carbon\Carbon::create($year, $month, 1)->translatedFormat('F Y') }}</h5>
                                    <a href="?month={{ $month == 12 ? 1 : $month + 1 }}&year={{ $month == 12 ? $year + 1 : $year }}"
                                        class="btn btn-sm btn-secondary">Bulan Depan &raquo;</a>
                                </div>

                                <table class="table table-bordered text-center" style="font-size: 0.9rem;">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-danger">Min</th>
                                            <th>Sen</th>
                                            <th>Sel</th>
                                            <th>Rab</th>
                                            <th>Kam</th>
                                            <th>Jum</th>
                                            <th>Sab</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $currentDay = 1; @endphp
                                        @for ($week = 0; $week < 6; $week++)
                                            <tr>
                                                @for ($day = 0; $day < 7; $day++)
                                                    @if ($week == 0 && $day < $firstDayOfWeek)
                                                        <td class="bg-light"></td>
                                                    @elseif ($currentDay > $daysInMonth)
                                                        <td class="bg-light"></td>
                                                    @else
                                                        @php
                                                            $dateStr = sprintf(
                                                                '%04d-%02d-%02d',
                                                                $year,
                                                                $month,
                                                                $currentDay,
                                                            );
                                                            $status = $availabilities[$dateStr] ?? null;
                                                            $bg =
                                                                $status === 'available'
                                                                    ? 'bg-success text-white'
                                                                    : ($status === 'unavailable'
                                                                        ? 'bg-danger text-white'
                                                                        : '');
                                                        @endphp
                                                        <td class="{{ $bg }}"
                                                            style="height: 80px; vertical-align: top;">
                                                            <div><strong>{{ $currentDay }}</strong></div>
                                                            <div style="font-size: 0.8rem;">
                                                                @if ($status === 'available')
                                                                    ✅ Tersedia
                                                                @elseif ($status === 'unavailable')
                                                                    ❌ Tidak Tersedia
                                                                @else
                                                                    ⚪ Belum Diatur
                                                                @endif
                                                            </div>
                                                        </td>
                                                        @php $currentDay++; @endphp
                                                    @endif
                                                @endfor
                                            </tr>
                                            @if ($currentDay > $daysInMonth)
                                                @break
                                            @endif
                                        @endfor
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
