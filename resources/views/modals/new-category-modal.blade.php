<div class="modal fade" id="new-category" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="fw-bold">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                   <form action="">
                     <div class="mb-3">
                        {{-- <label for="category" class="form-label">Category</label> --}}
                        <input type="text" id="category" name="category" class="form-control rounded-0" placeholder="Enter category..." required>
                    </div>
                   </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info sm text-white">Save</button>
                    <button class="btn btn-secondary sm text-white" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>