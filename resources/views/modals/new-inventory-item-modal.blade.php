<div class="modal fade" id="new-inventory-item" data-bs-backdrop="static">
    <div class="loader-container new-inventory-item-modal visually-hidden">
        <div class="loader"></div>
    </div>  
    <div class="modal-dialog modal-center">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="fw-bold">New Item</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body position-relative">
                <form action="" class="new-inventory-item">
                    @csrf
                    <div class="mb-3">
                        <label for="item_name" class="form-label fw-semibold">Item Name</label>
                        <input type="text" id="item_name" name="item_name" class="form-control"
                            placeholder="Enter item name" required>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label fw-semibold">Category</label>
                        <select id="category" name="category" class="form-select" required>
                            <option value="" hidden selected>Select a category</option>
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
                        <label for="stock" class="form-label fw-semibold">Stock Quantity</label>
                        <input type="number" id="stock" name="stock" class="form-control"
                            placeholder="Enter stock amount" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label fw-semibold">Manufactured By:</label>
                        <input type="text" id="manufactured_by" name="manufactured_by" class="form-control"
                            placeholder="Enter manufacturer" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label fw-semibold">Expiration Date</label>
                        <input type="date" id="expiration_date" name="expiration_date" class="form-control"
                            placeholder="Enter stock amount" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label fw-semibold">Unit Price</label>
                        <input type="text" class="form-control form-control-sm rounded-1" name="price" id="price" onchange="formatValueInput(this)">
                    </div>
                </form>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn save-new-inventory-item rounded-0"
                style="background: #063D58; border-radius: 0px; color: whitesmoke;">{{ __('Save') }}</button>
            <button type="button" class="btn btn-secondary rounded-0"
                data-bs-dismiss="modal">{{ __('Cancel') }}</button>
        </div>
    </div>
</div>
</div>
