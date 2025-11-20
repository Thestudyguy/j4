<div class="modal fade" id="remove-item-{{$items->id}}" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-3 shadow-sm">
            <div class="modal-header bg-danger text-white">
                <h5 class="fw-bold mb-0">Delete Item</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Do you really want to delete <span class="fw-bold">{{ $items->item_name }}</span> from your inventory?</p>
<small class="text-muted text-danger">This action is permanent and cannot be undone.</small>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger delete-inventory-item" data-id="{{$items->id}}">
                    <i class="fas fa-trash-alt me-1"></i> Delete
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
