<!-- Improved View Note Modal -->
<div class="modal fade" id="viewNoteModal-{{ $appt->note_id }}" tabindex="-1" aria-labelledby="viewNoteLabel-{{ $appt->note_id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-3 shadow">

            <!-- MODAL HEADER -->
            <div class="modal-header bg-primary text-white">
                <div class="d-flex flex-column">
                    <h5 class="modal-title fw-semibold" id="viewNoteLabel-{{ $appt->note_id }}">
                        📝 Appointment Note
                    </h5>

                    @if (Auth::user()->Role !== 'Dentist')
                        <small class="opacity-75">
                            {{ $appt->title }} {{ $appt->dfname }} {{ $appt->dlname }} {{ $appt->dmname ?? '' }}
                        </small>
                    @endif
                </div>

                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- MODAL BODY -->
            <div class="modal-body">

                <div class="row g-3">

                    <!-- APPOINTMENT INFORMATION -->
                    <div class="col-md-6">
                        <div class="border rounded p-3 bg-light h-100">
                            <h6 class="fw-bold text-primary mb-2">📅 Appointment Details</h6>
                            <p class="mb-1"><strong>Date:</strong> {{ $appt->note_date ?? '—' }}</p>
                            <p class="mb-1"><strong>Time:</strong> {{ isset($appt->Time) ? \Carbon\Carbon::parse($appt->Time)->format('g:i A') : '—' }}</p>
                            <p class="mb-1"><strong>Service:</strong> {{ $appt->service ?? '—' }}</p>
                            <p class="mb-0"><strong>Status:</strong> 
                                <span class="badge 
                                    @if ($appt->status == 'Confirmed') bg-success 
                                    @elseif($appt->status == 'Pending') bg-warning text-dark 
                                    @else bg-secondary @endif">
                                    {{ ucfirst($appt->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- PATIENT INFORMATION -->
                    <div class="col-md-6">
                        <div class="border rounded p-3 bg-white h-100">
                            <h6 class="fw-bold text-primary mb-2">🧑‍⚕️ Patient Information</h6>
                            <p class="mb-1"><strong>Name:</strong> {{ $appt->FirstName }} {{ $appt->LastName }}</p>
                            <p class="mb-1"><strong>Patient ID:</strong> {{ $appt->refID }}</p>
                            <p class="mb-0">
                                <a href="{{ route('dentist/patient/med-history', ['id' => $appt->refID]) }}" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-notes-medical text-info"></i> Medical History
                                </a>
                            </p>
                        </div>
                    </div>

                    <!-- NOTE CONTENT -->
                    <div class="col-12">
                        <div class="border rounded p-3 bg-light">
                            <h6 class="fw-bold text-primary mb-2">📝 Note Content</h6>
                            <p class="mb-0">{{ $appt->note ?? 'No note added.' }}</p>
                        </div>
                    </div>

                    <!-- OPTIONAL: NOTE META -->
                    <div class="col-12">
                        <div class="border rounded p-3 bg-white">
                            <h6 class="fw-bold text-primary mb-2">📌 Note Metadata</h6>
                            <p class="mb-1"><strong>Created By:</strong> {{ $appt->dfName }} {{ $appt->dlname }}</p>
                            <p class="mb-1"><strong>Created At:</strong> {{ $appt->created_at ? $appt->created_at->format('F d, Y g:i A') : '—' }}</p>
                            {{-- <p class="mb-0"><strong>Last Updated:</strong> {{ $appt->updated_at ? $appt->updated_at->format('F d, Y g:i A') : '—' }}</p> --}}
                        </div>
                    </div>

                </div>
            </div>

            <!-- FOOTER -->
            <div class="modal-footer">
                <button class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
