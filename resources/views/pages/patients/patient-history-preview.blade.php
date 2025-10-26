<div>
    <div class="" style="border-top: 5px solid black;">

        <h2 class="fw-boldx py-3">Dental History:</h2>
        <form action="" class="client-medical-history-form">
            <div class="row">
                <div class="col-sm-6 d-flex align-items-center">
                    <label for="previousdentist" class="form-label fw-normal">Previous Dentist: </label>
                    <p class="preview-previousdentist border-bottom flex-grow-1 mt-1 mx-2 small"></p>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 d-flex align-items-center" style="">
                    <label for="allergies" class="form-label fw-normal">Last Visit:</label>
                    <p class="preview-lastvisit border-bottom flex-grow-1 mt-1 mx-2 small"></p>
                </div>
            </div>

            <div class="my-4" style="border-top: 5px solid black; height: 1px;"></div>

            <div class="row">
                <p class="fw-semibold h4 my-3">Medical History</p>
                <div class="col-sm-6 d-flex align-items-center">
                    <label for="physician" class="fw-normal">Name of Physician:</label>
                    <p class="preview-physician border-bottom flex-grow-1 mt-1 mx-2 small"></p>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-4 d-flex align-items-center">
                    <label for="specialty" class="fw-normal">Specialty</label>
                    <p class="preview-specialty border-bottom flex-grow-1 mt-1 mx-2 small"></p>
                </div>
                <div class="col-4">
                    {{-- for spacing --}}
                </div>
            </div>

            <div class="row my-4 mt-5">
                <div class="col-6 d-flex align-items-center">
                    <label for="officeaddress" class="fw-normal">Office Address:</label>
                    <p class="preview-officeaddress border-bottom flex-grow-1 mt-1 mx-2 small"></p>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-4 d-flex align-items-center">
                    <label for="officeno" class="fw-normal">Office No:</label>
                    <p class="preview-officeno border-bottom flex-grow-1 mt-1 mx-2 small"></p>
                </div>
                <div class="col-4">
                    {{-- for spacing --}}
                </div>
            </div>

            {{-- <hr class="my-4" style="border-top: 1px solid black; height: 1px;"> --}}

            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-10">
                            <label style="font-weight: normal;" for="goodhealth">1.Are you in good health?</label>
                        </div>
                        <div class="col-sm-2">
                            <p class="preview-goodhealth"></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-10">
                            <label style="font-weight: normal;" for="alcohol">2.Do you use alcohol, cocaine, or other
                                dangerous drugs?</label>
                        </div>
                        <div class="col-sm-2">
                            <p class="preview-alcohol"></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 m-0">
                    <div class="row">
                        <div class="col-sm-10">
                            <label style="font-weight: normal;" for="medicalcondition">3.Are you under medical treatment
                                now?</label>
                            <div class="col-sm-6 d-flex align-items-center mt-0 mx-5" style="">
                                <label for="allergies" class="form-label fw-semibold small">If so what's the condition
                                    being
                                    treated?</label>
                                <p class="preview-medicalconditiontext border-bottom flex-grow-1 mt-2 mx-2 small"></p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <p class="preview-medicalcondition"></p>
                        </div>

                        {{-- <div class="mx-3 m-0 preview-medicalconditiontext small"></div> --}}
                    </div>
                </div>

                {{-- <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-10">
                            <label style="font-weight: normal;" for="isAllergicTo">Are you allergic to any of the
                                following? </label>
                        </div>
                        <div class="col-sm-2">
                            <ul class="preview-allergies"></ul>
                        </div>
                    </div>
                </div> --}}

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-10">
                            <label style="font-weight: normal;" for="hospital">4.Have you ever been
                                hospitalized?</label>
                            <div class="col-sm-6 d-flex align-items-center mt-0 mx-5" style="">
                                <label for="allergies" class="form-label fw-semibold small">If so when and why?</label>
                                <p class="preview-hospitaltext border-bottom flex-grow-1 mt-2 mx-2 small"></p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <p class="preview-hospital"></p>
                        </div>
                        {{-- <div class="mx-3 isFieldRequired hospitaltextcontainer">
                            <div class="text-field-required">
                                <p class="preview-hospitaltext"></p>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-10">
                            <label style="font-weight: normal;" for="prescription">5.Are you taking any
                                prescription/non-prescription medication?</label>
                                <div class="col-sm-6 d-flex align-items-center mt-0 mx-5" style="">
                                <label for="allergies" class="form-label fw-semibold small">If so please specify</label>
                                <p class="preview-prescriptiontext border-bottom flex-grow-1 mt-2 mx-2 small"></p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <p class="preview-prescription"></p>
                        </div>
                        {{-- <div class="mx-3">
                            <div class="text-field-required">
                            </div>
                            <p class="preview-prescriptiontext small"></p>
                        </div> --}}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-10">
                            <label style="font-weight: normal;" for="isClientASmokeWhack">6.Do you use tobacco
                                products?</label>
                        </div>
                        <div class="col-sm-2">
                            <p class="preview-isClientASmokeWhack"></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-10">
                            <label style="font-weight: normal;" for="alcohol">7.Do you use alcohol, cocaine, or other
                                dangerous drugs?</label>
                        </div>
                        <div class="col-sm-2">
                            <p class="preview-alcohol"></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-10">
                            <label style="font-weight: normal;" for="isAllergicTo">8.Are you allergic to any of the
                                following? </label>
                        </div>
                        <div class="col-sm-2">
                            <ul class="preview-allergies"></ul>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <span class="fw-semibold">9.Fow women only:</span>
                        <div class="col-sm-3 mx-5">
                            <label style="font-weight: normal;" for="isPregnant">Are you pregnant? </label>
                        </div>
                        <div class="col-sm-6">
                            <p class="preview-isPregnant"></p>
                        </div>
                        <div class="col-sm-3 mx-5">
                            <label style="font-weight: normal" for="isClientNursing">Are you nursing? </label>
                        </div>
                        <div class="col-sm-6">
                            <p class="preview-isClientNursing"></p>
                        </div>
                        <div class="col-sm-3 mx-5">
                            <label style="font-weight: normal" for="isOnBithControl">Are you taking birth control
                                pills? </label>
                        </div>
                        <div class="col-sm-6">
                            <p class="preview-isOnBithControl"></p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 d-flex align-items-center">
                    <label style="font-weight: normal;" for="bloodType">10.Blood Type: </label>
                    <p class="preview-bloodType border-bottom flex-grow-1 mt-1 mx-2 small"></p>
                </div>
                <div class="col-sm-6"></div>
                <div class="col-sm-6 d-flex align-items-center">
                    <label style="font-weight: normal;" for="bloodPressure">11.Blood Pressure</label>
                    <p class="preview-bloodPressure border-bottom flex-grow-1 mt-1 mx-2 small"></p>
                </div>




                <div class="row">
                    <div class="col-sm-12">
                        <p class="fw-semibold my-3">12.Do you have or had any of the following?</p>
                        <ul class="ps-3 preview-known-illnesses">

                        </ul>
                    </div>
                </div>

                {{-- <div class="row mt-4">
                <div class="col-sm-12">
                    <p class="fw-semibold h4 my-3">Allergies</p>
                    <ul class="ps-3 preview-allergies">

                    </ul>
                </div>
            </div> --}}
        </form>
    </div>
