<div class="modal fade" id="update-patient-appointment-{{ $appt->apptID }}" data-bs-backdrop="static">
    <div class="modal-dialog modal-center">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="fw-bold">Update Appointment</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                {{-- Display current appointment info --}}
                <div class="mb-3">
                    <p class="mb-1"><strong>Patient:</strong> {{ $appt->FirstName }} {{ $appt->LastName }}</p>
                    <p class="mb-1"><strong>Service:</strong> {{ $appt->Service }}</p>
                    <!-- <p class="mb-1"><strong>Email:</strong> {{ $appt->Email }}</p> -->
                    <p class="mb-1"><strong>Date:</strong> {{ \Carbon\Carbon::parse($appt->date)->format('F d, Y') }}</p>
                    <p class="mb-3"><strong>Time:</strong> {{ \Carbon\Carbon::parse($appt->time)->format('h:i A') }}</p>
                </div>

                {{-- Select update option --}}
                <div class="mb-3">
                   <form action="" class="appointment-updation-admin-shit">
                     <label for="appointment-update" class="form-label">Update Status</label>
                    <select name="appointment_update" class="form-control rounded-0 patient-appointment-update">
                        <option value="" selected hidden value="{{ $appt->status }}">{{ $appt->status }}</option>
                        <option value="Cancel" class="fw-semibold text-danger">Cancel</option>
                        <option value="Reschedule" class="fw-semibold text-info">Reschedule</option>
                        <option value="Confirm" class="fw-semibold text-primary">Confirm</option>
                        <option value="Completed" class="fw-semibold text-success">Completed</option>
                    </select>
                    <input type="hidden" name="email" value="{{ $appt->Email }}">
                    <input type="hidden" name="fname" value="{{ $appt->FirstName }}">
                    <input type="hidden" name="lname" value="{{ $appt->LastName }}">
                    <input type="hidden" name="refid" value="{{ $appt->refID }}">
                    <input type="hidden" name="date" value="{{ $appt->date }}">
                    <input type="hidden" name="time" value="{{ $appt->time }}">
                    <input type="hidden" name="apptid" value="{{ $appt->apptID }}">
                    <input type="hidden" name="service" value="{{ $appt->Service }}">
                   </form>
                </div>

                {{-- You can show a date and time picker here if Reschedule is selected using JS --}}
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary update-appointment rounded-0">Update</button>
                <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
