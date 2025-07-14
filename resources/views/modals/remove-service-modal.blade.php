<div class="modal fade" id="remove-service-{{$service->id}}" data-bs-backdrop="static">
    <div class="modal-dialog modal-center">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="fw-bold">Remove Service</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body position-relative">
                <p>Are you sure you want to remove the service named <span class="fw-bold">{{$service->Service}}</span>?</p>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger remove-service" data-id="{{$service->id}}">
    {{__('Remove')}}
</button>
                <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>