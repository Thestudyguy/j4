@extends('dashboard')
@section('content')
<div class="container-fluid pt-5 billings-container">

    <div class="loader-container billings-page visually-hidden">
        <div class="loader"></div>
    </div>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 px-3 mt-4">
        <h1 class="fw-bold mb-0 text-primary">Billings</h1>

        <button class="btn btn-primary fw-semibold px-3"
                data-bs-target="#new-billing" data-bs-toggle="modal">
            <i class="fas fa-plus me-1"></i> New Billing
        </button>

        @include('modals.new-billing-modal')
    </div>

    <!-- Statistic Cards -->
    <div class="row g-3 px-3 mb-4">

        <div class="col-sm-3">
            <div class="stat-card shadow-sm">
                <span class="text-muted small">Total Billings</span>
                <p class="display-6 fw-semibold">{{ $totalBillings ?? 100 }}</p>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="stat-card shadow-sm">
                <span class="text-muted small">Total Revenue</span>
                <p class="display-6 fw-semibold">{{ $totalRevenue ?? 100 }}</p>
            </div>
        </div>

    </div>

    <!-- Table Section -->
    <div class="card shadow-sm border-0 mx-3">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <span class="fw-bold h5 mb-0">Billings List</span>
            <input type="text" class="form-control w-25" placeholder="Search...">
        </div>

        <div class="card-body" style="overflow-y: auto; max-height: 500px;">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Patient</th>
                        <th>Procedure</th>
                        {{-- <th>Quantity</th> --}}
                        <th>Amount</th>
                        {{-- <th>Date</th> --}}
                        <th>Date Issued</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($updatedBilling as $item)
                      @php
                      $total = 0;
                        $total += ($item->quantity * $item->itemPrice);
                    @endphp
                        <tr id="{{ $item->appointmentID }}">
                            <td>{{ $item->FirstName }} {{ $item->LastName }}</td>
                            <td>{{ $item->Service }}</td>
                            {{-- <td>₱{{ number_format($item->quantity) }}</td> --}}
                            <td>₱{{ number_format($total, 2) }}</td>
                            {{-- <td>{{ \Carbon\Carbon::parse($item->date)->format('F j, Y') }}</td> --}}

                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y') }}</td>

                            <td class="text-center">
                                <a href="" target="_blank"
                                    class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-upload"></i>
                                </a>
                            </td>
                            {{-- <pre>{!! json_encode($item, JSON_PRETTY_PRINT) !!}</pre> --}}

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
