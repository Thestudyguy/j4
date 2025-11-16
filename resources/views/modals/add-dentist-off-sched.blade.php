<div class="modal fade" id="dentist-offsched" data-bs-backdrop="static">
    <div class="modal-dialog modal-center modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header d-flex flex-column align-items-start pb-2">

                <h4 class="fw-bold mb-0">Add Dentist Off Schedule</h4>

                <small class="text-muted mb-2">
                    Dentist: {{ $doctor->FirstName }} {{ $doctor->LastName }}
                </small>

                <!-- Aesthetic info note -->
                <div class="alert alert-info py-1 px-2 small mb-0 mt-1 w-100"
                    style="font-size: 0.75rem; border-left: 3px solid #0d6efd;">
                    By not selecting a time, you are assigning the dentist a full-day off schedule.
                </div>

                <button type="button" class="btn-close position-absolute end-0 top-0 m-3"
                    data-bs-dismiss="modal"></button>
            </div>


            <div class="modal-body position-relative">
                <div class="container">

                    <!-- Calendar -->
                    <div id="calendar" class="mb-3"></div>

                    <!-- Selected date display -->
                    <div id="selected-date" class="fw-bold text-primary mb-2 d-none"></div>

                    <!-- Time slots grid -->
                    <div id="time-slots" class="row g-2"></div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn save-dentist-offsched rounded-0" data-dentistid="{{ $doctor->id }}"
                    style="background: #063D58; border-radius: 0px; color: whitesmoke;">{{ __('Save') }}</button>
                <button type="button" class="btn btn-secondary rounded-0"
                    data-bs-dismiss="modal">{{ __('Cancel') }}</button>
            </div>
        </div>
    </div>
</div>
