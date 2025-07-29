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
                        @foreach ($subServices as $services)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm service-card" data-id="{{ $services->id }}">
                                    <img src="{{ asset('storage/' . $services->image_path) }}"
                                        class="card-img-top img-fluid rounded-top" alt="{{ $services->Service }}">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $services->Service }}</h5>
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
                        @foreach ($doctors as $doctor)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm doctor-card" data-id="{{ $doctor->id }}">
                                    <img src="{{ asset($doctor->image_path) }}" class="card-img-top img-fluid rounded-top"
                                        alt="{{ $doctor->FirstName }}" style="height: 250px; object-fit: contain;">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">
                                            {{ $doctor->ProfessionalTitle ?? '' }} {{ $doctor->FirstName }}
                                            {{ $doctor->MiddleName ?? '' }} {{ $doctor->LastName }}
                                        </h5>
                                        <p class="text-muted mb-0">{{ $doctor->AreaOfExpertise ?? 'Dentist' }}</p>
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
@endsection