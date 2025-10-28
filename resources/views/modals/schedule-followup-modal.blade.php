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
                    <!-- Tooth # (text input for multiple numbers) -->
                    <div class="mb-3">
                        <label for="tooth" class="form-label fw-semibold">Tooth #</label>
                        <input type="text" class="form-control rounded-0" id="tooth" name="tooth"
                            placeholder="e.g. 1, 2, 3">
                        <small class="text-muted">Enter tooth numbers separated by commas</small>
                    </div>

                      <div class="mb-3">
                        <label for="tooth" class="form-label fw-semibold">Procedure</label>
                        <input type="text" class="form-control rounded-0" id="procedure" name="procedure">
                    </div>

                    <!-- Amounts -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="amount_charge" class="form-label fw-semibold">Amount Charge</label>
                            <input type="text" class="form-control rounded-0" id="amount_charge" oninput="formatValueInput(this)"
                                name="amount_charge">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="amount_paid" class="form-label fw-semibold">Amount Paid</label>
                            <input type="text" class="form-control rounded-0" oninput="formatValueInput(this)" id="amount_paid" name="amount_paid">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="balance" class="form-label fw-semibold">Balance</label>
                            <input type="text" class="form-control rounded-0"oninput="formatValueInput(this)" id="balance" name="balance">
                        </div>
                    </div>

                    <!-- Post-op Notes -->
                    <div class="mb-3">
                        <label for="post_op_notes" class="form-label fw-semibold">Post-op Notes</label>
                        <textarea class="form-control rounded-0" id="post_op_notes" name="post_op_notes" rows="2"></textarea>
                    </div>

                    <!-- Important Notes -->
                    <div class="mb-3">
                        <label for="important_notes" class="form-label fw-semibold">Important Notes</label>
                        <textarea class="form-control rounded-0" id="important_notes" name="important_notes" rows="2"></textarea>
                    </div>

                    <!-- Dentist -->
                    {{-- <div class="mb-3">
                        <label for="dentist" class="form-label fw-semibold">Dentist</label>
                        <input type="text" class="form-control rounded-0" value="{{ Auth::user()->FirstName }} {{ Auth::user()->LastName }}" id="dentist" name="dentist">
                    </div> --}}
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
