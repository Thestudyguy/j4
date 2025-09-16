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
                </div>



               @foreach ($appointments as $appt)
    @php
        $isDisabled = in_array($appt->status, ['cancel', 'completed']);
    @endphp

    <div class="row align-items-center border rounded-3 m-1 px-3 py-2 small appointment-row bg-light shadow-sm"
         id="{{ $appt->refID }}"
         style="{{ $isDisabled ? 'opacity:0.6; pointer-events:none;' : '' }}">

        <div class="col-sm-2 fw-semibold text-dark">
            {{ $appt->FirstName . " " . $appt->LastName }}
        </div>
        <div class="col-sm-2 text-muted">{{ $appt->Date }}</div>
        <div class="col-sm-2">{{ $appt->Time }}</div>
        <div class="col-sm-2 text-primary">{{ $appt->service }}</div>

        <div class="col-sm-2">
            <span class="badge text-dark
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
            {{-- <span class="badge text-dark bg-danger" data-bs-target="" data-bs-toggle=""><i class="fas fa-plus"></i></span> --}}
        </div>

        <div class="col-sm-2 text-end">
           
                <span class="text-muted">No actions</span>
        </div>
    </div>

    @include('modals.patient-appointment-update-modal')
@endforeach



            </div>
        </div>

        {{-- Include modal if needed --}}
    </div>
@endsection