<div class="modal fade" id="update-service-{{$service->id}}" data-bs-backdrop="static">
    <div class="modal-dialog modal-center">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="fw-bold">Update Service: <span class="text-dark lead fw-semibold">{{$service->Service}}</span></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="" class="service-update-form-{{$service->id}}">
                    <label for="service" class="fw-semibold lead">Service</label>
                    <input type="hidden" name="service_id" value="{{$service->id}}">
                    <input type="text" name="service" value="{{$service->Service}}" class="service-update-input form-control form-control-sm" id="">
                </form>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary update-service-btnsss rounded-0">Update</button>
                <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
