<div class="">
    <p class="fw-bold">History</p>
    <form action="" class="client-medical-history-form">
        <div class="row">
            <div class="col-sm-6">
                <label for="previousdentist" class="form-label fw-normal">Previous Dentist</label>
                <input type="text" class="form-control form-control-sm" id="previousdentist" name="previousdentist">
            </div>
            <div class="col-sm-6">
                <label for="allergies" class="form-label fw-normal">Last Visit</label>
                <input type="date" class="form-control form-control-sm" id="lastvisit" name="lastvisit">
            </div>
        </div>
        <hr class="my-4" style="border-top: 1px solid black; height: 1px;">
        <div class="row">
            <p class="fw-semibold h4 my-3">Medical History</p>
            <div class="col-4">
                <label for="physician" class="fw-normal">Name of Physician</label>
                <input type="text" class="form-control form-control-sm" id="physician" name="physician">
            </div>
            <div class="col-4">
                <label for="specialty" class="fw-normal">Specialty</label>
                <input type="text" class="form-control form-control-sm" id="specialty" name="specialty">
            </div>
            <div class="col-4">
                {{-- for spacing --}}
            </div>
            {{-- <div class="col-3"> --}}
                {{-- for spacing --}}
            {{-- </div> --}}
        </div>
        <div class="row my-4 mt-5">
            <div class="col-4">
                <label for="officeaddress" class="fw-normal">Office Address</label>
                <input type="text" class="form-control form-control-sm" id="officeaddress" name="officeaddress">
            </div>
            <div class="col-4">
                <label for="officeno" class="fw-normal">Office No.</label>
                <input type="text" class="form-control form-control-sm" id="officeno" name="officeno">
            </div>
            <div class="col-4">
                {{-- for spacing --}}
            </div>
            {{-- <div class="col-3"> --}}
                {{-- for spacing --}}
            {{-- </div> --}}
        </div>
        <hr class="my-4" style="border-top: 1px solid black; height: 1px;">

        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="isHealthy">Are you in good health?</label>
                    </div>
                    <div class="col-sm-12">
                        <input type="radio" name="isHealthy" id="isHealthy" value="yes"> Yes
                        <br>
                        <input type="radio" name="isHealthy" id="isHealthy" value="no"> No
                    </div>
                </div>
                {{-- <label for="IsClientInGoodHealth" class="fw-normal">Are you in good health?</label><br> --}}
                {{-- <input type="radio" name="IsClientInGoodHealth" id="IsClientInGoodHealth" value="yes"> Yes
                <input type="radio" name="IsClientInGoodHealth" id="IsClientInGoodHealth" value="no"> No --}}
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="hasUsedSubstances">Do you use alcohol, cocaine or other dangerous drugs?</label>
                    </div>
                    <div class="col-sm-12">
                        <input type="radio" name="hasUsedSubstances" id="hasUsedSubstances" value="yes"> Yes
                        <br>
                        <input type="radio" name="hasUsedSubstances" id="hasUsedSubstances" value="no"> No
                    </div>
                </div>
            </div>
            <div class="col-sm-6 my-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="hasMedicalCondition">Are you under medical condition now?</label>
                    </div>
                    <div class="col-sm-12">
                        <input type="radio" name="hasMedicalCondition" id="hasMedicalCondition" value="yes"> Yes
                        <br>
                        <input type="radio" name="hasMedicalCondition" id="hasMedicalCondition" value="no"> No
                        <div class="mx-3 isFieldRequired">
                            <div class="text-field-required">
                                <span class="">If so what's the condition being treated?</span>
                            </div>
                            <input type="text" name="clientcondition" class="mt-3 medical-history-extra-field form-control form-control-sm bg-transparent" id="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 my-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="isAllergicTo">Are you Allergic to any of the following: </label>
                    </div>
                    <div class="col-sm-12">
                        <input type="checkbox" name="isAllergicTo[]" id="isAllergicTo" value="LocalAnesthetic"> Local Anesthetic (ex Lidocaine)
                        <input type="checkbox" name="isAllergicTo[]" id="isAllergicTo" value="SulfaDrugs"> Sulfa Drugs <br>
                        <input type="checkbox" name="isAllergicTo[]" id="isAllergicTo" value="Aspirin"> Aspirin <br>
                        <input type="checkbox" name="isAllergicTo[]" id="isAllergicTo" value="Latex"> Latex <br>
                        <input type="checkbox" name="isAllergicTo[]" id="isAllergicTo" value="Penicilin-Antibiotics"> Penicilin, Antibiotics <br>
                        {{-- <input type="radio" name="isAllergicTo" id="isAllergicTo" value="SulfaDrugs"> Sulfa Drugs --}}
                        <div class="mx-3 isFieldRequired">
                            <div class="text-field-required mt-2">
                                <span class="">Others, Specify</span>
                            </div>
                            <input type="text" name="clientcondition" class="medical-history-extra-field form-control form-control-sm bg-transparent" id="">
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="hadSurgery">Have you ever had serious illness or surgical operation?</label>
                    </div>
                    <div class="col-sm-12">
                        <input type="radio" name="hadSurgery" id="hadSurgery" value="yes"> Yes
                        <br>
                        <input type="radio" name="hadSurgery" id="hadSurgery" value="no"> No
                        <div class="mx-3 isFieldRequired">
                            <div class="text-field-required">
                                <span class="">If so what Illness or Operation?</span>
                            </div>
                            <input type="text" name="clientSurgeryIllness" class="mt-3 medical-history-extra-field form-control form-control-sm bg-transparent" id="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="isPregnant">Are you Pregnant? <sup class="text-warning">(for women)</sup></label>
                    </div>
                    <div class="col-sm-12">
                        <input type="radio" name="isPregnant" id="isPregnant" value="yes"> Yes
                        <br>
                        <input type="radio" name="isPregnant" id="isPregnant" value="no"> No
                    </div>
                </div>
            </div>
            <div class="col-sm-6 my-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="hadBeenHospitalized">Have you ever been hospitalized?</label>
                    </div>
                    <div class="col-sm-12">
                        <input type="radio" name="hadBeenHospitalized" id="hadBeenHospitalized" value="yes"> Yes
                        <br>
                        <input type="radio" name="hadBeenHospitalized" id="hadBeenHospitalized" value="no"> No
                        <div class="mx-3 isFieldRequired">
                            <div class="text-field-required">
                                <span class="">If so what Why & When?</span>
                            </div>
                            <input type="text" name="clientHospitalizationHistory" class="mt-3 medical-history-extra-field form-control form-control-sm bg-transparent" id="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="isOnBithControl">Are you taking Birth Control pills? <sup class="text-warning">(for women)</sup></label>
                    </div>
                    <div class="col-sm-12">
                        <input type="radio" name="isOnBithControl" id="isOnBithControl" value="yes"> Yes
                        <br>
                        <input type="radio" name="isOnBithControl" id="isOnBithControl" value="no"> No
                    </div>
                </div>
            </div>
            <div class="col-sm-6 my-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="isTakingPrescription">Are you taking any prescription/non-prescription medication?</label>
                    </div>
                    <div class="col-sm-12">
                        <input type="radio" name="isTakingPrescription" id="isTakingPrescription" value="yes"> Yes
                        <br>
                        <input type="radio" name="isTakingPrescription" id="isTakingPrescription" value="no"> No
                        <div class="mx-3 isFieldRequired">
                            <div class="text-field-required">
                                <span class="">If so specify</span>
                            </div>
                            <input type="text" name="clientPrescription" class="mt-3 medical-history-extra-field form-control form-control-sm bg-transparent" id="">
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
                        <input type="radio" name="isClientASmokeWhack" id="isClientASmokeWhack" value="yes"> Yes
                        <br>
                        <input type="radio" name="isClientASmokeWhack" id="isClientASmokeWhack" value="no"> No
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <label style="font-weight: 500" for="isClientNursing">Are you nursing?</label> <!-- idk what the question is. Is the client a Nursing student or Nursing a kid or a child? Silly question tho -->
                    </div>
                    <div class="col-sm-12">
                        <input type="radio" name="isClientNursing" id="isClientNursing" value="yes"> Yes
                        <br>
                        <input type="radio" name="isClientNursing" id="isClientNursing" value="no"> No
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="bloodType" class="form-label fw-medium">Blood Type</label>
                    <select name="bloodType" id="bloodType" class="form-select form-select-sm">
                    <option value="" selected hidden>Select blood type</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="Unknown">Unknown</option>
                    </select>
                </div>

                <div>
                    <label for="bloodPressure" class="form-label fw-medium">Blood Pressure</label>
                    <input type="text" class="form-control form-control-sm" id="bloodPressure" name="bloodPressure" placeholder="e.g., 120/80 mmHg">
                </div>
                </div>
                <div class="col-sm-12 my-4">
                    <hr class="my-4" style="border-top: 1px solid black; height: 1px;">
                    <label class="form-label fw-semibold">Do you have or have you had any of the following? <span class="fw-normal">Check which apply.</span></label>
                    <div class="row">
                        
                        <!-- Column 1 -->
                        <div class="col-md-3">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="High Blood Pressure" id="highBP"><label class="form-check-label" for="highBP">High Blood Pressure</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Low Blood Pressure" id="lowBP"><label class="form-check-label" for="lowBP">Low Blood Pressure</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Epilepsy/Convulsions" id="epilepsy"><label class="form-check-label" for="epilepsy">Epilepsy/Convulsions</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="AIDS or HIV Infection" id="hiv"><label class="form-check-label" for="hiv">AIDS or HIV Infection</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Sexually Transmitted Disease" id="std"><label class="form-check-label" for="std">Sexually Transmitted Disease</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Stomach Troubles/Ulcers" id="ulcers"><label class="form-check-label" for="ulcers">Stomach Troubles/Ulcers</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Fainting Seizure" id="fainting"><label class="form-check-label" for="fainting">Fainting Seizure</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Rapid Weight Loss" id="weightLoss"><label class="form-check-label" for="weightLoss">Rapid Weight Loss</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Radiation Therapy" id="radiation"><label class="form-check-label" for="radiation">Radiation Therapy</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Joint Replacement/Implant" id="jointImplant"><label class="form-check-label" for="jointImplant">Joint Replacement/Implant</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Heart Surgery" id="heartSurgery"><label class="form-check-label" for="heartSurgery">Heart Surgery</label></div>
                        </div>

                        <!-- Column 2 -->
                        <div class="col-md-3">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Heart Attack" id="heartAttack"><label class="form-check-label" for="heartAttack">Heart Attack</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Thyroid Problem" id="thyroid"><label class="form-check-label" for="thyroid">Thyroid Problem</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Heart Disease" id="heartDisease"><label class="form-check-label" for="heartDisease">Heart Disease</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Head Murmur" id="headMurmur"><label class="form-check-label" for="headMurmur">Head Murmur</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Hepatitis/Liver Disease" id="liverDisease"><label class="form-check-label" for="liverDisease">Hepatitis/Liver Disease</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Rheumatic Fever" id="rheumatic"><label class="form-check-label" for="rheumatic">Rheumatic Fever</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Hay Fever/Allergies" id="hayFever"><label class="form-check-label" for="hayFever">Hay Fever/Allergies</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Respiratory Problems" id="respiratory"><label class="form-check-label" for="respiratory">Respiratory Problems</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Hepatitis/Jaundice" id="jaundice"><label class="form-check-label" for="jaundice">Hepatitis/Jaundice</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Tuberculosis" id="tuberculosis"><label class="form-check-label" for="tuberculosis">Tuberculosis</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Swollen Ankles" id="ankles"><label class="form-check-label" for="ankles">Swollen Ankles</label></div>
                        </div>

                        <!-- Column 3 -->
                        <div class="col-md-3">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Kidney Disease" id="kidney"><label class="form-check-label" for="kidney">Kidney Disease</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Diabetes" id="diabetes"><label class="form-check-label" for="diabetes">Diabetes</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Chest Problems" id="chest"><label class="form-check-label" for="chest">Chest Problems</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Stroke" id="stroke"><label class="form-check-label" for="stroke">Stroke</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Cancer/Tumors" id="cancer"><label class="form-check-label" for="cancer">Cancer/Tumors</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Anemia" id="anemia"><label class="form-check-label" for="anemia">Anemia</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Angina" id="angina"><label class="form-check-label" for="angina">Angina</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Asthma" id="asthma"><label class="form-check-label" for="asthma">Asthma</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Emphysema" id="emphysema"><label class="form-check-label" for="emphysema">Emphysema</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Bleeding Problems" id="bleeding"><label class="form-check-label" for="bleeding">Bleeding Problems</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Blood Disease" id="bloodDisease"><label class="form-check-label" for="bloodDisease">Blood Disease</label></div>
                        </div>

                        <!-- Column 4 -->
                        <div class="col-md-3">
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Head Injuries" id="headInjuries"><label class="form-check-label" for="headInjuries">Head Injuries</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="illnesses[]" value="Arthritis/Rheumatism" id="arthritis"><label class="form-check-label" for="arthritis">Arthritis/Rheumatism</label></div>

                        <!-- Other -->
                        <div class="form-check d-flex align-items-center mt-2">
                            <input class="form-check-input me-2" type="checkbox" name="illnesses[]" value="Other" id="otherIllness">
                            <label class="form-check-label me-2" for="otherIllness">Other</label>
                            <input type="text" class="form-control form-control-sm border-bottom border-dark d-none rounded-0 bg-transparent medical-history-extra-field" placeholder="Specify" name="otherIllnessDetails" style="max-width: 150px;">
                        </div>
                        </div>

                    </div>
                    </div>
        </div>
    </form>
</div>