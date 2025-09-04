@extends('layouts.master')
@section('main')
<main class="main-content position-relative border-radius-lg">
    @include('layouts.header')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit Promo Code: {{ $promoCode->code }}</h6>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{ route('admin.promo-codes.update', $promoCode) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code" class="form-control-label">Promo Code</label>
                                        <input class="form-control @error('code') is-invalid @enderror" name="code"
                                            type="text" value="{{ old('code', $promoCode->code) }}" required
                                            placeholder="e.g., WELCOME10">
                                        @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                                            type="text" value="{{ old('name', $promoCode->name) }}" required
                                            placeholder="e.g., Welcome Discount">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="form-control-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                            name="description" rows="3"
                                            placeholder="Optional description">{{ old('description', $promoCode->description) }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="discount_type" class="form-control-label">Discount Type</label>
                                        <select class="form-control @error('discount_type') is-invalid @enderror"
                                            name="discount_type" required>
                                            <option value="">Select discount type</option>
                                            <option value="percentage" {{ old('discount_type', $promoCode->
                                                discount_type) == 'percentage' ? 'selected' : '' }}>Percentage (%)
                                            </option>
                                            <option value="fixed" {{ old('discount_type', $promoCode->discount_type) ==
                                                'fixed' ? 'selected' : '' }}>Fixed Amount (Rp)</option>
                                        </select>
                                        @error('discount_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount_value" class="form-control-label">Discount Value</label>
                                        <input class="form-control @error('discount_value') is-invalid @enderror"
                                            name="discount_value" type="number"
                                            value="{{ old('discount_value', $promoCode->discount_value) }}" required
                                            min="0" step="0.01" placeholder="e.g., 10 for 10% or 50000 for Rp50,000">
                                        @error('discount_value')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="minimum_amount" class="form-control-label">Minimum Amount
                                            (Rp)</label>
                                        <input class="form-control @error('minimum_amount') is-invalid @enderror"
                                            name="minimum_amount" type="number"
                                            value="{{ old('minimum_amount', $promoCode->minimum_amount) }}" required
                                            min="0" step="1000" placeholder="e.g., 100000">
                                        @error('minimum_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="maximum_discount" class="form-control-label">Maximum Discount
                                            (Rp)</label>
                                        <input class="form-control @error('maximum_discount') is-invalid @enderror"
                                            name="maximum_discount" type="number"
                                            value="{{ old('maximum_discount', $promoCode->maximum_discount) }}" min="0"
                                            step="1000" placeholder="Optional, e.g., 100000">
                                        @error('maximum_discount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="usage_limit" class="form-control-label">Usage Limit</label>
                                        <input class="form-control @error('usage_limit') is-invalid @enderror"
                                            name="usage_limit" type="number"
                                            value="{{ old('usage_limit', $promoCode->usage_limit) }}" min="1"
                                            placeholder="Optional, e.g., 100">
                                        @error('usage_limit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="start_date" class="form-control-label">Start Date</label>
                                        <input class="form-control @error('start_date') is-invalid @enderror"
                                            name="start_date" type="date"
                                            value="{{ old('start_date', $promoCode->start_date->format('Y-m-d')) }}"
                                            required>
                                        @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="end_date" class="form-control-label">End Date</label>
                                        <input class="form-control @error('end_date') is-invalid @enderror"
                                            name="end_date" type="date"
                                            value="{{ old('end_date', $promoCode->end_date->format('Y-m-d')) }}"
                                            required>
                                        @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="is_active" value="0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_active"
                                                id="is_active" value="1" {{ old('is_active', $promoCode->is_active) ?
                                            'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.promo-codes.index') }}"
                                    class="btn btn-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Promo Code</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
