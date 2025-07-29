@extends('dashboard')
@section('content')
    <div class="container-fluid p-2 pt-5 vh-100">
        <h1 class="h1 mt-2 p-3">Appointments</h1>
<div class="loader-container appointment-page visually-hidden">
        <div class="loader"></div>
    </div>   
        <div class="row bg-white p-3 m-2 border rounded-2 align-items-center">
            <div class="col-sm-3">
                <input type="search" class="form-control rounded-5 form-control-sm" placeholder="Search appointments...">
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-2"></div>
            <div class="col-sm-2">
                <button class="btn btn-transparent border" style="background: #244F79;" title="Download">
                    <i class="fas fa-download text-white"></i>
                </button>
                <!-- <button class="btn btn-transparent text-sm text-white form-control-sm border" style="background: #244F79;" data-bs-toggle="modal" data-bs-target="#add-appointment">
                    Add Appointment <i class="fas fa-plus text-white"></i>
                </button> -->
            </div>
        </div>

        <div class="row bg-white p-3 m-2 border rounded-2">
            <div class="col-sm-12">
                <div class="row fw-semibold text-muted small mb-2">
                    <div class="col-sm-2">Patient</div>
                    <div class="col-sm-2">Date</div>
                    <div class="col-sm-2">Time</div>
                    <div class="col-sm-2">Service</div>
                    <div class="col-sm-2">Status</div>
                    <div class="col-sm-2 text-end">Actions</div>
                </div>



                @foreach ($appointments as $appt)
                    <div class="row align-items-center border rounded-3 m-1 px-3 py-2 small appointment-row bg-light shadow-sm" id="{{ $appt->refID }}">
                        <div class="col-sm-2 fw-semibold text-dark">{{ $appt->FirstName . " " . $appt->LastName }}</div>
                        <div class="col-sm-2 text-muted">{{ $appt->date }}</div>
                        <div class="col-sm-2">{{ $appt->time }}</div>
                        <div class="col-sm-2 text-primary">{{ $appt->Service }}</div>
                        <div class="col-sm-2">
                            <span class="badge text-dark" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#update-patient-appointment-{{ $appt->apptID }}">{{ $appt->status }}</span>
                        </div>
                        <div class="col-sm-2 text-end">
                            <a href="{{ route('patient-details-view', ['id' => $appt->refID]) }}" class="text-secondary me-2" title="View" ><i class="fas fa-eye"></i></a>
                            <a href="#" class="text-secondary me-2" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="#" class="text-secondary" title="Cancel"><i class="fas fa-times-circle"></i></a>
                        </div>
                    </div>
                    @include('modals.update-patient-appointment')
                @endforeach

            </div>
        </div>

        {{-- Include modal if needed --}}
    </div>
@endsection