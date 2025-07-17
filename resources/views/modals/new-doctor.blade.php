<div class="modal fade" id="new-doctor" data-bs-backdrop="static">
    <div class="modal-dialog modal-center">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="fw-bold">Add new Doctor/Dentist</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body position-relative">
                <form enctype="multipart/form-data" class="new-doctor-form">
                    <div class="mb-3">
                        <label for="ProfessionalTitle" class="form-label">Professional Title</label>
                        <input type="text" class="form-control form-control-sm rounded-1" name="ProfessionalTitle"
                            id="ProfessionalTitle" placeholder="e.g., Dr., Atty.">
                    </div>

                    <div class="mb-3">
                        <label for="FirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control form-control-sm rounded-1" name="FirstName"
                            id="FirstName" required>
                    </div>

                    <div class="mb-3">
                        <label for="LastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control form-control-sm rounded-1" name="LastName" id="LastName"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="MiddleName" class="form-label">Middle Name</label>
                        <input type="text" class="form-control form-control-sm rounded-1" name="MiddleName"
                            id="MiddleName">
                    </div>

                    <div class="mb-3">
                        <label for="Suffix" class="form-label">Suffix</label>
                        <input type="text" class="form-control form-control-sm rounded-1" name="Suffix" id="Suffix"
                            placeholder="e.g., Jr., Sr., III">
                    </div>

                    <div class="mb-3">
                        <label for="MDLink" class="form-label">License Verification Link <span class="text-danger">*</span></label>
                        <input type="url" class="form-control form-control-sm rounded-1" name="MDLink" id="MDLink" required placeholder="https://www.prc.gov.ph/verify" />
                        <div class="form-text">Provide a valid link to a license verification page (e.g., PRC, Board of Medicine).</div>
                    </div>

                    <div class="mb-3">
                        <label for="AreaOfExpertise" class="form-label">Area of Expertise</label>
                        <input type="text" class="form-control form-control-sm rounded-1" name="AreaOfExpertise"
                            id="AreaOfExpertise">
                    </div>

                    <div class="mb-3">
                        <label for="image_path" class="form-label">Upload Image</label>
                        <input type="file" class="form-control form-control-sm rounded-1" name="image_path"
                            id="image_path" accept="image/*">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="isVisible" id="isVisible" checked>
                        <label class="form-check-label" for="isVisible">Visible on Site</label>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn save-new-doctor rounded-0"
                    style="background: #063D58; border-radius: 0px; color: whitesmoke;">{{__('Save')}}</button>
                <button type="button" class="btn btn-secondary rounded-0"
                    data-bs-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>