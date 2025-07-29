@extends('dashboard')

@section('content')
<div class="container-fluid pt-4 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-semibold">Appointments</h4>
        <button class="btn btn-sm btn-outline-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#walkin-patient">
            <i class="fas fa-user-plus me-1"></i> Add Walk-In Patient
        </button>
        @include('modals.add-walkin-patient')
    </div>
    <div class="col-sm-4">
        <input type="text" name="search" class="form-control form-control-sm rounded-5 mb-2" placeholder="search...">
    </div>
    {{-- Table header --}}
    <div class="row fw-semibold border-bottom pb-2 mb-2 small text-muted">
        <div class="col-sm-2">Patient</div>
        <div class="col-sm-2 text-end">Actions</div>
    </div>

    {{-- Sample Appointments --}}
    
        @foreach ($patients as $refID => $appointments)
    @php $first = $appointments[0]; @endphp
    <div class="row align-items-center border rounded-3 m-1 p-2 small appointment-row">
        <div class="col-sm-2">{{ $first->FirstName . ' ' . $first->LastName }}</div>
        <div class="col-sm-2 text-end">
            <a href="{{ route('patient-details-view', ['id' => $first->refID]) }}" class="text-muted me-2" title="View"><i class="fas fa-eye"></i></a>
            <a href="#" class="text-muted me-2" title="Edit"><i class="fas fa-pen"></i></a>
            <a href="#" class="text-muted" title="Cancel"><i class="fas fa-xmark"></i></a>
            <a href="#" class="text-muted me-2" title="View Services" data-bs-toggle="modal" data-bs-target="#patient-services-{{ $first->refID }}"><i class="fas fa-file-invoice"></i></a>
        </div>
    </div>
    @include('modals.view-patient-services')
@endforeach

</div>
@endsection
