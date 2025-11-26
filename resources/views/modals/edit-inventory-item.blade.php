<div class="modal fade" id="edit-inventory-{{ $items->id }}" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="fw-bold">Edit Inventory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="edit-inventory-form-{{ $items->id }}">
                        <input type="hidden" name="item_id_{{ $items->id }}" value="{{ $items->id }}">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control form-control-sm" name="item_name" value="{{ $items->item_name }}" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Categpry</label>
                            <select id="category" name="category" class="form-select" required>
                                <option value="{{$items->category}}" hidden selected >{{$items->category}}</option>
                                <option value="ppe">PPE</option>
                                <option value="patient protection">Patient Protection</option>
                                <option value="patient protection">Procedure Supplies</option>
                                <option value="consumables">Consumables</option>
                                <option value="tools">Tools</option>
                                <option value="anesthetics">Anesthetics</option>
                                <option value="orthodontics">Orthodontics</option>
                                <option value="restoratives">Restoratives</option>
                                <option value="hygiene">Hygiene</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" class="form-control form-control-sm" name="stock" value="{{ $items->on_hand }}" min="0" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Unit Price</label>
                            <input type="number" step="0.01" class="form-control form-control-sm" name="price" value="{{ $items->price }}" min="0" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Manufactured Date</label>
                            <input type="date" class="form-control form-control-sm" name="manufactured_date" value="{{ $items->manufactured_date }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expiration Date</label>
                            <input type="date" class="form-control form-control-sm" name="expiration_date" value="{{ $items->expiration_date }}">
                        </div>

                        <div class="modal-footer p-0 mt-3">
                            <button type="submit" class="btn btn-primary rounded-0 update-inventory-item" data-refid="{{ $items->id }}">Save</button>
                            <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>