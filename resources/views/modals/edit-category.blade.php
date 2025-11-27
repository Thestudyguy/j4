<div class="modal fade" id="edit-category-{{$cat->id}}" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">

            <div class="modal-header">
                <h5 class="fw-bold">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="edit-category-form">
                    @csrf
                    
                    <input type="hidden" id="edit-category-id" value="{{ $cat->id }}">

                    <div class="mb-3">
                        <input type="text" id="edit-category-name" name="category"
                               class="form-control rounded-0"
                               placeholder="Enter new category..." required value="{{ $cat->category }}">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-info sm text-white update-category" id="{{ $cat->id }}" data-id="{{ $cat->id }}">Update</button>
                <button class="btn btn-secondary sm text-white" data-bs-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>
