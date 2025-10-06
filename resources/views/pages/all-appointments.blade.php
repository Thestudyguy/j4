@extends('dashboard')
@section('content')
    <div class="container-fluid p-2 pt-5 vh-100">
        <h1 class="h1 mt-2 p-3">Appointments</h1>
<div class="loader-container appointment-page visually-hidden">
        <div class="loader"></div>
    </div>   
        <div class="row bg-white p-3 m-2 border rounded-2 align-items-center">
            <div class="col-sm-3">
                <input type="search" id="searchAppointments" class="form-control rounded-5 form-control-sm" placeholder="Search appointments...">
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-2"></div>
            <div class="col-sm-2">
                <div class="col-sm-4">
    <a href="{{ url('/appointments-report-pdf') }}" target="_blank"
       class="btn btn-transparent border border-secondary float-end btn-sm fw-semibold text-sm">
        <i class="fas fa-upload"></i>
    </a>
</div>
                <!-- <button class="btn btn-transparent text-sm text-white form-control-sm border" style="background: #244F79;" data-bs-toggle="modal" data-bs-target="#add-appointment">
                    Add Appointment <i class="fas fa-plus text-white"></i>
                </button> -->
            </div>
        </div>

        <div class="row bg-white p-3 m-2 border rounded-2" id="appointmentList">
            <div class="col-sm-12">
                <div class="row fw-semibold text-muted small mb-2">
                    <div class="col-sm-2">Patient</div>
                    <div class="col-sm-2">Date</div>
                    <div class="col-sm-2">Time</div>
                    <div class="col-sm-2">Service</div>
                    <div class="col-sm-2">Status</div>
                </div>



               @foreach ($appointments as $appt)
    @php
        $isDisabled = in_array($appt->status, ['cancel', 'completed']);
    @endphp

    <div class="row align-items-center border rounded-3 m-1 px-3 py-2 small appointment-row bg-light shadow-sm"
         id="{{ $appt->refID }}"
         >

        <div class="col-sm-2 fw-semibold text-dark">
            {{ $appt->FirstName . " " . $appt->LastName }}
        </div>
        <div class="col-sm-2 text-muted">{{ $appt->Date }}</div>
        <div class="col-sm-2">{{ $appt->Time }}</div>
        <div class="col-sm-2 text-primary">{{ $appt->service }}</div>

        <div class="col-sm-2">
            <span style="{{ $isDisabled ? 'opacity:0.6; pointer-events:none;' : '' }}" class="badge text-dark
                {{ $appt->status === 'cancel' ? 'bg-danger' :
                   ($appt->status === 'completed' ? 'bg-secondary' :
                   ($appt->status === 'confirmed' ? '' : 'bg-info')) }}"
                @if(!$isDisabled)
                    style="cursor:pointer"
                    data-bs-toggle="modal"
                    data-bs-target="#update-appointment-{{ $appt->id }}"
                @endif
            >
                {{ $appt->status }}
            </span>
            @if ($appt->note_id)
                <span class="badge" data-bs-target="#viewNoteModal-{{ $appt->note_id }}" data-bs-toggle="modal"><i class="fas fa-file text-info"></i></span>
            @endif
            {{-- <span class="badge text-dark bg-danger" data-bs-target="" data-bs-toggle=""><i class="fas fa-plus"></i></span> --}}
        </div>

        <div class="col-sm-2 text-end">
           
                <span class="text-muted">No actions</span>
        </div>
    </div>

    @include('modals.patient-appointment-update-modal')
    @include('modals.view-appt-notes-modal')
    @endforeach



            </div>
        </div>

        {{-- Include modal if needed --}}
    </div>
@endsection