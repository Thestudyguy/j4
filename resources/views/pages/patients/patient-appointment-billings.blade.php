@extends('dashboard')

@section('content')
<div class="container-fluid pt-5">
    <div class="container py-4">

        <h4 class="fw-bold mb-3">Billings</h4>
 {{-- <div class="col-sm-4">
            <input type="text" name="search" id="searchAppointmentBilling" class="form-control form-control-sm rounded-5 mb-2"
                placeholder="search...">
        </div> --}}
        {{-- Table header --}}
        <div class="row fw-semibold border-bottom pb-2 mb-2 small text-muted">
    <div class="col-sm-8">Appointment Details</div>
    <div class="col-sm-4 text-end">Actions</div>
</div>

<div id="billingList">
    @foreach ($appointments as $b)
        <div class="row align-items-center border rounded-3 m-1 p-2 small appointment-row">
            
            {{-- Appointment Summary --}}
            <div class="col-sm-8">

    {{-- Service --}}
    <div class="fw-bold">{{ $b['service_name'] }}</div>

    {{-- Date + Status --}}
    <div class="text-muted small">
        <span>{{ $b['date'] }} at {{ $b['time'] }}</span> • 
        <span>Status: <span class="fw-semibold">{{ $b['status'] }}</span></span>
    </div>

    {{-- Patient --}}
    <div class="text-muted small">
        Patient:
        <span class="fw-semibold">
            {{ $b['patient']['first_name'] }} {{ $b['patient']['last_name'] }}
        </span>
    </div>

    {{-- Doctor --}}
    @if (!empty($b['doctor']))
        <div class="text-muted small">
            Doctor: 
            <span class="fw-semibold">
                {{ $b['doctor']['title'] }} {{ $b['doctor']['first_name'] }} {{ $b['doctor']['last_name'] }}
                @if ($b['doctor']['suffix'])
                    {{ $b['doctor']['suffix'] }}
                @endif
            </span>
        </div>
    @endif

</div>

            {{-- Actions --}}
            <div class="col-sm-4 text-end">
                <button 
                    class="btn btn-sm btn-outline-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#billingModal{{ $b['appointment_id'] }}">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

        </div>



        {{-- Billing Items Modal --}}
        <div class="modal fade" id="billingModal{{ $b['appointment_id'] }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- larger modal for better UI --}}
        <div class="modal-content shadow-lg border-0">

            {{-- Header --}}
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-file-invoice-dollar me-2"></i>
                    Billing Items
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body">

                {{-- Appointment Summary --}}
                <div class="mb-3 p-3 rounded border bg-light">
                    <div class="fw-semibold">{{ $b['service_name'] }} - {{ number_format($b['service_price'], 2) }}</div>

                    <div class="small text-muted">
                        {{ $b['date'] }} at {{ $b['time'] }} • Status: 
                        <span class="fw-semibold">{{ $b['status'] }}</span>
                    </div>

                    {{-- Patient --}}
                    <div class="small mt-1">
                        Patient: 
                        <span class="fw-semibold">
                            {{ $b['patient']['first_name'] }} {{ $b['patient']['last_name'] }}
                        </span>
                    </div>

                    {{-- Doctor --}}
                    @if (!empty($b['doctor']))
                        <div class="small">
                            Doctor:
                            <span class="fw-semibold">
                                {{ $b['doctor']['title'] }} {{ $b['doctor']['first_name'] }} {{ $b['doctor']['last_name'] }}
                                @if($b['doctor']['suffix']) {{ $b['doctor']['suffix'] }} @endif
                            </span>
                        </div>
                    @endif
                </div>
                    <div class="fw-semibold">Paid in Total: {{ number_format($b['total_payments'], 2) }}</div>
                    <div class="fw-semibold">Balance: {{ number_format($b['service_price'] - $b['total_payments'], 2) }}</div>

                {{-- Billing Items List --}}
                {{-- <ul class="list-group">
                    @foreach ($b['billing_items'] as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">{{ $item['item'] }}</div>
                                <small class="text-muted">Quantity: {{ $item['quantity'] }}</small>
                            </div>
                            <div class="fw-bold text-success">
                                ₱{{ number_format($item['price'], 2) }}
                            </div>
                        </li>
                    @endforeach
                </ul> --}}

            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
            </div>

        </div>
    </div>
</div>


    @endforeach
</div>

                {{-- <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Service</th>
                            <th>Doctor</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($billings as $a)
                            <tr>
                                <td class="fw-semibold">{{ $a->id }}</td>

                                <td>{{ \Carbon\Carbon::parse($a->date)->format('M d, Y') }}</td>

                                <td>{{ $a->time }}</td>

                                <td class="fw-semibold text-primary">
                                    {{ $a->service->Service ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $a->doctor->FirstName ?? 'N/A' }}
                                    {{ $a->doctor->LastName ?? '' }}
                                </td>

                                <td>
                                    <span class="badge 
                                        @if($a->status === 'Pending') bg-warning 
                                        @elseif($a->status === 'Completed') bg-success 
                                        @elseif($a->status === 'Cancelled') bg-danger 
                                        @else bg-secondary @endif
                                        ">
                                        {{ $a->status }}
                                    </span>
                                </td>

                                <td>{{ $a->created_by ?? 'System' }}</td>

                                <td class="text-center">
                                    <a href="" 
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table> --}}

    </div>
</div>
@endsection
