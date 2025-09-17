<div class="modal fade patient-update-appt-modal" id="update-appointment-{{ $appt->id  ?? ''}}" data-bs-backdrop="static">
    <div class="loader-container update-appointment-modal visually-hidden">
        <div class="loader"></div>
    </div>  
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-0 shadow">
            <div class="modal-header text-dark">
                <h5 class="modal-title fw-bold">Update Appointment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="">
                @csrf
                <input type="hidden" name="appt_id_update" value="{{$appt->id ?? ''}}" id="update_appt_{{$appt->id ?? ''}}">
                <input type="hidden" name="update_selected_date" id="update_selected_date_{{ $appt->id  ?? ''}}">
                <input type="hidden" name="update_selected_time" id="update_selected_time_{{ $appt->id  ?? ''}}">
            </form>
            <div class="modal-body">
                <!-- Appointment Details -->
                <div class="p-3 mb-4 border rounded bg-light">
                    <h6 class="fw-bold text-primary mb-3">Appointment Details</h6>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <span class="fw-semibold">Date:</span> 
                            <span class="apptDate">{{ $appt->Date  ?? ''}}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <span class="fw-semibold">Time:</span> 
                            <span class="apptTime">{{ $appt->Time  ?? ''}}</span>
                        </div>
                        {{-- https://ph.smartapply.indeed.com/beta/indeedapply/form/questions-module/questions/2 --}}
                        <div class="col-md-6 mb-2">
                            <span class="fw-semibold">Service:</span> 
                            <span class="apptService">{{ $appt->service  ?? ''}}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <span class="fw-semibold">Dentist:</span> 
                            <span class="apptDentist">{{ $appt->title  ?? ''}} {{ $appt->dfName  ?? ''}} {{ $appt->dlname  ?? ''}}</span>
                        </div>
                        {{-- <div class="col-md-6 mb-2">
                            <span class="fw-semibold">Status:</span> 
                            <span>{{ $appt->status }}</span>
                        </div> --}}
                    </div>
                </div>

                <!-- Update Selection -->
                <div class="mb-4">
                    <label class="fw-semibold mb-2">Update Action</label>
                    <select name="appointment-update-selection" class="form-select appointment-update-selection">
                        <option value="" class="stat-opt" selected hidden>{{ $appt->status  ?? ''}}</option>
                        <option value="Completed" class="text-success fw-semibold">Completed</option>
                        {{-- <option value="Cancel" class="text-danger fw-semibold">Cancel</option> --}}
                        <option value="cancel" class="text-danger fw-semibold">Cancel</option>
                        <option value="reschedule" class="text-info fw-semibold">Reschedule</option>
                    </select>
                </div>

                <div class="date-picker-update visually-hidden">
                     <div class="row mb-5">
                            <div class="col-md-6 mb-4">
                                <div class="text-dark text-start fw-semibold">
                                    Select a Date
                                </div>
                                <center>
                                    <div class="card-body date-container-update" id="calendar-container-update-{{ $appt->id  ?? ''}}"></div>
                                </center>
                            </div>
                            <div class="col-md-6 mb-4">
                                <span id="selected-date-title-update">Select a date to see available slots</span>
                                <div id="time-slots-update-{{ $appt->id  ?? ''}}" class="row g-2 time-slots-update-prep"></div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary rounded-0 px-4 update-appt" data-id='{{$appt->id ?? ''}}'>Update</button>
                <button type="button" class="btn btn-secondary rounded-0 px-4" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
