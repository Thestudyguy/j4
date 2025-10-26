{{-- <div>
    <p class="client-info fw-bold">Personal Info</p>
    <form action="" class="client-personal-info-form">
        <div class="row">
            <div class="col-sm-12 p-3">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="lastname" class="form-label fw-normal">Last Name</label>
                        <p class='preview-lastname'></p>
                    </div>
                    <div class="col-sm-4">
                        <label for="firstname" class="form-label fw-normal">First Name</label>
                        <p class='preview-firstname'></p>
                    </div>
                    <div class="col-sm-4">
                        <label for="middlename" class="form-label fw-normal">Middle Name</label>
                        <p class='preview-middlename'></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 p-3">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="birthdate" class="form-label fw-normal">Birthdate</label>
                        <p class='preview-birthdate'></p>
                    </div>
                    <div class="col-sm-4 client-sex-field-preview">
                        <label for="sex" class="form-label fw-normal">Sex</label>
                        <p class='preview-sex'></p>
                    </div>
                    <div class="col-sm-4">
                        <label for="age" class="form-label fw-normal">Age</label>
                        <p class='preview-age'></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 p-3">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="religion" class="form-label fw-normal">Religion</label>
                        <p class="preview-religion"></p>
                    </div>
                    <div class="col-sm-4">
                        <label for="nationality" class="form-label fw-normal">Nationality</label>
                        <p class='preview-nationality'></p>
                    </div>
                    <div class="col-sm-4">
                        <label for="nickname" class="form-label fw-normal">Nickname</label>
                        <p class='preview-nickname'></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 p-3">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="address" class="form-label fw-normal">Address</label>
                        <p class='preview-address'></p>
                    </div>
                    <div class="col-sm-6">
                        <label for="homeno" class="form-label fw-normal">Home No.</label>
                        <p class='preview-homeno'></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 p-3">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="occupation" class="form-label fw-normal">Occupation</label>
                        <p class='preview-occupation'></p>
                    </div>
                    <div class="col-sm-3">
                        <label for="officeno" class="form-label fw-normal">Office No.</label>
                        <p class='preview-officeno'></p>
                    </div>
                    <div class="col-sm-3">
                        <label for="effectivedate" class="form-label fw-normal">Effective Date</label>
                        <p class='preview-effectivedate'></p>
                    </div>
                    <div class="col-sm-3">
                        <label for="faxno" class="form-label fw-normal">Fax No.</label>
                        <p class='preview-faxno'></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 p-3">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="email" class="form-label fw-normal">Email</label>
                        <p class='preview-email'></p>
                    </div>
                    <div class="col-sm-6">
                        <label for="mobileno" class="form-label fw-normal">Mobile No.</label>
                        <p class='preview-mobileno'></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 p-3 for-minor">
                <hr style="height: 1px; background-color: black; border: none;" class="mt-5">
                <p class="fw-semibold" style="font-style: italic">For Minors</p>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="guardian" class="form-label fw-normal">Parent/Guardian Name</label>
                        <p class='preview-guardian'></p>
                    </div>
                    <div class="col-sm-6">
                        <label for="guardianoccupation" class="form-label fw-normal">Occupation</label>
                        <p class='preview-guardianoccupation'></p>
                    </div>
                    <div class="col-sm-12 my-5">
                        <label for="referal" class="form-label fw-normal">Who may we thank for referring you?</label>
                        <p class="preview-referal"></p>
                    </div>
                    <div class="col-sm-12">
                        <label for="consultation" class="form-label fw-normal">Reason for Consultation</label>
                        <p class="preview-consultationreason"></p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div> --}}
