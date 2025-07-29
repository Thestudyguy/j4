@extends('dashboard')

@section('content')
    <div class="container-fluid p-5">
        <div class="container p-2">
            <h4 class="fw-bold m2-4 pt-5">Appointment Summary</h4>

            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="row text-container p-4">
                            <div class="col-sm-12 text-center">
                                <div class="fw-bold lead">{{ Auth::user()->FirstName . " " . Auth::user()->LastName }}</div>
                                <div class="text-muted">{{ Auth::user()->Email }}</div>
                            </div>
                        </div>
                        <div class="row p-4 border-top">
                            <div class="text-center fw-semibold mb-2">Appointments</div>
                            <div class="col-sm-6 border-end text-center">
                                <div class="fw-bold">{{ $testCount }}</div>
                                <div class="text-muted small">Total Appointments</div>
                            </div>
                            <div class="col-sm-6 text-center">
                                <div class="fw-bold">{{ $testCount }}</div>
                                <div class="text-muted small">Total Appointments</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Header --}}
            <div class="d-flex bg-white text-dark fw-semibold px-3 py-2 rounded-3 mb-2 align-items-center">
                <div class="col-2 text-sm">Date</div>
                <div class="col-2 text-sm">Time</div>
                <div class="col-3 text-sm">Service</div>
                <div class="col-3 text-sm">Patient</div>
                <div class="col-2 text-end text-sm">Status / Actions</div>
            </div>

            {{-- Body --}}
            <div class="bg-white rounded-3">
                @forelse ($doctorsAppointments as $appt)
                    <div class="d-flex border-bottom px-3 py-2 align-items-center hover-bg-light">
                        <div class="col-2 text-sm">{{ $appt->date }}</div>
                        <div class="col-2 text-sm">{{ \Carbon\Carbon::parse($appt->time)->format('g:i A') }}</div>
                        <div class="col-3 text-sm">{{ $appt->Service }}</div>
                        <div class="col-3 text-sm">{{ $appt->FirstName . ' ' . $appt->LastName }} {{ $appt->user_id }}</div>
                        <div class="col-2 text-sm text-end">
                            <span class="badge 
                                @if($appt->status == 'Confirmed') bg-success 
                                @elseif($appt->status == 'Pending') bg-warning text-dark 
                                @else bg-secondary 
                                @endif">
                                {{ ucfirst($appt->status) }}
                            </span>
                            <a href="{{ route('patient-details-view', ['id' => $appt->patient_id]) }}" class="text-secondary ms-2 me-1" title="View"><i class="fas fa-eye"></i></a>
                            <a href="#" class="text-secondary me-1" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="#" class="text-secondary" title="Cancel"><i class="fas fa-times-circle"></i></a>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">No appointments found.</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
