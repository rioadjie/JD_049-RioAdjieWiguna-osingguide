@extends('layouts.master')
@section('main')
<main class="main-content position-relative border-radius-lg">
    @include('layouts.header')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Promo Codes</h6>
                        <a href="{{ route('admin.promo-codes.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-2"></i>Add New Promo Code
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Code</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Discount</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Usage</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Period</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Status</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($promoCodes as $promoCode)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $promoCode->code }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $promoCode->name }}</p>
                                            @if($promoCode->description)
                                            <p class="text-xs text-secondary mb-0">{{
                                                Str::limit($promoCode->description, 50) }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if($promoCode->discount_type === 'percentage')
                                                {{ $promoCode->discount_value }}%
                                                @if($promoCode->maximum_discount)
                                                <br><small class="text-secondary">Max: Rp{{
                                                    number_format($promoCode->maximum_discount) }}</small>
                                                @endif
                                                @else
                                                Rp{{ number_format($promoCode->discount_value) }}
                                                @endif
                                            </p>
                                            <p class="text-xs text-secondary mb-0">Min: Rp{{
                                                number_format($promoCode->minimum_amount) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $promoCode->used_count }}
                                                @if($promoCode->usage_limit)
                                                / {{ $promoCode->usage_limit }}
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{
                                                $promoCode->start_date->format('d/m/Y') }}</p>
                                            <p class="text-xs text-secondary mb-0">{{
                                                $promoCode->end_date->format('d/m/Y') }}</p>
                                        </td>
                                        <td>
                                            @if($promoCode->isValid())
                                            <span class="badge badge-sm bg-gradient-success">Active</span>
                                            @elseif($promoCode->isExpired())
                                            <span class="badge badge-sm bg-gradient-danger">Expired</span>
                                            @elseif($promoCode->isNotStarted())
                                            <span class="badge badge-sm bg-gradient-warning">Not Started</span>
                                            @elseif($promoCode->isUsageLimitReached())
                                            <span class="badge badge-sm bg-gradient-secondary">Limit Reached</span>
                                            @else
                                            <span class="badge badge-sm bg-gradient-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.promo-codes.edit', $promoCode) }}"
                                                    class="btn btn-link text-secondary px-3 mb-0">
                                                    <i class="fas fa-pencil text-xs me-1"></i>Edit
                                                </a>
                                                <form action="{{ route('admin.promo-codes.toggle', $promoCode) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link text-secondary px-3 mb-0">
                                                        <i
                                                            class="fas fa-{{ $promoCode->is_active ? 'eye-slash' : 'eye' }} text-xs me-1"></i>
                                                        {{ $promoCode->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.promo-codes.destroy', $promoCode) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger px-3 mb-0"
                                                        onclick="return confirm('Are you sure you want to delete this promo code?')">
                                                        <i class="fas fa-trash text-xs me-1"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <p class="text-secondary">No promo codes found.</p>
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
    </div>
</main>
@endsection
