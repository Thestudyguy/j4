<!-- View Note Modal -->
<div class="modal fade" id="viewNoteModal-{{ $appt->note_id }}" tabindex="-1" aria-labelledby="viewNoteLabel-{{ $appt->note_id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-3">
      
      <div class="modal-header bg-light">
  <div class="d-flex flex-column">
    <h5 class="modal-title fw-semibold mb-0" id="viewNoteLabel-{{ $appt->note_id }}">
      📝 Note Details
    </h5>
    @if (Auth::user()->Role !== 'Dentist')
    <span class="text-muted small">{{$appt->title}}. {{$appt->dfName}},  {{$appt->dlname}}. {{$appt->dmname ?? ''}}</span>
    @endif
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

      <div class="modal-body">
        <div class="row g-3">

          <div class="col-md-6">
            <div class="border rounded p-3 bg-white h-100">
              <h6 class="fw-bold mb-2 text-primary">Appointment Info</h6>
              <p class="mb-1"><strong>Date:</strong> {{ $appt->note_date ?? '—' }}</p>
              <p class="mb-1"><strong>Tooth #:</strong> {{ $appt->Tooth ?? '—' }}</p>
              <p class="mb-0"><strong>Procedure:</strong> {{ $appt->Procedure ?? '—' }}</p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="border rounded p-3 bg-white h-100">
              <h6 class="fw-bold mb-2 text-success">Financial</h6>
              <p class="mb-1"><strong>Amount Charged:</strong> ₱{{ number_format($appt->AmountCharge, 2) }}</p>
              <p class="mb-1"><strong>Amount Paid:</strong> ₱{{ number_format($appt->AmountPaid, 2) }}</p>
              <p class="mb-0"><strong>Balance:</strong> ₱{{ number_format($appt->Balance, 2) }}</p>
            </div>
          </div>

          <div class="col-12">
            <div class="border rounded p-3 bg-light">
              <h6 class="fw-bold mb-2 text-dark">Post-Op Notes</h6>
              <p class="mb-0">{{ $appt->PostOpNotes ?? '—' }}</p>
            </div>
          </div>

          <div class="col-12">
            <div class="border rounded p-3 bg-light">
              <h6 class="fw-bold mb-2 text-dark">Important Notes</h6>
              <p class="mb-0 text-danger">{{ $appt->ImportantNotes ?? '—' }}</p>
            </div>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
