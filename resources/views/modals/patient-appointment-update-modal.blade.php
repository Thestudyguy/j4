<div class="modal fade" id="update-appointment-{{ $appt->id }}" data-bs-backdrop="static">
    <div class="modal-dialog modal-center">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="fw-bold">Update Appointment</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body position-relative">
                <select name="appointment-update" id="" class="form-control">
                    <option value="" selected hidden class="text-warning text-sm">{{ $appt->status }}</option>
                    <option value="Cancel" class="fw-semibold text-danger text-sm">Cancel</option>
                    <option value="reschedule" class="fw-semibold text-info text-sm">re-sched</option>
                </select>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn rounded-0"
                    style="background: #063D58; border-radius: 0px; color: whitesmoke;">{{__('Update')}}</button>
                <button type="button" class="btn btn-secondary rounded-0"
                    data-bs-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>