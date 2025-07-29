<div class="modal fade" id="patient-services-{{ $first->refID }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">
                    Services Availed by 
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

              <div class="modal-body">
                <ul class="list-group list-group-flush">
                    @foreach ($appointments as $appt)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Service:</strong> {{ $appt->Service }}<br>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($appt->date)->format('F j, Y') }} at {{ \Carbon\Carbon::parse($appt->time)->format('g:i A') }}</small>
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ ucfirst($appt->status) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
