<div class="modal fade" id="update-sub-service" data-bs-backdrop="static">
    <div class="modal-dialog modal-center">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="fw-bold">Update Service: <span class="text-dark lead fw-semibold"></span></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
               <form class="update-sub-service-form">
    <input type="hidden" name="id">

    <div class="mb-3">
        <label class="form-label fw-semibold">Service Name</label>
        <input type="text" name="service" class="form-control rounded-0">
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" class="form-control rounded-0" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Price</label>
        <input type="number" name="price" class="form-control rounded-0">
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Upload Image</label>
        <input type="file" accept="image/*" name="image" id="update-sub-service-img" class="form-control rounded-0">
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Current Image</label><br>
        <img src="" class="img-fluid rounded sub-service-preview-img border p-1" width="150" alt="Service Preview">
    </div>
</form>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary test-sub-service rounded-0">Update</button>
                <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
