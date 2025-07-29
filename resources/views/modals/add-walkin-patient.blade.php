<div class="modal fade" id="walkin-patient" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="fw-bold">Add Walk-In Patient</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form class="walkin-form">
                    <div class="mb-3">
                        <label for="FirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control form-control-sm rounded-1" name="FirstName" required>
                    </div>

                    <div class="mb-3">
                        <label for="LastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control form-control-sm rounded-1" name="LastName" required>
                    </div>

                    <div class="mb-3">
                        <label for="BirthDate" class="form-label">Birth Date</label>
                        <input type="date" class="form-control form-control-sm rounded-1" name="BirthDate" required>
                    </div>

                    <div class="mb-3">
                        <label for="Gender" class="form-label">Gender</label>
                        <select class="form-control form-control-sm rounded-1" name="Gender" required>
                            <option hidden selected value="">Select...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="MobileNo" class="form-label">Mobile No.</label>
                        <input type="text" class="form-control form-control-sm rounded-1" name="MobileNo" required>
                    </div>

                    <div class="mb-3">
                        <label for="Address" class="form-label">Address</label>
                        <textarea class="form-control form-control-sm rounded-1" name="Address" rows="2" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="Service" class="form-label">Requested Service</label>
                        <select class="form-control form-control-sm rounded-1" name="Service" required>
                            <option hidden selected value="">Choose service</option>
                            <option value="Cleaning">Teeth Cleaning</option>
                            <option value="Extraction">Tooth Extraction</option>
                            <option value="Checkup">General Checkup</option>
                            <option value="Retainer">Retainer</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="ReasonForVisit" class="form-label">Reason for Visit</label>
                        <textarea class="form-control form-control-sm rounded-1" name="ReasonForVisit" rows="2"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn rounded-0 text-white" style="background-color: #244F79;">
                    Save Walk-In
                </button>
                <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
