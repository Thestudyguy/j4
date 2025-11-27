<div class="modal fade" id="remove-doctor-{{ $doctor->id }}" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0 border-danger border-2">
            <div class="modal-header bg-danger text-white">
                <h4 class="fw-bold m-0">⚠️ Remove Doctor</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center position-relative">
                <i class="fas fa-exclamation-triangle text-warning fs-1 mb-3"></i>
                <p class="fs-5 fw-semibold">
                    Are you sure you want to remove <span class="fw-bold doctor-prop">{{ $doctor->ProfessionalTitle ?? '' }} {{ $doctor->LastName }}, {{ $doctor->FirstName }}
                                    {{ $doctor->MiddleName && $doctor->Suffix ? $doctor->MiddleName . ' - ' . $doctor->Suffix : $doctor->MiddleName ?? $doctor->Suffix }}</span> from the system?
                </p>
                <p class="text-muted small">
                    This action will update the status of the doctor and affect how they appear in lists.
                </p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger prep-remove-doctor-btn fw-bold" data-id="{{ $doctor->id }}">
                    Remove
                </button>
                <button type="button" class="btn btn-secondary rounded-0 fw-semibold" data-bs-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
