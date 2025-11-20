<div class="modal fade" id="client-appointment-{{ $appt->refID }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold text-dark">{{ __('Complete Appointment') }}</h5>
                    <p class="text-muted small mb-0">
                        {{ __('Marking this appointment as completed will finalize the record.') }}
                    </p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            {{-- BODY --}}
            <div class="modal-body text-dark">

                {{-- Appointment Details Box --}}
                <div class="p-3 bg-light rounded-3 mb-3 border">
                    <p class="mb-1">
                        <strong>Client:</strong> {{ $appt->FirstName }} {{ $appt->LastName }}
                    </p>

                    <p class="mb-1">
                        <strong>Service:</strong> {{ $appt->service }}
                    </p>

                    <p class="mb-1">
                        <strong>Dentist:</strong>
                        {{ $appt->title }} {{ $appt->dfName }} {{ $appt->dlname }}
                    </p>

                    <p class="mb-1">
                        <strong>Date:</strong> {{ $appt->Date }}
                    </p>

                    <p class="mb-0">
                        <strong>Time:</strong> {{ $appt->Time }}
                    </p>
                </div>


                {{-- Amount Input --}}
                <label class="fw-semibold small mb-1">Amount Paid</label>
                <input type="text" oninput="formatValueInput(this)" step="0.01" min="0" id="finalise-amount" name="finalise-amount"
                    class="form-control rounded-0 animalt" placeholder="Enter amount">
            </div>

            {{-- FOOTER --}}
            <div class="modal-footer border-0">
                <button type="submit" class="btn btn-primary fw-bold finalise-appt rounded-0 px-4 id={{$appt->id}}" id="{{$appt->id}}" data-refid="{{ $appt->refID }}">
                    {{ __('Submit') }}
                </button>
                <button type="button" class="btn btn-secondary fw-bold rounded-0" data-bs-dismiss="modal">
                    {{ __('Close') }}
                </button>
            </div>

        </div>
    </div>
</div>
