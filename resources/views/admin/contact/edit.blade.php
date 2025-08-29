@extends('layouts.master')
@section('main')
<main class="main-content position-relative border-radius-lg">
    @include('layouts.header')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Form Update Contact</h5>
                        <hr class="bg-primary">
                        <form action="{{ route('admin.contact.update', $contact->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">No. Telp</label>
                                <div class="d-flex">
                                    <select name="country_code" class="form-select w-15 me-2" required>
                                        <option value="+62" {{ old('country_code')=='+62' ? 'selected' : '' }}>🇮🇩 +62
                                            (Indonesia)</option>
                                        <option value="+60" {{ old('country_code')=='+60' ? 'selected' : '' }}>🇲🇾 +60
                                            (Malaysia)</option>
                                        <option value="+65" {{ old('country_code')=='+65' ? 'selected' : '' }}>🇸🇬 +65
                                            (Singapore)</option>
                                        <option value="+1" {{ old('country_code')=='+1' ? 'selected' : '' }}>🇺🇸 +1
                                            (USA)</option>
                                        <option value="+81" {{ old('country_code')=='+81' ? 'selected' : '' }}>🇯🇵 +81
                                            (Japan)</option>
                                        <option value="+91" {{ old('country_code')=='+91' ? 'selected' : '' }}>🇮🇳 +91
                                            (India)</option>
                                        <option value="+44" {{ old('country_code')=='+44' ? 'selected' : '' }}>🇬🇧 +44
                                            (UK)</option>
                                        <option value="+49" {{ old('country_code')=='+49' ? 'selected' : '' }}>🇩🇪 +49
                                            (Germany)</option>
                                        <!-- tambahkan sesuai kebutuhan -->
                                    </select>

                                    <input type="number" id="phone_number" name="phone_number"
                                        value="{{ old('no_telp') }}"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        placeholder="8123456789" required>
                                </div>

                                @error('phone_number')
                                <div class="text-danger text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ old('email', $contact->email) }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Address</label>
                                <textarea name="address" class="form-control"
                                    required>{{ old('address', $contact->address) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</main>
@endsection
@section('breadcrumb', 'Contact Us')

@push('js')
<script>
    document.getElementById('phone_number').addEventListener('input', function (e) {
        let val = e.target.value;
        if (val.startsWith('0')) {
            e.target.value = val.replace(/^0+/, ''); // hapus semua 0 di depan
        }
    });
</script>
@endpush
