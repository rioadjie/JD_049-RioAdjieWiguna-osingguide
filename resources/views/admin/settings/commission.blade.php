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
                            <h6>Atur Komisi Platform</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.settings.commission') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Jenis Komisi</label>
                                <select name="fee_type" class="form-control" required>
                                    <option value="percentage" {{ $feeType == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                                    <option value="fixed" {{ $feeType == 'fixed' ? 'selected' : '' }}>Nominal Tetap (Rp)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    Nilai Komisi
                                </label>
                                <input type="number" name="fee_value" 
                                       class="form-control" 
                                       value="{{ old('fee_value', $feeValue) }}" 
                                       required 
                                       min="0" 
                                       step="any"
                                       placeholder="Masukkan nilai komisi">
                                <small class="text-muted">
                                    @if($feeType == 'percentage')
                                        Contoh: 15 → berarti 15% dari subtotal
                                    @else
                                        Contoh: 50000 → berarti Rp50.000 per booking
                                    @endif
                                </small>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
</main>
@endsection