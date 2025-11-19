<div class="modal fade" id="schedule-patient-appointment-{{$first->refID}}" data-bs-backdrop="static">
    <div class="modal-dialog modal-center modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header flex-column align-items-center border-0 pb-0">
    <button type="button" class="btn-close align-self-end mb-2" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="d-flex align-items-center mb-2">
        <i class="fas fa-calendar-check text-primary me-2"></i>
        <h5 class="fw-semibold text-center mb-0">Schedule an Appointment for:</h5>
    </div>
    <p class="fw-semibold text-dark mb-0">
        {{ $first->FirstName . ' ' . $first->LastName }}
    </p>
</div>


            <div class="modal-body position-relative">
                <div class="">
                    <div class="row">
                        <form id="scheduled-patient-appointment">
                            @csrf
                            <input type="hidden" name="scheduled_appt_selected_date" id="scheduled_appt_selected_date">
                            <input type="hidden" name="scheduled_appt_selected_time" id="scheduled_appt_selected_time">
                            <input type="hidden" name="scheduled_appt_selected_doctor_id" id="scheduled_appt_selected_doctor_id">
                            <input type="hidden" name="scheduled_appt_selected_service_id" id="scheduled_appt_selected_service_id">
                            <input type="hidden" name="scheduled_appt_patient_id" id="scheduled_appt_patient_id" value="{{$first->refID}}">
                        </form>


                        <div class="">
                            <div class="scheduled-appointment-step scheduled-appointment-prep-step-1">
                                <div class="container py-5">

                                    {{-- Calendar and Time Slots --}}
                                    <div class="row mb-5">
                                        <div class="col-md-6 mb-4">
                                            <!-- <div class="card"> -->
                                            <div class="text-dark text-start fw-semibold">
                                                Select a Date
                                            </div>
                                            <center>
                                                <div class="card-body" id="scheduled-calendar-container"></div>
                                            </center>
                                            <!-- </div> -->
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <!-- <div class="card shadow-sm h-100"> -->
                                            <!-- <div class="card-header bg-primary text-white text-center fw-semibold"> -->
                                            <span id="scheduled-selected-date-title">Select a date to see available slots</span>
                                            <!-- </div> -->
                                            <!-- <div class="card-body"> -->
                                            <div id="scheduled-time-slots" class="row g-2"></div>
                                            <!-- </div> -->
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Available Services --}}
                            <div class="scheduled-appointment-step scheduled-appointment-prep-step-2 visually-hidden">
                                <h4 class="fw-semibold mb-3 text-secondary">Available Dental Services</h4>
                                <div class="row mb-5">
                                    @foreach ($subServices as $services)
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100 shadow-sm scheduled-appt-service-card"
                                                data-id="{{ $services->id }}">
                                                <img src="{{ asset('storage/' . $services->image_path) }}"
                                                    class="card-img-top img-fluid rounded-top"
                                                    alt="{{ $services->Service }}">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title">{{ $services->Service }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Available Doctors --}}
                            <div class="scheduled-appointment-step scheduled-appointment-prep-step-3 visually-hidden">
                                <h4 class="fw-semibold mb-3 text-secondary">Our Dentists</h4>
                                <div class="row">
                                    @foreach ($availableDoctors as $item)
    @php
        $doctor = $item['doctor'];       // the doctor info
        $offsched = $item['off_sched'];  // the off-schedule array
    @endphp
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm scheduled-appt-doctor-card" 
             data-id="{{ $doctor['dentistID'] }}" 
             data-offsched='@json($offsched, JSON_HEX_APOS | JSON_HEX_QUOT)'>
            <img src="{{ asset($doctor['image_path']) }}" 
                 class="card-img-top img-fluid rounded-top" 
                 alt="{{ $doctor['FirstName'] }}" 
                 style="height: 250px; object-fit: contain;">
            <div class="card-body text-center">
                <h5 class="card-title">
                    {{ $doctor['ProfessionalTitle'] ?? '' }} {{ $doctor['FirstName'] }}
                    {{ $doctor['MiddleName'] ?? '' }} {{ $doctor['LastName'] }}
                </h5>
                <p class="text-muted mb-0">{{ $doctor['AreaOfExpertise'] ?? 'Dentist' }}</p>
            </div>
        </div>
    </div>
@endforeach


                                </div>
                            </div>
                            {{-- <div class="text-center mt-4 confirm-appt-btn">
                                <button type="submit" class="btn-secondary visually-hidden text-sm fw-semibold"
                                    id="back-appointment-btn">Back</button>
                                <button type="submit" class="btn-info text-sm fw-semibold"
                                    id="Next-appointment-btn">Next</button>
                                <button type="submit" class="btn-success visually-hidden text-sm fw-semibold"
                                    id="confirm-appointment-btn">Confirm Appointment</button>
                            </div> --}}

                        </div>
                        <div class="modal-footer">
                            <button type="" class="btn btn-primary patient-scheduled-appt-btn fw-semibold btn-sm rounded-0">
                                {{ __('Next') }}
                            </button>
                            <button class="btn btn-secondary scheduled-appt-bck-btn fw-semibold btn-sm visually-hidden rounded-0">Back</button>
                            <button type="button" class="btn btn-secondary rounded-0 fw-semibold btn-sm"
                            data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button class="btn btn-secondary scheduled-appt-finish-btn fw-semibold btn-sm visually-hidden rounded-0">Confirm Appointment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
