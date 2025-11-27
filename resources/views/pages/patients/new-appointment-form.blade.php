@extends('dashboard')
@section('content')
    <div class="container p-5 mt-5">
        <div class="row">
            <form id="appointment-form">
                @csrf
                <input type="hidden" name="selected_date" id="selected_date">
                <input type="hidden" name="selected_time" id="selected_time">
                <input type="hidden" name="selected_doctor_id" id="selected_doctor_id">
                <input type="hidden" name="selected_service_id" id="selected_service_id">
                <input type="hidden" name="selected_service_id" id="selected_service_id">
                @if (Auth::user()->Role !== 'patient')
                    schedule an appointment for this patient
                @endif
                {{-- <input type="hidden" name="patient_id" id="patient_id" value="{{Auth::user()->Role === 'patient' ? Auth::user()->id : ''}}"> --}}
            </form>


            <div class="">
                <div class="appointment-step appointment-prep-step-1">
                    <div class="container py-5">
                        <h2 class="fw-bold mb-4 text-center text-primary">Book a Dental Appointment</h2>

                        {{-- Calendar and Time Slots --}}
                        <div class="row mb-5">
                            <div class="col-md-6 mb-4">
                                <!-- <div class="card"> -->
                                <div class="text-dark text-start fw-semibold">
                                    Select a Date
                                </div>
                                <center>
                                    <div class="card-body" id="calendar-container"></div>
                                </center>
                                <!-- </div> -->
                            </div>
                            <div class="col-md-6 mb-4">
                                <!-- <div class="card shadow-sm h-100"> -->
                                <!-- <div class="card-header bg-primary text-white text-center fw-semibold"> -->
                                <span id="selected-date-title">Select a date to see available slots</span>
                                <!-- </div> -->
                                <!-- <div class="card-body"> -->
                                <div id="time-slots" class="row g-2"></div>
                                <!-- </div> -->
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Available Services --}}
                <div class="appointment-step appointment-prep-step-2 visually-hidden">
                    <h4 class="fw-semibold mb-3 text-secondary">Available Dental Services</h4>
                    <div class="row mb-5">
                        @foreach ($subServices as $service)
                            <div class="col-sm-3 mb-3">
                                <div class="card h-100 shadow-sm service-card" data-id="{{ $service->id }}">
                                    <div class="row g-0">
                                        <div class="col-4 d-flex justify-content-center align-items-center p-2">
                                            <img src="{{ asset('storage/' . $service->image_path) }}"
                                                class="img-fluid rounded" alt="{{ $service->Service }}"
                                                style="max-height: 80px; object-fit: cover;">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body p-2">
                                                <h6 class="card-title mb-1 fw-bold">{{ $service->Service }}</h6>
                                                <p class="card-text text-muted small mb-1">{{ $service->Description }}</p>
                                                <p class="card-text text-info fw-semibold mb-0">
                                                    ₱{{ number_format($service->Price, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Available Doctors --}}
                <div class="appointment-step appointment-prep-step-3 visually-hidden">
                    <h4 class="fw-semibold mb-3 text-secondary">Our Dentists</h4>
                    <div class="row">
                        {{-- @foreach ($availableDoctors as $item)
    @php
        $doctor = $item['doctor'];
        $offsched = $item['off_sched'];
    @endphp
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm doctor-card" data-id="{{ $doctor['dentistID'] }}"
             data-offsched='@json($offsched, JSON_HEX_APOS | JSON_HEX_QUOT)'>
            <img src="{{ asset($doctor['image_path']) }}" class="card-img-top img-fluid rounded-top"
                 alt="{{ $doctor['FirstName'] }}" style="height: 250px; object-fit: contain;">

            <div class="card-body text-center">
                <h5 class="card-title">
                    {{ $doctor['ProfessionalTitle'] ?? '' }} {{ $doctor['FirstName'] }}
                    {{ $doctor['MiddleName'] ?? '' }} {{ $doctor['LastName'] }}
                </h5>
                <p class="text-muted mb-0">{{ $doctor['AreaOfExpertise'] ?? 'Dentist' }}</p>
            </div>
        </div>
    </div>
@endforeach --}}

                    @foreach ($availableDoctors as $item)
                            @php
                                $doctor = $item['doctor'];
                                $offsched = $item['off_sched'];
                            @endphp
                            <div class="col-md-3 mb-3">
                                <div class="card h-100 shadow-sm doctor-card" data-id="{{ $doctor['dentistID'] }}"
                                    data-offsched='@json($offsched, JSON_HEX_APOS | JSON_HEX_QUOT)'>

                                    <div class="row g-0">
                                        {{-- Image on the left --}}
                                        <div class="col-4 d-flex justify-content-center align-items-center p-2">
                                            <img src="{{ asset($doctor['image_path']) }}" class="img-fluid rounded"
                                                alt="{{ $doctor['FirstName'] }}"
                                                style="max-height: 100%; object-fit: contain;">
                                        </div>

                                        {{-- Details on the right --}}
                                        <div class="col-8">
                                            <div class="card-body p-2 text-start">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h6 class="card-title mb-1 fw-bold">
                                                            {{-- {{ $doctor->ProfessionalTitle ?? '' }}
                                                            {{ $doctor->FirstName }} {{ $doctor->MiddleName ?? '' }}
                                                            {{ $doctor->LastName }} --}}
                                                             {{ $doctor['ProfessionalTitle'] ?? '' }}
                                                             {{ $doctor['FirstName'] }} {{ $doctor['MiddleName'] }}
                                                             {{ $doctor['LastName'] }}
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <p class="text-muted small mb-1">
                                                            {{ $doctor['AreaOfExpertise'] ?? 'Dentist' }}

                                                    </div>
                                                </div>

                                                {{-- Optional: add status or off-schedule badge --}}
                                                {{-- <span class="badge bg-warning">Off Schedule</span> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="text-center mt-4 confirm-appt-btn">
                    <button type="submit" class="btn-secondary visually-hidden text-sm fw-semibold"
                        id="back-appointment-btn">Back</button>
                    <button type="submit" class="btn-info text-sm fw-semibold" id="Next-appointment-btn">Next</button>
                    <button type="submit" class="btn-success visually-hidden text-sm fw-semibold"
                        id="confirm-appointment-btn">Confirm Appointment</button>
                </div>
                

@vite('resources/js/app.js')


            @endsection
