<div class="modal fade" id="new-service" data-bs-backdrop="static">
    <div class="modal-dialog modal-center">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="fw-bold">New Service</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body position-relative">
                <form action="" class="new-service-form">
                <div class="mb-3">
                    <label for="servicename" class="form-label">Service</label>
                    <input type="text" class="form-control form-control-sm rounded-1" name="servicename" id="servicename">
                </div>
            </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn save-new-service rounded-0" style="background: #063D58; border-radius: 0px; color: whitesmoke;">{{__('Save')}}</button>
                <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>