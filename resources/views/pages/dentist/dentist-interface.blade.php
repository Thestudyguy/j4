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
                                <div class="fw-bold lead">{{ Auth::user()->FirstName . ' ' . Auth::user()->LastName }}</div>
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
                <div class="col-sm-4">
    <div class="card p-3 shadow-sm border-0 rounded-3" style="height: 220px; overflow-x: hidden;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="fw-semibold lead text-sm">Completed</span>
            <a href="#" class="small text-decoration-none text-primary">See all</a>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
            <div class="display-4 fw-bold">
                {{ $statusCounts['completed'] ?? 0 }}
            </div>
            {{-- <small class="text-muted">Appointments</small> --}}
        </div>
    </div>
</div>

<div class="col-sm-4">
    <div class="card p-3 shadow-sm border-0 rounded-3" style="height: 220px; overflow-x: hidden;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="fw-semibold lead text-sm">Upcoming Procedures</span>
            <a href="#" class="small text-decoration-none text-primary">See all</a>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
            <div class="display-4 fw-bold">
                {{ $statusCounts['Pending'] ?? 0 }}
            </div>
            {{-- <small class="text-muted">Appointments</small> --}}
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
                @forelse ($dentistAppointments as $appt)
                    <div class="d-flex border-bottom px-3 py-2 align-items-center hover-bg-light">
                        <div class="col-2 text-sm">{{ $appt->Date }}</div>
                        <div class="col-2 text-sm">{{ \Carbon\Carbon::parse($appt->Time)->format('g:i A') }}</div>
                        <div class="col-3 text-sm">{{ $appt->service }}</div>
                        <div class="col-3 text-sm">{{ $appt->FirstName . ' ' . $appt->LastName }}</div>
                        <div class="col-2 text-sm text-end">
                            <span
                                style="cursor: pointer;"
                                data-bs-target='#update-appointment-{{ $appt->id }}' data-bs-toggle='modal'
                                class="badge 
                                @if ($appt->status == 'Confirmed') bg-success 
                                @elseif($appt->status == 'Pending') bg-warning text-dark 
                                @else bg-secondary @endif">
                                {{ ucfirst($appt->status) }}
                            </span>
                            <a href="{{ route('patient-details-view', ['id' => $appt->patient_id]) }}"
                                class="text-secondary ms-2 me-1" title="View patient information" target="_blank">
                                <i class="fas fa-eye"></i>
                            </a>
                            {{-- <a href="#" class="text-secondary me-1" title="Edit"><i class="fas fa-edit"></i></a> --}}
                            <a href="#" class="text-secondary" title="Cancel"><i class="fas fa-archive"></i></a>
                            <span class="badge" data-bs-target="#scheduleFollowupModal-{{ $appt->id }}" data-bs-toggle="modal" title="add notes"><i class="fas fa-sticky-note text-secondary"></i></span>
                        </div>
                    </div>
                    @include('modals.patient-appointment-update-modal')
                    @empty
                    <div class="text-center text-muted py-4">No appointments found.</div>
                    @endforelse
            </div>@include('modals.schedule-followup-modal', ['apptId' => $appt->id])
            <div class="row align-items-center mt-3">

    <!-- Image -->
    <div class="col-sm-4 text-center">
        <img src="{{ asset('images/mouth.png') }}" alt="Tooth chart" style="width: 100%; max-width: 250px;">
    </div>

    <!-- Tooth Lists -->
    <div class="col-sm-8">
        <!-- Upper teeth -->
        <h6>Upper Teeth (Maxillary)</h6>
        <ul class="mb-3" style="columns: 2;">
            <li>1 – Third molar (wisdom tooth)</li>
            <li>2 – Second molar</li>
            <li>3 – First molar</li>
            <li>4 – Second premolar (bicuspid)</li>
            <li>5 – First premolar (bicuspid)</li>
            <li>6 – Canine (cuspid)</li>
            <li>7 – Lateral incisor</li>
            <li>8 – Central incisor</li>
            <li>9 – Central incisor</li>
            <li>10 – Lateral incisor</li>
            <li>11 – Canine (cuspid)</li>
            <li>12 – First premolar (bicuspid)</li>
            <li>13 – Second premolar (bicuspid)</li>
            <li>14 – First molar</li>
            <li>15 – Second molar</li>
            <li>16 – Third molar (wisdom tooth)</li>
        </ul>

        <!-- Lower teeth -->
        <h6>Lower Teeth (Mandibular)</h6>
        <ul style="columns: 2;">
            <li>17 – Third molar (wisdom tooth)</li>
            <li>18 – Second molar</li>
            <li>19 – First molar</li>
            <li>20 – Second premolar (bicuspid)</li>
            <li>21 – First premolar (bicuspid)</li>
            <li>22 – Canine (cuspid)</li>
            <li>23 – Lateral incisor</li>
            <li>24 – Central incisor</li>
            <li>25 – Central incisor</li>
            <li>26 – Lateral incisor</li>
            <li>27 – Canine (cuspid)</li>
            <li>28 – First premolar (bicuspid)</li>
            <li>29 – Second premolar (bicuspid)</li>
            <li>30 – First molar</li>
            <li>31 – Second molar</li>
            <li>32 – Third molar (wisdom tooth)</li>
        </ul>
    </div>
</div>

        </div>
    </div>
@endsection
