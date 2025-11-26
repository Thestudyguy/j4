<!-- Follow-up / Operation Scheduling Modal -->
<div class="modal fade" id="scheduleFollowupModal-{{$appt->id}}" tabindex="-1" aria-labelledby="scheduleFollowupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-3 shadow-sm">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-semibold mb-1" id="scheduleFollowupLabel">Schedule Follow-Up</h5>
                    <p class="small text-muted mb-0">Add any notes or details about the patient’s follow-up or
                        procedure.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="pt-apt-nts-{{$appt->id}}">
                  @csrf
                    <!-- Date -->
                    <div class="mb-3">
                        <label for="date" class="form-label fw-semibold">Date</label>
                        <input type="date" class="form-control rounded-0" id="date" name="date"
                            value="{{ date('Y-m-d') }}">
                    </div>
                    <input type="hidden" name="dentist-id" value=" {{$dentist->id}}">
                    <input type="hidden" name="appointment-id" value="{{$appt->id}}">
                    <input type="hidden" name="patient-email" value="{{$appt->Email}}">
                    <!-- Post-op Notes -->
                    <div class="mb-3">
                        <label for="post_op_notes" class="form-label fw-semibold">Note</label>
                        <textarea class="form-control rounded-0" id="note" name="note" rows="2"></textarea>
                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm small btn-secondary rounded-2"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm small btn-primary rounded-2 save-nts">Save Changes</button>
            </div>
        </div>
    </div>
</div>
