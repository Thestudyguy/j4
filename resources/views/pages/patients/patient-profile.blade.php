@extends('dashboard')

@section('content')
    <div class="container-fluid pt-5 bg-light">
        <div class="appointment-loader-container visually-hidden">
            <div class="appointment-loader"></div>
        </div>
        @if (Auth::check() && Auth::user()->is_first_login && Auth::user()->Role === 'patient')
            <h1 class="fw-bold mt-2 ug makita animal nani">My Profile</h1>
            <div class="container h-100">
                <div class="row m-2">
                    <div class="alert alert-warning">
                        Please complete your account setup before making an appointment.
                    </div>
                    <div class="col-sm-12 patient-setup patient-setup-step-1">
                        @include('components.client-appointment-form-personal-info')
                    </div>
                    <div class="col-sm-12 patient-setup patient-setup-step-2 visually-hidden">
                        @include('components.client-appointment-form-medical-history')
                    </div>
                    <div class="col-sm-12 patient-setup patient-setup-step-3 visually-hidden">
                        <center><img class="brand-image" src="{{ asset('images/dclogo.png') }}" alt=""
                                style="width: 50%"></center>
                        @include('pages.patients.patient-personal-info-preview')
                        @include('pages.patients.patient-history-preview')
                    </div>
                </div>
            </div>
            <div class="col-sm-12 d-flex justify-content-end align-items-end mb-3">
                <button
                    class="visually-hidden btn-secondary mx-1 btn-sm fw-semibold lead patient-account-setup-back-btn">Back</button>
                <button class="btn-info btn-sm fw-semibold lead patient-account-setup-next-btn">Next</button>
                {{-- hidden button for terms and condition. Why hide it in the first place? cause fuck you thats why --}}
                <button class="btn btn-primary visually-hidden terms-and-condition" data-bs-toggle='modal'
                    data-bs-target="#termsModal"></button>
                @include('modals.terms-and-conditions')
                <button class="visually-hidden btn-primary btn-sm fw-semibold lead patient-account-setup-finish-btn"
                    id="acceptTermsButton">Finish</button>
            </div>
        @endif

        @if (Auth::check() &&
                !Auth::user()->is_setup_complete &&
                !Auth::user()->is_first_login &&
                Auth::user()->Role === 'patient')
            <form id="appointment-form">
                @csrf
                <input type="hidden" name="selected_date" id="selected_date">
                <input type="hidden" name="selected_time" id="selected_time">
                <input type="hidden" name="selected_doctor_id" id="selected_doctor_id">
                <input type="hidden" name="selected_service_id" id="selected_service_id">
            </form>


            <div class="">
                {{-- uncomment later --}}
                <div class="appointment-step appointment-prep-step-1">
                    <div class="container py-5">
                        <h2 class="fw-bold mb-4 text-center" style="color: #063D58;">Book a Dental Appointment</h2>
                        <div class="row mb-5">
                            <div class="col-md-6 mb-4">
                                <div class="text-dark text-start fw-semibold">
                                    Select a Date
                                </div>
                                <center>
                                    <div class="card-body" id="calendar-container"></div>
                                </center>
                            </div>
                            <div class="col-md-6 mb-4">
                                <span id="selected-date-title">Select a date to see available slots</span>
                                <div id="time-slots" class="row g-2"></div>
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

                        {{-- @foreach ($subServices as $services)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm service-card" data-id="{{ $services->id }}">
                                    <img src="{{ asset('storage/' . $services->image_path) }}"
                                        class="card-img-top img-fluid rounded-top" alt="{{ $services->Service }}">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $services->Service }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach --}}
                    </div>
                </div>

                {{-- Available Doctors --}}
                <div class="appointment-step appointment-prep-step-3 visually-hidden">
                    <h4 class="fw-semibold mb-3 text-secondary">Our Dentists</h4>
                    <div class="row">
                        @foreach ($availableDoctors as $item)
                            @php
                                $doctor = $item['dentist'];
                                $offsched = $item['off_sched'];
                            @endphp
                            <div class="col-md-3 mb-3">
                                <div class="card h-100 shadow-sm doctor-card" data-id="{{ $doctor->id }}"
                                    data-offsched='@json($offsched, JSON_HEX_APOS | JSON_HEX_QUOT)'>

                                    <div class="row g-0">
                                        {{-- Image on the left --}}
                                        <div class="col-4 d-flex justify-content-center align-items-center p-2">
                                            <img src="{{ asset($doctor->image_path) }}" class="img-fluid rounded"
                                                alt="{{ $doctor->FirstName }}"
                                                style="max-height: 100%; object-fit: contain;">
                                        </div>

                                        {{-- Details on the right --}}
                                        <div class="col-8">
                                            <div class="card-body p-2 text-start">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h6 class="card-title mb-1 fw-bold">
                                                            {{ $doctor->ProfessionalTitle ?? '' }}
                                                            {{ $doctor->FirstName }} {{ $doctor->MiddleName ?? '' }}
                                                            {{ $doctor->LastName }}
                                                        </h6>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <p class="text-muted small mb-1">
                                                            {{ $doctor->AreaOfExpertise ?? 'Dentist' }}</p>

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
            </div>
        @endif



    </div>
@endsection
