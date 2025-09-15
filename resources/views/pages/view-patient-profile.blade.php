@extends('dashboard')
@section('content')
    <div class="container p-3">
        <div class="appointment-loader-container update-pbi-loader visually-hidden">
            <div class="appointment-loader"></div>
        </div>
        <div class="mt-5">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body bg-light">
                    <h5 class="card-title mb-1 text-primary fw-bold">
                        {{ ucwords(strtolower($patient->LastName)) }},
                        {{ ucwords(strtolower($patient->FirstName)) }}
                        @if (!empty($patient->MiddleName))
                            <small class="text-muted">{{ ucwords(strtolower($patient->MiddleName)) }}</small>
                        @endif
                    </h5>
                    <p class="card-text text-muted mb-0">Patient Information Overview</p>
                </div>
            </div>
        </div>
        {{-- @include('components.patients-appointments') --}}

        {{-- @include('components.patient-details-personal-info') --}}
        @if (Auth::user()->Role === 'Admin')
            <div class="row g-3 mt-4">
                <!-- Total Appointments -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3 text-primary">
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Total Appointments</h6>
                                <h4 class="mb-0 fw-bold">{{$servicesCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed Appointments -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3 text-success">
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Completed</h6>
                                <h4 class="mb-0 fw-bold">{{$completedAppt}}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services Availed -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3 text-warning">
                            </div>
                            <div>
                                <h6 class="mb-1 text-muted">Services Availed</h6>
                                <h4 class="mb-0 fw-bold">{{$servicesCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    @include('components.patients-appointments')
                </div>
                <div class="col-sm-12">
            @include('components.patient-details-personal-info')
                </div>
            </div>
        @endif
        <hr class="my-4" style="border-top: 1px solid black; height: 1px;">
        @if (Auth::user()->Role !== 'Admin')
        @include('components.patient-details-personal-info')
        @include('pages.patients.patient-profile-medical-history')
        @endif
    </div>
@endsection
