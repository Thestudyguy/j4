@extends('dashboard')
@section('content')
    <div class="container">
        <div class="container-fluid pt-5 mt-3">
            <div class="container py-4">
                <h4 class="fw-bold text-dark mb-4 text-left">Profile </h4>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">

                                {{-- Circular Initials Avatar --}}
                                @php
                                    $initials = strtoupper(
                                        substr($patient['FirstName'], 0, 1) . substr($patient['LastName'], 0, 1),
                                    );
                                @endphp

                                <div
                                    style="
                                        width: 45px;
                                        height: 45px;
                                        border-radius: 50%;
                                        background: #0d6efd; /* Bootstrap primary */
                                        color: white;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        font-weight: bold;
                                        font-size: 18px;
                                        margin-right: 10px;
                                    ">
                                    {{ $initials }}
                                </div>

                                {{-- Patient Name --}}
                                <span class="fw-semibold">{{ $patient['FirstName'] }} {{ $patient['LastName'] }}</span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-4">
                                        <p class="text-sm lead fw-semibold">Mobile:</p>
                                    </div>
                                    <div class="col-sm-8 text-sm text-muted">{{ $patient['MobileNo'] ?? 'N/A' }}</div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-sm-4">
                                        <p class="text-sm lead fw-semibold">Email:</p>
                                    </div>
                                    <div class="col-sm-8 text-sm text-muted">{{ $patient['Email'] ?? 'N/A' }}</div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-sm-4">
                                        <p class="text-sm lead fw-semibold">Home No.:</p>
                                    </div>
                                    <div class="col-sm-8 text-sm text-muted">{{ $patient['HomeNo'] ?? 'N/A' }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="text-sm lead fw-semibold">Address:</p>
                                    </div>
                                    <div class="col-sm-8 text-sm text-muted">{{ $patient['Address'] ?? 'N/A' }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-body text-center p-4">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                    style="width: 60px; height: 60px; background: #e8f0ff;">
                                    <i class="fas fa-calendar-check text-primary fs-4"></i>
                                </div>
                                <h6 class="fw-bold text-muted mb-1">Total Appointments</h6>
                                <h2 class="fw-bold text-primary">{{ number_format($patientAppointmentCount) }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-body text-center p-4">

                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                    style="width: 60px; height: 60px; background: #e8f0ff;">
                                    <i class="fas fa-sync-alt text-primary fs-4"></i>
                                </div>

                                <h6 class="fw-bold text-muted mb-1">Follow-Up Appointments</h6>
                                <h2 class="fw-bold text-primary">2</h2>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <span class="fw-semibold lead text-md mt-3">Appointments</span>
                    <div class="col-sm-12">
                        <div class="row p-2 rounded-2 mb-2" style="background: #f0f0f0;">
                            <div class="col-sm-2 text-sm">Date</div>
                            <div class="col-sm-2 text-sm">Time</div>
                            <div class="col-sm-2 text-sm">Procedure</div>
                            <div class="col-sm-4 text-sm">Dentist</div>
                            {{-- <div class="col-sm-2 text-sm">Status</div> --}}

                        </div>
                    </div>
                    @foreach ($prepAppointment as $appt)
                        <div class="row p-2 rounded-2 my-2 text-sm text-left"
                            @if ($appt->status === 'cancel') style="" @endif>

                            <div class="col-sm-2 text-sm">{{ $appt->date }}</div>
                            <div class="col-sm-2 text-sm">{{ $appt->time }}</div>
                            <div class="col-sm-2 text-sm">{{ $appt->service }}</div>
                            <div class="col-sm-4 text-sm">{{ $appt->title }} {{ $appt->dfName }} {{ $appt->dlname }}
                            </div>

                            <div class="col-sm-2 text-sm">
                                @if ($appt->status === 'cancel')
                                    <span class="badge bg-danger text-white fw-bold">Cancelled</span>
                                    <span class="badge text-white fw-bold"
                                        data-bs-target="#viewNoteModal-{{ $appt->note_id }}" data-bs-toggle="modal"><i
                                            class="fas fa-file text-info"></i></span>
                                @elseif($appt->status === 'completed')
                                    <span class="badge bg-success text-white fw-bold">Completed</span>
                                @else
                                    <span class="badge" style="cursor: pointer;" data-bs-toggle="modal"
                                        data-bs-target="#update-appointment-{{ $appt->id }}">
                                        <i class="fas fa-pen text-success"></i>
                                    </span>
                                    {{-- <span class="badge" style="cursor: pointer;" data-bs-toggle="modal"
                                        data-bs-target="#update-appointment-{{ $appt->id }}">
                                        <i class="fas fa-file text-info"></i>
                                    </span> --}}
                                @endif
                            </div>

                            @include('modals.view-appt-notes-modal')
                            @include('modals.patient-appointment-update-modal')
                        </div>
                    @endforeach
                    

                    {{-- @include('pages.patients.patient-profile-medical-History') --}}
                </div>
            </div>

        </div>

    </div>
    {{-- @include('pages.patients.patient-profile-personal-info') --}}
    </div>
    </div>
@endsection
