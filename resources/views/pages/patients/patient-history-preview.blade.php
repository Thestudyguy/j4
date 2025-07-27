<div>
    <p class="fw-bold">History</p>
    <form action="" class="client-medical-history-form">
        <div class="row">
            <div class="col-sm-6">
                <label for="previousdentist" class="form-label fw-normal">Previous Dentist</label>
                <p class="preview-previousdentist"></p>
            </div>
            <div class="col-sm-6">
                <label for="allergies" class="form-label fw-normal">Last Visit</label>
                <p class="preview-lastvisit"></p>
            </div>
        </div>

        <hr class="my-4" style="border-top: 1px solid black; height: 1px;">

        <div class="row">
            <p class="fw-semibold h4 my-3">Medical History</p>
            <div class="col-4">
                <label for="physician" class="fw-normal">Name of Physician</label>
                <p class="preview-physician"></p>
            </div>
            <div class="col-4">
                <label for="specialty" class="fw-normal">Specialty</label>
                <p class="preview-specialty"></p>
            </div>
            <div class="col-4">
                {{-- for spacing --}}
            </div>
        </div>

        <div class="row my-4 mt-5">
            <div class="col-4">
                <label for="officeaddress" class="fw-normal">Office Address</label>
                <p class="preview-officeaddress"></p>
            </div>
            <div class="col-4">
                <label for="officeno" class="fw-normal">Office No.</label>
                <p class="preview-officeno"></p>
            </div>
            <div class="col-4">
                {{-- for spacing --}}
            </div>
        </div>

        <hr class="my-4" style="border-top: 1px solid black; height: 1px;">

        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="goodhealth">Are you in good health?</label>
                    </div>
                    <div class="col-sm-12">
                        <p class="preview-goodhealth"></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="alcohol">Do you use alcohol, cocaine, or other dangerous drugs?</label>
                    </div>
                    <div class="col-sm-12">
                        <p class="preview-alcohol"></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 my-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="medicalcondition">Are you under medical treatment now?</label>
                    </div>
                    <div class="col-sm-12">
                        <p class="preview-medicalcondition"></p>
                    </div>
                    <div class="mx-3 preview-medicalconditiontext"></div>
                </div>
            </div>

            <div class="col-sm-6 my-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="isAllergicTo">Are you allergic to any of the following? </label>
                    </div>
                    <div class="col-sm-12">
                        <ul class="preview-allergies"></ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="surgery">Have you ever had serious illness or surgical operation?</label>
                    </div>
                    <div class="col-sm-12">
                        <p class="preview-surgery"></p>
                        <div class="mx-3 isFieldRequired surgerytextcontainer">
                            <div class="text-field-required">
                                <p class="preview-surgerytext"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="isPregnant">Are you pregnant? <sup class="text-warning">(for women)</sup></label>
                    </div>
                    <div class="col-sm-12">
                        <p class="preview-isPregnant"></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 my-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="hospital">Have you ever been hospitalized?</label>
                    </div>
                    <div class="col-sm-12">
                        <p class="preview-hospital"></p>
                        <div class="mx-3 isFieldRequired hospitaltextcontainer">
                            <div class="text-field-required">
                                <p class="preview-hospitaltext"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="isOnBithControl">Are you taking birth control pills? <sup class="text-warning">(for women)</sup></label>
                    </div>
                    <div class="col-sm-12">
                        <p class="preview-isOnBithControl"></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 my-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="prescription">Are you taking any prescription/non-prescription medication?</label>
                    </div>
                    <div class="col-sm-12">
                        <p class="preview-prescription"></p>
                        <div class="mx-3">
                            <div class="text-field-required">
                            </div>
                            <p class="preview-prescriptiontext"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="isClientASmokeWhack">Do you use tobacco products?</label>
                    </div>
                    <div class="col-sm-12">
                        <p class="preview-isClientASmokeWhack"></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500
                <label style="font-weight: 500" for="isClientNursing">Are you nursing? <sup class="text-warning">(for women)</sup></label>
                    </div>
                    <div class="col-sm-12">
                        <p class="preview-isClientNursing"></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 mt-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="bloodType">Blood Type</label>
                    </div>
                    <div class="col-sm-12">
                        <p class="preview-bloodType"></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 mt-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="bloodPressure">Blood Pressure</label>
                    </div>
                    <div class="col-sm-12">
                        <p class="preview-bloodPressure"></p>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4" style="border-top: 1px solid black; height: 1px;">

        <div class="row">
            <div class="col-sm-12">
                <p class="fw-semibold h4 my-3">Known Illnesses</p>
                <ul class="ps-3 preview-known-illnesses">
                    
                </ul>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-sm-12">
                <p class="fw-semibold h4 my-3">Allergies</p>
                <ul class="ps-3 preview-allergies">
                   
                </ul>
            </div>
        </div>
    </form>
</div>
