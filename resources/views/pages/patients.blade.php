@extends('dashboard')

@section('content')
    <div class="container-fluid pt-4 mt-5">
        <div class="loader-container patients-page visually-hidden">
            <div class="loader"></div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-semibold">Patients</h4>
            <button class="btn btn-sm btn-outline-primary d-flex align-items-center" data-bs-toggle="modal"
                data-bs-target="#walkin-patient">
                <i class="fas fa-user-plus me-1"></i> Add Walk-In Patient
            </button>
            @include('modals.add-walkin-patient')
        </div>
        <div class="col-sm-4">
            <input type="text" name="search" id="searchPatients" class="form-control form-control-sm rounded-5 mb-2"
                placeholder="search...">
        </div>
        {{-- Table header --}}
        <div class="row fw-semibold border-bottom pb-2 mb-2 small text-muted">
            <div class="col-sm-2">Patient</div>
            <div class="col-sm-2 text-end">Actions</div>
        </div>

        {{-- Sample Appointments --}}

        {{-- <input type="search" id="searchPatients" class="form-control rounded-5 form-control-sm" placeholder="Search patients..."> --}}

        <div id="patientList">
            @foreach ($patients as $refID => $appointments)
                @php $first = $appointments[0]; @endphp
                <div class="row align-items-center border rounded-3 m-1 p-2 small appointment-row">
                    <div class="col-sm-2">{{ $first->FirstName . ' ' . $first->LastName }} id - {{ $first->refID }}</div>
                    <div class="col-sm-2 text-end">
                        <a href="{{ route('patient-details-view', ['id' => $first->refID]) }}" class="text-muted me-2"
                            title="View"><i class="fas fa-eye"></i></a>
                        <a href="" data-bs-target="#schedule-patient-appointment-{{ $first->refID }}"
                            data-bs-toggle="modal" class="text-muted me-2" title="Schedule appointment for this patient"><i
                                class="fas fa-plus"></i></a>
                        <a href="#" class="text-muted me-2" title="View Services" data-bs-toggle="modal"
                            data-bs-target="#patient-services-{{ $first->refID }}"><i class="fas fa-file-invoice"></i></a>
                    </div>
                </div>
                @include('modals.view-patient-services')
                @include('modals.walkin-patient-appointment-modal')
            @endforeach
        </div>


    </div>
@endsection
