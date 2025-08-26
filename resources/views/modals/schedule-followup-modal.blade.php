<!-- Follow-up / Operation Scheduling Modal -->
<div class="modal fade" id="scheduleFollowupModal" tabindex="-1" aria-labelledby="scheduleFollowupLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="followupForm" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="scheduleFollowupLabel">Schedule Follow-up or Operation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- 1. Procedure Details -->
          <h6>Procedure Details</h6>
          <div class="mb-3">
            <label class="form-label">Type of Visit</label>
            <div>
              @php
                $visitTypes = ['Follow-up', 'Operation', 'Emergency', 'Consultation'];
              @endphp
              @foreach($visitTypes as $type)
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="visit_type" id="visit_{{ strtolower($type) }}" value="{{ $type }}" required>
                  <label class="form-check-label" for="visit_{{ strtolower($type) }}">{{ $type }}</label>
                </div>
              @endforeach
            </div>
          </div>

          <div class="mb-3">
            <label for="planned_procedure" class="form-label">Planned Procedure</label>
            <select id="planned_procedure" name="planned_procedure" class="form-select" required>
              <option value="" disabled selected>Select procedure</option>
              @php
                $procedures = ['Extraction', 'Filling', 'Root Canal', 'Crown', 'Scaling', 'Cleaning', 'Consultation'];
              @endphp
              @foreach($procedures as $proc)
                <option value="{{ $proc }}">{{ $proc }}</option>
              @endforeach
              <option value="Other">Other (Specify below)</option>
            </select>
            <input type="text" name="planned_procedure_other" id="planned_procedure_other" class="form-control mt-2" placeholder="Specify other procedure" style="display:none;">
          </div>

          <div class="mb-3">
            <label for="followup_datetime" class="form-label">Date & Time</label>
            <input type="datetime-local" class="form-control" id="followup_datetime" name="followup_datetime" required>
          </div>

          <hr>

          <!-- 2. Teeth Selection -->
          <h6>Teeth Selection</h6>
          <div class="mb-3">
            <label for="teeth_selection" class="form-label">Teeth to Operate On</label>
            <!-- Teeth Selection as Checkboxes -->
<div class="mb-3">
  <label class="form-label">Teeth to Operate On</label>
  <div class="row">
    @php
      // Example quadrant-based tooth list
      $quadrants = [
        'Upper Right' => ['18', '17', '16', '15', '14', '13', '12', '11'],
        'Upper Left'  => ['21', '22', '23', '24', '25', '26', '27', '28'],
        'Lower Left'  => ['38', '37', '36', '35', '34', '33', '32', '31'],
        'Lower Right' => ['41', '42', '43', '44', '45', '46', '47', '48'],
      ];
    @endphp

    @foreach ($quadrants as $label => $teeth)
      <div class="col-md-6 mb-2">
        <strong>{{ $label }}</strong>
        <div class="d-flex flex-wrap gap-2 mt-1">
          @foreach ($teeth as $tooth)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="teeth_selection[]" id="tooth_{{ $tooth }}" value="{{ $tooth }}">
              <label class="form-check-label" for="tooth_{{ $tooth }}">#{{ $tooth }}</label>
            </div>
          @endforeach
        </div>
      </div>
    @endforeach
  </div>
