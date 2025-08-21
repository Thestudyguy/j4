@extends('dashboard')
@section('content')
    <div class="container bg-light">
        <div class="container-fluid pt-5 bg-light py-5 mt-3">


            <div class="container py-4">
                <h4 class="fw-bold text-dark mb-4 text-left">My Profile</h4>
                <div class="row p-2 rounded-2 mb-2" style="background: #f0f0f0;">
                    <div class="col-sm-2 text-sm">Date</div>
                    <div class="col-sm-2 text-sm">Time</div>
                    <div class="col-sm-2 text-sm">Procedure</div>
                    <div class="col-sm-4 text-sm">Dentist</div>
                    {{-- <div class="col-sm-2 text-sm">Status</div> --}}

                </div>
            </div>
            @foreach ($prepAppointment as $appt)
                <div class="row p-2 rounded-2 my-2 text-sm text-left" style="background: #f0f0f0;">
                    <div class="col-sm-2 text-sm">{{ $appt->Date }}</div>
                    <div class="col-sm-2 text-sm">{{ $appt->Time }}</div>
                    <div class="col-sm-2 text-sm">{{ $appt->service }}</div>
                    <div class="col-sm-4 text-sm">{{ $appt->title }} {{ $appt->dfName }} {{ $appt->dlname }}</div>
                    <div class="col-sm-2 text-sm"><span class="badge" style="cursor: pointer;" data-bs-target="#update-appointment-{{ $appt->id }}"  data-bs-toggle="modal"><i class="fas fa-pen text-success"></i></span></div>
                    {{-- <div class="col-sm-2 text-sm"><span class="badge bg-warning" style="cursor: pointer;"
                            data-bs-target="#update-appointment-{{ $appt->id }}"
                            data-bs-toggle="modal">{{ $appt->status }}</span></div> --}}
                    <!-- <div class="col-sm-2 text-sm text-center mt-2">

                                        </div> -->

                    @include('modals.patient-appointment-update-modal')
            @endforeach

        </div>
    </div>
    <hr class="my-4" style="border-top: 1px solid black; height: 1px;">
    <div class="container-title fw-semibold lead mb-3">Due Payments</div>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header text-dark fw-bold">
                    Services Availed
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($prepAppointment as $appointment)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $appointment->service }}
                                <span class="badge bg-success rounded-pill">
                                    ₱{{ number_format($appointment->price, 2) }}
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No services availed.</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer bg-light fw-bold d-flex justify-content-between">
                    Total Due:
                    <span>₱{{ number_format($patientDuePayments, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-4" style="border-top: 1px solid black; height: 1px;">
    <div class="row">
        <p class="fw-semibold lead">Patient Information</p>
        @include('pages.patients.patient-profile-personal-info')
        <hr class="my-4" style="border-top: 1px solid black; height: 1px;">
        @include('pages.patients.patient-profile-medical-history')
    </div>
    </div>
    </div>
@endsection