<div class="col-sm-12 p-3">
    <div class="row">
        <label for="lastname" class="form-label fw-normal py-3">Name: </label>
        <div class="col-sm-4">
            {{-- <label for="lastname" class="form-label fw-normal">Last Name</label> --}}
            <p class='preview-lastname text-center flex-grow-1 small border-bottom'></p>
            <p class='small lead text-center' style="font-style: italic;">(Last Name)</p>
        </div>
        <div class="col-sm-4">
            {{-- <label for="firstname" class="form-label fw-normal">First Name</label> --}}
            <p class='preview-firstname text-center flex-grow-1 small border-bottom'></p>
            <p class='small lead text-center' style="font-style: italic;">(First Name)</p>
        </div>
        <div class="col-sm-4">
            {{-- <label for="middlename" class="form-label fw-normal">Middle Name</label> --}}
            <p class='preview-middlename text-center flex-grow-1 small border-bottom'></p>
            <p class='small leada text-center' style="font-style: italic;">(Middle Name)</p>
        </div>
        <div class="col-sm-5 d-flex align-items-center">
            <label for="birthdate" class="form-label fw-normal me-2 mb-0">Birthdate:</label>
            <p class="preview-birthdate mb-0 small border-bottom flex-grow-1 mx-1"></p>
        </div>
        <div class="col-sm-2 d-flex align-items-center mx-3">
            <label for="sex" class="form-label fw-normal">Sex:</label>
            <p class='preview-sex mb-0 small border-bottom flex-grow-1 mx-1'></p>
        </div>
        <div class="col-sm-3 d-flex align-items-center">
            <label for="age" class="form-label fw-normal">Age:</label>
            <p class='preview-age mb-0 small border-bottom flex-grow-1 mx-1'></p>
        </div>
        <div class="col-sm-5 d-flex align-items-center mt-2">
            <label for="religion" class="form-label fw-normal">Religion:</label>
            <p class="preview-religion mb-0 small border-bottom flex-grow-1 mx-1"></p>
        </div>
        <div class="col-sm-2 d-flex align-items-center mx-3">
            <label for="nationality" class="form-label fw-normal">Nationality:</label>
            <p class='preview-nationality mb-0 small border-bottom flex-grow-1 mx-1'></p>
        </div>
        <div class="col-sm-3 d-flex align-items-center">
            <label for="nickname" class="form-label fw-normal">Nickname:</label>
            <p class='preview-nickname mb-0 mx-3 small border-bottom flex-grow-1 mx-1'></p>
        </div>
        <div class="col-sm-8 d-flex align-items-center">
            <label for="address" class="form-label fw-normal">Home Adress:</label>
            <p class='preview-address mb-0 mx-3 small border-bottom flex-grow-1 mx-1'></p>
        </div>
        <div class="col-sm-4 d-flex align-items-center">
            <label for="homeno" class="form-label fw-normal">Home No:</label>
            <p class='preview-homeno mb-0 mx-3 small border-bottom flex-grow-1 mx-1'></p>
        </div>
        <div class="col-sm-8 d-flex align-items-center">
            <label for="occupation" class="form-label fw-normal">Occupation:</label>
            <p class='preview-occupation mb-0 mx-3 small border-bottom flex-grow-1 mx-1'></p>
        </div>
        <div class="col-sm-4 d-flex align-items-center">
            <label for="occupation" class="form-label fw-normal">Office No:</label>
            <p class='preview-occupation mb-0 mx-3 small border-bottom flex-grow-1 mx-1'></p>
        </div>
         <div class="col-sm-8 d-flex align-items-center">
            <label for="effectivedate" class="form-label fw-normal">Effective Date:</label>
            <p class='preview-effectivedate mb-0 mx-3 small border-bottom flex-grow-1 mx-1'></p>
        </div>
        <div class="col-sm-4 d-flex align-items-center">
            <label for="faxno" class="form-label fw-normal">Fax No:</label>
            <p class='preview-faxno mb-0 mx-3 small border-bottom flex-grow-1 mx-1'></p>
        </div>
        <div class="col-sm-8 d-flex align-items-center">
            <label for="email" class="form-label fw-normal">Email:</label>
            <p class='preview-email mb-0 mx-3 small border-bottom flex-grow-1 mx-1'></p>
        </div>
        <div class="col-sm-4 d-flex align-items-center">
            <label for="mobileno" class="form-label fw-normal">Mobile No:</label>
            <p class='preview-mobileno mb-0 mx-3 small border-bottom flex-grow-1 mx-1'></p>
        </div>
    </div>
</div>
<div class="col-sm-12 for-minor">
    {{-- <hr style="height: 1px; background-color: black; border: none;"> --}}
    <p class="fw-semibold" style="font-style: italic">For Minors:</p>
    <div class="row">
        <div class="col-sm-12 d-flex align-items-center">
            <label for="guardian" class="form-label fw-normal">Parent/Guardian Name</label>
            <p class='preview-guardian border-bottom flex-grow-1 mx-1'></p>
        </div>
        <div class="col-sm-12 d-flex align-items-center">
            <label for="guardianoccupation" class="form-label fw-bold" style="font-style: italic;">Occupation</label>
            <p class='preview-guardianoccupation border-bottom flex-grow-1 mx-1'></p>
        </div>
        <div class="col-sm-12 d-flex align-items-center">
            <label for="referal" class="form-label fw-normal">Who may we thank for referring you?</label>
            <p class="preview-referal border-bottom flex-grow-1 mx-1"></p>
        </div>
        <div class="col-sm-12 d-flex align-items-center">
            <label for="consultation" class="form-label fw-normal">Reason for Consultation</label>
            <p class="preview-consultationreason border-bottom flex-grow-1 mx-1 small text-center"></p>
        </div>
    </div>
</div>