</div>

            <small class="form-text text-muted">Hold Ctrl (Cmd) to select multiple teeth.</small>
          </div>

          <div class="mb-3">
            <label for="tooth_condition_notes" class="form-label">Notes about Tooth Condition</label>
            <textarea class="form-control" id="tooth_condition_notes" name="tooth_condition_notes" rows="2" placeholder="e.g., cracked molar, needs crown"></textarea>
          </div>

          <hr>

          <!-- 3. Materials & Inventory -->
          <h6>Materials & Inventory</h6>
          <div id="inventory-items-container" class="mb-3">
            <label class="form-label">Inventory Items to Use</label>
            <div class="row g-2 align-items-center mb-2 inventory-item-row">
              <div class="col-7">
                <input type="text" name="inventory_items[]" class="form-control inventory-item-input" placeholder="Type to search inventory..." autocomplete="off" list="inventoryList" required>
                <datalist id="inventoryList">
                  @php
                    // Example inventory items - replace with actual stock from backend
                    $inventoryItems = ['Anesthetic', 'Crown', 'Filling Material', 'Sutures', 'Sterile Drape', 'Suction Tip'];
                  @endphp
                  @foreach($inventoryItems as $item)
                    <option value="{{ $item }}">
                  @endforeach
                </datalist>
              </div>
              <div class="col-3">
                <input type="number" min="1" name="inventory_quantities[]" class="form-control" placeholder="Quantity" required>
              </div>
              <div class="col-2">
                <button type="button" class="btn btn-danger btn-sm remove-inventory-item" title="Remove item">&times;</button>
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-outline-primary btn-sm mb-3" id="addInventoryItemBtn">+ Add Another Item</button>

          <div class="mb-3">
            <label for="assistant_notes" class="form-label">Assistant Notes (Optional)</label>
            <textarea class="form-control" id="assistant_notes" name="assistant_notes" rows="2" placeholder="e.g., Prepare suction tip, sterile drape"></textarea>
          </div>

          <hr>

          <!-- 4. Additional Notes / Instructions -->
          <h6>Additional Notes / Instructions</h6>
          <div class="mb-3">
            <label for="post_op_reminders" class="form-label">Post-op Care Reminders</label>
            <textarea class="form-control" id="post_op_reminders" name="post_op_reminders" rows="3" placeholder="e.g., avoid hard foods for 24 hrs"></textarea>
          </div>

          <div class="mb-3">
            <label for="special_precautions" class="form-label">Special Precautions</label>
            <textarea class="form-control" id="special_precautions" name="special_precautions" rows="2" placeholder="e.g., allergies, antibiotic prophylaxis"></textarea>
          </div>

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="patient_informed" name="patient_informed" required>
            <label class="form-check-label" for="patient_informed">
              Patient informed about precautions and post-op care
            </label>
          </div>

          <hr>

          <!-- 5. Cost Estimate (Optional) -->
          <h6>Cost Estimate (Optional)</h6>
          <div class="mb-3 row">
            <label for="cost_estimate" class="col-sm-3 col-form-label">Estimated Cost (USD)</label>
            <div class="col-sm-6">
              <input type="number" min="0" step="0.01" class="form-control" id="cost_estimate" name="cost_estimate" placeholder="e.g., 150.00">
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Appointment</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Optional JavaScript to handle dynamic inventory items and planned procedure "Other" input -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const addInventoryBtn = document.getElementById('addInventoryItemBtn');
    const inventoryContainer = document.getElementById('inventory-items-container');

    addInventoryBtn.addEventListener('click', () => {
      const newRow = document.createElement('div');
      newRow.classList.add('row', 'g-2', 'align-items-center', 'mb-2', 'inventory-item-row');
      newRow.innerHTML = `
        <div class="col-7">
          <input type="text" name="inventory_items[]" class="form-control inventory-item-input" placeholder="Type to search inventory..." autocomplete="off" list="inventoryList" required>
        </div>
        <div class="col-3">
          <input type="number" min="1" name="inventory_quantities[]" class="form-control" placeholder="Quantity" required>
        </div>
        <div class="col-2">
          <button type="button" class="btn btn-danger btn-sm remove-inventory-item" title="Remove item">&times;</button>
        </div>
      `;
      inventoryContainer.appendChild(newRow);
    });

    inventoryContainer.addEventListener('click', function(e) {
      if (e.target.classList.contains('remove-inventory-item')) {
        e.target.closest('.inventory-item-row').remove();
      }
    });

    // Show/hide "Other" input for planned procedure
    const procedureSelect = document.getElementById('planned_procedure');
    const otherInput = document.getElementById('planned_procedure_other');

    procedureSelect.addEventListener('change', function () {
      if (this.value === 'Other') {
        otherInput.style.display = 'block';
        otherInput.required = true;
      } else {
        otherInput.style.display = 'none';
        otherInput.required = false;
        otherInput.value = '';
      }
    });
  });
</script>
