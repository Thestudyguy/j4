@extends('dashboard')

@section('content')
<div class="container-fluid pt-5 bg-light">
    <div class="container py-4">

        <h3 class="fw-bold mb-4">Patient Medical Historyssss</h3>
        @if($patientHistory)
            {{-- Patient Info --}}
                    {{-- <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
    {{ strtoupper(substr($patientInfo->FirstName,0,1) . substr($patientInfo->LastName,0,1)) }}
</div> --}}
<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-body d-flex align-items-center">
        {{-- Avatar --}}
        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
            {{ strtoupper(substr($patientInfo->FirstName,0,1) . substr($patientInfo->LastName,0,1)) }}
        </div>

        {{-- Patient Info --}}
        <div class="flex-grow-1">
            <h5 class="mb-2 fw-bold">{{ $patientInfo->FirstName }} {{ $patientInfo->LastName }}</h5>

            <div class="row text-muted">
                <div class="col-sm-6 mb-1">
                    <span class="fw-semibold">Mobile:</span> {{ $patientInfo->MobileNo ?? 'N/A' }}
                </div>
                <div class="col-sm-6 mb-1">
                    <span class="fw-semibold">Email:</span> {{ $patientInfo->Email ?? 'N/A' }}
                </div>
                <div class="col-sm-6 mb-1">
                    <span class="fw-semibold">Home No.:</span> {{ $patientInfo->HomeNo ?? 'N/A' }}
                </div>
                <div class="col-sm-6 mb-1">
                    <span class="fw-semibold">Address:</span> {{ $patientInfo->Address ?? 'N/A' }}
                </div>
            </div>
        </div>
    </div>
</div>


            {{-- Sections --}}
            <div class="row g-4">
                {{-- Previous Dentist --}}
                <div class="col-md-6">
                    <div class="card shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white fw-bold text-primary">Previous Dentist</div>
                        <div class="card-body">
                            <p class="mb-1"><span class="fw-semibold">Dentist:</span> {{ $patientHistory->previous_dentist ?? '—' }}</p>
                            <p class="mb-0"><span class="fw-semibold">Last Visit:</span> {{ $patientHistory->last_visit ?? '—' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Physician Info --}}
                <div class="col-md-6">
                    <div class="card shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white fw-bold text-primary">Physician Info</div>
                        <div class="card-body">
                            <p class="mb-1"><span class="fw-semibold">Name:</span> {{ $patientHistory->physician_name ?? '—' }}</p>
                            <p class="mb-1"><span class="fw-semibold">Specialty:</span> {{ $patientHistory->physician_specialty ?? '—' }}</p>
                            <p class="mb-1"><span class="fw-semibold">Office Address:</span> {{ $patientHistory->physician_office_address ?? '—' }}</p>
                            <p class="mb-0"><span class="fw-semibold">Office No:</span> {{ $patientHistory->physician_office_no ?? '—' }}</p>
                        </div>
                    </div>
                </div>

                {{-- General Medical Status --}}
                <div class="col-md-6">
                    <div class="card shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white fw-bold text-primary">General Medical Status</div>
                        <div class="card-body">
                            <p class="mb-1"><span class="fw-semibold">Good Health:</span> {{ $patientHistory->good_health ?? '—' }}</p>
                            <p class="mb-1"><span class="fw-semibold">Uses Drugs:</span> {{ $patientHistory->uses_drugs ?? '—' }}</p>
                            <p class="mb-0"><span class="fw-semibold">Under Medical Care:</span> {{ $patientHistory->under_medical_care ?? '—' }}</p>
                            @if($patientHistory->medical_condition_text)
                                <p class="mt-2 text-muted"><em>{{ $patientHistory->medical_condition_text }}</em></p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Surgery --}}
                <div class="col-md-6">
                    <div class="card shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white fw-bold text-primary">Surgical History</div>
                        <div class="card-body">
                            <p class="mb-1"><span class="fw-semibold">Had Surgery:</span> {{ $patientHistory->had_surgery ?? '—' }}</p>
                            @if($patientHistory->surgery_text)
                                <p class="mt-2 text-muted"><em>{{ $patientHistory->surgery_text }}</em></p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Special Conditions --}}
                <div class="col-md-6">
                    <div class="card shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white fw-bold text-primary">Special Conditions</div>
                        <div class="card-body">
                            <p class="mb-1"><span class="fw-semibold">Pregnant:</span> {{ $patientHistory->pregnant ?? '—' }}</p>
                            <p class="mb-1"><span class="fw-semibold">Nursing:</span> {{ $patientHistory->nursing ?? '—' }}</p>
                            <p class="mb-0"><span class="fw-semibold">Birth Control:</span> {{ $patientHistory->taking_birth_control ?? '—' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Medications & Tobacco --}}
                <div class="col-md-6">
                    <div class="card shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white fw-bold text-primary">Medications & Tobacco</div>
                        <div class="card-body">
                            <p class="mb-1"><span class="fw-semibold">Taking Medications:</span> {{ $patientHistory->taking_medications ?? '—' }}</p>
                            @if($patientHistory->medications_details)
                                <p class="mt-2 text-muted"><em>{{ $patientHistory->medications_details }}</em></p>
                            @endif
                            <p class="mb-0"><span class="fw-semibold">Using Tobacco:</span> {{ $patientHistory->using_tobacco ?? '—' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Allergies --}}
                <div class="col-md-6">
                    <div class="card shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white fw-bold text-primary">Allergies</div>
                        <div class="card-body">
                            <p class="mb-1"><span class="fw-semibold">Allergy:</span> {{ $patientHistory->allergy ?? '—' }}</p>
                            @if($patientHistory->allergy_others)
                                <p class="mt-2 text-muted"><em>{{ $patientHistory->allergy_others }}</em></p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Known Conditions --}}
                <div class="col-md-6">
                    <div class="card shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white fw-bold text-primary">Known Conditions</div>
                        <div class="card-body">
                            @if ($patientHistory->known_conditions)
                                @foreach (json_decode($patientHistory->known_conditions, true) as $condition)
                                    <span class="badge bg-light border text-dark rounded-pill px-3 py-2 me-1 mb-2">{{ $condition }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Blood Information --}}
                <div class="col-md-6">
                    <div class="card shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white fw-bold text-primary">Blood Information</div>
                        <div class="card-body">
                            <p class="mb-1"><span class="fw-semibold">Blood Type:</span> {{ $patientHistory->blood_type ?? '—' }}</p>
                            <p class="mb-0"><span class="fw-semibold">Blood Pressure:</span> {{ $patientHistory->blood_pressure ?? '—' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="alert alert-warning">No medical history found for this patient.</div>
        @endif

    </div>
</div>
@endsection
