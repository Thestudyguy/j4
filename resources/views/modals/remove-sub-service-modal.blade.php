<div class="modal fade" id="remove-sub-service" data-bs-backdrop="static">
    <div class="modal-dialog modal-center">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="fw-bold">Remove Service</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body position-relative">
                <p>Are you sure you want to remove the service <span class="fw-bold sub-service-prop"></span>?</p>

            </div>
            {{-- <div class="modal-body">
    <div class="text-center">
        <i class="fas fa-exclamation-triangle text-warning fs-1 mb-3"></i>
        <p class="mb-2">
            Are you sure you want to remove the service 
            <span class="fw-bold text-danger sub-service-prop"></span>?
        </p>
        <small class="text-muted d-block">
            This action cannot be undone.
        </small>
    </div>
</div> --}}
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger prep-remove-sub-service-btn">
    {{__('Remove')}}
</button>
                <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>