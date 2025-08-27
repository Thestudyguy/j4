<div class="col-sm-12">
    <div class="medical-history-details">
        <p class="fw-bold">Patient History</p>
        <form action="" class="client-medical-preview-history-form">
            <div class="row">
                <div class="col-sm-6">
                    <label for="previousdentist" class="form-label fw-semibold">Previous Dentist</label>
                    <input type="text" name="updateorcreate_previous_dentist" {{Auth::user()->Role !== 'Dentist' ? 'disabled' : ''}} class="form-control" id=""
                        value="{{ $patientHistory->previous_dentist ?? 'N/A' }}">
                    {{-- <p class="previousdentist">{{ $patientHistory->previous_dentist ?? 'N/A' }}</p> --}}
                </div>
                <div class="col-sm-6">
                    <label for="allergies" class="form-label fw-semibold">Last Visit</label>
                    <input type="date" name="updateorcreate_last_visit" class="form-control" id=""
                        value="{{ $patientHistory->last_visit ?? 'N/A' }}">
                    {{-- <p class="lastvisit">{{ $patientHistory->last_visit ?? 'N/A' }}</p> --}}
                </div>
            </div>

            <hr class="my-4" style="border-top: 1px solid black; height: 1px;">

            <div class="row">
                <p class="fw-semibold h4 my-3">Medical History</p>
                <div class="col-4">
                    <label for="physician" class="fw-semibold">Name of Physician</label>
                    <input type="text" name="updateorcreate_physician_name" class="form-control" id=""
                    {{Auth::user()->Role !== 'Dentist' ? 'disabled' : ''}}
                        value="{{ $patientHistory->physician_name ?? 'N/A' }}">
                    {{-- <p class="physician">{{ $patientHistory->physician_name ?? 'N/A' }}</p> --}}
                </div>
                <div class="col-4">
                    <label for="specialty" class="fw-semibold">Specialty</label>
                    <input type="text" name="updateorcreate_physician_specialty" class="form-control" id=""
                    {{Auth::user()->Role !== 'Dentist' ? 'disabled' : ''}}
                        value="{{ $patientHistory->physician_specialty ?? 'N/A' }}">
                    {{-- <p class="specialty">{{ $patientHistory->physician_specialty ?? 'N/A' }}</p> --}}
                </div>
                <div class="col-4">
                    {{-- for spacing --}}
                </div>
            </div>

            <div class="row my-4 mt-5">
                <div class="col-4">
                    <label for="officeaddress" class="fw-semibold">Office Address</label>
                    <input type="text" name="updateorcreate_physician_office_address" class="form-control" id=""
                    {{Auth::user()->Role !== 'Dentist' ? 'disabled' : ''}}
                        value="{{ $patientHistory->physician_office_address ?? 'N/A' }}">
                    {{-- <p class="officeaddress">{{ $patientHistory->physician_office_address ?? 'N/A' }}</p> --}}
                </div>
                <div class="col-4">
                    <label for="officeno" class="fw-semibold">Office No.</label>
                    <input type="text" name="updateorcreate_physician_office_no" class="form-control" id=""
                    {{Auth::user()->Role !== 'Dentist' ? 'disabled' : ''}}
                        value="{{ $patientHistory->physician_office_no ?? 'N/A' }}">
                    {{-- <p class="officeno">{{ $patientHistory->physician_office_no ?? 'N/A' }}</p> --}}
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
                            <label style="font-weight: 500" for="goodhealth">Are you in good health?<sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-sm-12">
                            {{-- <p class="goodhealth">{{ $patientHistory->good_health ? 'Yes' : 'No'}}</p> --}}
                            <input type="radio"  style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}" value="yes"  name="good_health"
                                {{ $patientHistory->good_health === 'yes' ? 'checked' : '' }}> Yes
                            <br>
                            <input type="radio" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}" value="no" name="good_health"
                                {{ $patientHistory->good_health === 'no' ? 'checked' : '' }}> No

                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="alcohol">Do you use alcohol, cocaine, or other
                                dangerous drugs?<sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-sm-12">
                            {{-- <p class="alcohol">{{ $patientHistory->uses_drugs ? 'Yes' : 'No'}}</p> --}}
                           <input type="radio" 
       style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}" 
       name="uses_drugs" 
       value="yes"
       {{ $patientHistory->uses_drugs === 'yes' ? 'checked' : '' }}> Yes
<br>
<input type="radio" 
       style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}" 
       name="uses_drugs" 
       value="no"
       {{ $patientHistory->uses_drugs === 'no' ? 'checked' : '' }}> No
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 my-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="medicalcondition">Are you under medical
                                treatment
                                now?<sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-sm-12">
                            {{-- <p class="medicalcondition">{{ $patientHistory->under_medical_care ? 'Yes' : 'No'}}
                                        </p> --}}
                            <input type="radio" class="updateorcreate_under_medical_care" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  value="yes" name="update_under_medical_care" id=""
                                {{ $patientHistory->under_medical_care === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" class="updateorcreate_under_medical_care" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  value="no" name="update_under_medical_care"
                                id=""{{ $patientHistory->under_medical_care === 'no' ? 'checked' : '' }}>No
                        </div>
                        <div class="mx-3 isFieldRequired undermedicalcaredetails {{ $patientHistory->under_medical_care === 'yes' ? '' : 'd-none' }}">
                                <div class="text-field-required">
                                <span class="">If so what Illness or Operation?</span>
                                    {{-- <p class="surgerytext">{{ $patientHistory->surgery_text ?? '' }}</p> --}}
                                </div>
                                <input type="text" style="border: none; border-bottom: 1px solid black; border-radius: 0;" 
                                class="form-control" 
                                name="updateorcreate_under_medical_care_text" 
                                value="{{ $patientHistory->medical_condition_text ?? '' }}" 
                                id=""><sup class="text-danger">*</sup>
                            </div>
                    </div>
                </div>

                <div class="col-sm-6 my-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="isAllergicTo">Are you allergic to any of the
                                following?<sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-sm-12">
                            @php
                                $allergies = json_decode($patientHistory->allergy, true); // Decode as array
                            @endphp

                            {{-- <div class="col-sm-12">
                                            <label style="font-weight: 500" for="isAllergicTo">Are you allergic to any of
                                                the
                                                following?</label>
                                        </div> --}}
                            <div class="col-sm-12">
                            <ul class="allergies">
                                @if (is_array($allergies))
                                    <input type="checkbox" name="isAllergicTo[]" id="allergy_LocalAnesthetic" 
                                        value="LocalAnesthetic" 
                                        {{ in_array('LocalAnesthetic', $allergies) ? 'checked' : '' }}>
                                    Local Anesthetic (ex Lidocaine)<br>

                                    <input type="checkbox" name="isAllergicTo[]" id="allergy_SulfaDrugs" 
                                        value="SulfaDrugs" 
                                        {{ in_array('SulfaDrugs', $allergies) ? 'checked' : '' }}>
                                    Sulfa Drugs<br>

                                    <input type="checkbox" name="isAllergicTo[]" id="allergy_Aspirin" 
                                        value="Aspirin" 
                                        {{ in_array('Aspirin', $allergies) ? 'checked' : '' }}>
                                    Aspirin<br>

                                    <input type="checkbox" name="isAllergicTo[]" id="allergy_Latex"  class="text-danger border border-danger"
                                        value="Latex" 
                                        {{ in_array('Latex', $allergies) ? 'checked' : '' }}>
                                    Latex<br>

                                    <input type="checkbox" name="isAllergicTo[]" id="allergy_Penicilin" 
                                        value="Penicilin-Antibiotics" 
                                        {{ in_array('Penicilin-Antibiotics', $allergies) ? 'checked' : '' }}>
                                    Penicilin, Antibiotics<br>

                                    <input type="checkbox" name="isAllergicTo[]" id="allergy_None" 
                                        value="None" 
                                        {{ in_array('None', $allergies) ? 'checked' : '' }}>
                                    None<br>

                                    <div class="mx-3 isFieldRequired">
                                        <div class="text-field-required mt-2">
                                            <span>Others, Specify</span>
                                        </div>
                                        <input type="text" name="isAllergicToTextInput" 
                                            class="medical-history-extra-field form-control form-control-sm bg-transparent" 
                                            value="{{ $patientHistory->allergy_others ?? '' }}">
                                    </div>
                                @else
                                    <input type="checkbox" name="isAllergicTo[]" id="allergy_LocalAnesthetic" 
                                        value="LocalAnesthetic" 
                                        >
                                    Local Anesthetic (ex Lidocaine)<br>

                                    <input type="checkbox" name="isAllergicTo[]" id="allergy_SulfaDrugs" 
                                        value="SulfaDrugs" 
                                        >
                                    Sulfa Drugs<br>

                                    <input type="checkbox" name="isAllergicTo[]" id="allergy_Aspirin" 
                                        value="Aspirin" 
                                        >
                                    Aspirin<br>

                                    <input type="checkbox" name="isAllergicTo[]" id="allergy_Latex"  class="text-danger border border-danger"
                                        value="Latex" 
                                       >
                                    Latex<br>

                                    <input type="checkbox" name="isAllergicTo[]" id="allergy_Penicilin" 
                                        value="Penicilin-Antibiotics" 
                                        >
                                    Penicilin, Antibiotics<br>

                                    <input type="checkbox" name="isAllergicTo[]" id="allergy_None" 
                                        value="None" 
                                        >
                                    None<br>

                                    <div class="mx-3 isFieldRequired">
                                        <div class="text-field-required mt-2">
                                            <span>Others, Specify</span>
                                        </div>
                                        <input type="text" name="isAllergicToTextInput" 
                                            class="medical-history-extra-field form-control form-control-sm bg-transparent" 
                                            value="">
                                    </div>
                                @endif

                                @if (!empty($patientHistory->allergy_others))
                                    <li>{{ $patientHistory->allergy_others }}</li>
                                @endif
                            </ul>
                        </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="surgery">Have you ever had serious illness or
                                surgical
                                operation?<sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-sm-12">
                            {{-- <p class="surgery">{{ $patientHistory->surgery ? 'Yes' : 'No' }}</p> --}}

                            <input type="radio" class="updateorcreate_had_surgery" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  value="yes" name="update_surgery" id=""
                                {{ $patientHistory->had_surgery === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" class="updateorcreate_had_surgery" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  value="no" name="update_surgery"
                                id=""{{ $patientHistory->had_surgery === 'no' ? 'checked' : '' }}>No
                            <div class="mx-3 isFieldRequired surgerytextcontainer {{$patientHistory->had_surgery ?? 'd-none'}}">
                                <div class="text-field-required">
                                <span class="">If so what Illness or Operation?</span>
                                    {{-- <p class="surgerytext">{{ $patientHistory->surgery_text ?? '' }}</p> --}}
                                </div>
                                <input type="text" style="border: none; border-bottom: 1px solid black; border-radius: 0;" 
                                class="form-control updateorcreate_surgery_text" 
                                name="updateorcreate_surgery_text" 
                                value="{{ $patientHistory->surgery_text ?? '' }}" 
                                id=""><sup class="text-danger">*</sup>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="isPregnant">Are you pregnant? <sup
                                    class="text-warning">(for women)</sup></label>
                        </div>
                        <div class="col-sm-12">
                            <input type="radio" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  value="yes" name="pregnant" id=""
                                {{ $patientHistory->pregnant === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  value="no" name="pregnant"
                                id=""{{ $patientHistory->pregnant === 'no' ? 'checked' : '' }}>No
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 my-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="hospital">Have you ever been
                                hospitalized?<sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-sm-12">
                            {{-- <p class="hospital">{{ $patientHistory->hospitalized ? 'Yes' : 'No' }}</p> --}}
                            <input type="radio" class="updateorcreate_hospitalized" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  value="yes" name="update_hospitalized" id=""
                                {{ $patientHistory->hospitalized === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" class="updateorcreate_hospitalized" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  value="no" name="update_hospitalized"
                                id=""{{ $patientHistory->hospitalized === 'no' ? 'checked' : '' }}>No

                            <div class="mx-3 isFieldRequired hostpitalizationtextcontainer {{ $patientHistory->hospitalized === 'yes' ? '' : 'd-none' }}">
                                <div class="text-field-required">
                                <span class="">If so why?</span>
                                    {{-- <p class="surgerytext">{{ $patientHistory->surgery_text ?? '' }}</p> --}}
                                </div>
                                <input type="text" style="border: none; border-bottom: 1px solid black; border-radius: 0;" 
                                class="form-control" 
                                name="updateorcreate_hospitalization_details" 
                                value="{{ $patientHistory->hospitalization_details ?? '' }}" 
                                id=""><sup class="text-danger">*</sup>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="isOnBithControl">Are you taking birth control
                                pills?
                                <sup class="text-warning">(for women)</sup></label>
                        </div>
                        <div class="col-sm-12">
                            {{-- <p class="isOnBithControl">
                                            {{ $patientHistory->taking_birth_control ? 'Yes' : 'No' }}</p> --}}
                            <input type="radio" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  value="yes" name="taking_birth_control" id=""
                                {{ $patientHistory->taking_birth_control === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  value="no" name="taking_birth_control"
                                id=""{{ $patientHistory->taking_birth_control === 'no' ? 'checked' : '' }}>No
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 my-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="prescription">Are you taking any
                                prescription/non-prescription medication?<sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-sm-12">
                            {{-- <p class="prescription">{{ $patientHistory->taking_medications ? 'Yes' : 'No' }}</p> --}}
                            <input type="radio" class="updateorcreate_taking_medications" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  value="yes" name="update_taking_medications" id=""
                                {{ $patientHistory->taking_medications === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" class="updateorcreate_taking_medications" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  value="no" name="update_taking_medications"
                                id=""{{ $patientHistory->taking_medications === 'no' ? 'checked' : '' }}>No
                            <div class="mx-3 isFieldRequired medicationsdetailscontainer {{ $patientHistory->taking_medications === 'yes' ? '' : 'd-none' }}">
                                <div class="text-field-required">
                                <span class="">If so what medications?</span>
                                    {{-- <p class="surgerytext">{{ $patientHistory->surgery_text ?? '' }}</p> --}}
                                </div>
                                <input type="text" style="border: none; border-bottom: 1px solid black; border-radius: 0;" 
                                class="form-control" 
                                name="updateorcreate_medications_details" 
                                value="{{ $patientHistory->medications_details ?? '' }}" 
                                id=""><sup class="text-danger">*</sup>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="isClientASmokeWhack">Do you use tobacco
                                products?<sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-sm-12">
                            <input type="radio" value="yes" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  name="using_tobacco" id=""
                                {{ $patientHistory->using_tobacco === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" value="no" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  name="using_tobacco"
                                id=""{{ $patientHistory->using_tobacco === 'no' ? 'checked' : '' }}>No
                            {{-- <p class="isClientASmokeWhack">{{ $patientHistory->using_tobacco ? 'Yes' : 'No' }} --}}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500
                        <label style=" font-weight: 500"
                                for="isClientNursing">Are you nursing? <sup class="text-warning">(for
                                    women)</sup></label>
                        </div>
                        <div class="col-sm-12">
                            <input type="radio" value="yes" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  name="nursing" id=""
                                {{ $patientHistory->nursing === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" value="no" style="pointer-events: {{ Auth::user()->Role !== 'Dentist' ? 'none' : 'auto' }}"  name="nursing"
                                id=""{{ $patientHistory->nursing === 'no' ? 'checked' : '' }}>No
                            {{-- <p class="isClientNursing">{{ $patientHistory->nursing ? 'Yes' : 'No' }}</p> --}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 mt-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="bloodType">Blood Type<sup class="text-danger">*</sup></label>
                        </div>
                        {{-- <div class="col-sm-12">
                            <p class="bloodType">{{ $patientHistory->blood_type ?? '' }}</p>
                        </div> --}}
                        <select name="createorupdate_bloodType" id="bloodType" class="form-select form-select-sm">
                            <option value="{{ $patientHistory->blood_type ?? '' }}" selected hidden>{{ $patientHistory->blood_type ?? '' }}</option>
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
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="createorupdate_bloodPressure">Blood Pressure<sup class="text-danger">*</sup></label>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" value="{{ $patientHistory->blood_pressure ?? '' }}" class="form-control form-control-sm" id="bloodPressure" name="createorupdate_bloodPressure" placeholder="e.g., 120/80 mmHg or n/a if unknown">
                            {{-- <p class="bloodPressure">{{ $patientHistory->blood_pressure ?? '' }}</p> --}}
                        </div>
                    </div>
                </div>

               
                 @php
    $knownConditions = json_decode($patientHistory->known_conditions, true); // Decode as array
    
@endphp

<div class="col-sm-12 my-4">
    <div class="row">
        <div class="col-sm-12">
            <label style="font-weight: 500">Do you have any known medical conditions?<sup class="text-danger">*</sup></label>
        </div>
        <div class="col-sm-12">
            <ul class="known-conditions">
                <div class="row">
    <!-- Column 1 -->
        <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="High Blood Pressure" id="highBP"
                {{ in_array('High Blood Pressure', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="highBP">High Blood Pressure</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Low Blood Pressure" id="lowBP"
                {{ in_array('Low Blood Pressure', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="lowBP">Low Blood Pressure</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Epilepsy/Convulsions" id="epilepsy"
                {{ in_array('Epilepsy/Convulsions', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="epilepsy">Epilepsy/Convulsions</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="AIDS or HIV Infection" id="hiv"
                {{ in_array('AIDS or HIV Infection', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="hiv">AIDS or HIV Infection</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Sexually Transmitted Disease" id="std"
                {{ in_array('Sexually Transmitted Disease', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="std">Sexually Transmitted Disease</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Stomach Troubles/Ulcers" id="ulcers"
                {{ in_array('Stomach Troubles/Ulcers', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="ulcers">Stomach Troubles/Ulcers</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Fainting Seizure" id="fainting"
                {{ in_array('Fainting Seizure', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="fainting">Fainting Seizure</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Rapid Weight Loss" id="weightLoss"
                {{ in_array('Rapid Weight Loss', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="weightLoss">Rapid Weight Loss</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Radiation Therapy" id="radiation"
                {{ in_array('Radiation Therapy', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="radiation">Radiation Therapy</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Joint Replacement/Implant" id="jointImplant"
                {{ in_array('Joint Replacement/Implant', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="jointImplant">Joint Replacement/Implant</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Heart Surgery" id="heartSurgery"
                {{ in_array('Heart Surgery', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="heartSurgery">Heart Surgery</label>
        </div>
    </div>

    <!-- Column 2 -->
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input bg-secondary" type="checkbox" name="illnesses[]" value="Heart Attack" id="heartAttack"
                {{ in_array('Heart Attack', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="heartAttack">Heart Attack</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Thyroid Problem" id="thyroid"
                {{ in_array('Thyroid Problem', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="thyroid">Thyroid Problem</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Heart Disease" id="heartDisease"
                {{ in_array('Heart Disease', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="heartDisease">Heart Disease</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Head Murmur" id="headMurmur"
                {{ in_array('Head Murmur', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="headMurmur">Head Murmur</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Hepatitis/Liver Disease" id="liverDisease"
                {{ in_array('Hepatitis/Liver Disease', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="liverDisease">Hepatitis/Liver Disease</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Rheumatic Fever" id="rheumatic"
                {{ in_array('Rheumatic Fever', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="rheumatic">Rheumatic Fever</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Hay Fever/Allergies" id="hayFever"
                {{ in_array('Hay Fever/Allergies', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="hayFever">Hay Fever/Allergies</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Respiratory Problems" id="respiratory"
                {{ in_array('Respiratory Problems', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="respiratory">Respiratory Problems</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Hepatitis/Jaundice" id="jaundice"
                {{ in_array('Hepatitis/Jaundice', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="jaundice">Hepatitis/Jaundice</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Tuberculosis" id="tuberculosis"
                {{ in_array('Tuberculosis', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="tuberculosis">Tuberculosis</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Swollen Ankles" id="ankles"
                {{ in_array('Swollen Ankles', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="ankles">Swollen Ankles</label>
        </div>
    </div>

    <!-- Column 3 -->
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Kidney Disease" id="kidney"
                {{ in_array('Kidney Disease', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="kidney">Kidney Disease</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Diabetes" id="diabetes"
                {{ in_array('Diabetes', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="diabetes">Diabetes</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Chest Problems" id="chest"
                {{ in_array('Chest Problems', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="chest">Chest Problems</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Stroke" id="stroke"
                {{ in_array('Stroke', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="stroke">Stroke</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Cancer/Tumors" id="cancer"
                {{ in_array('Cancer/Tumors', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="cancer">Cancer/Tumors</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Anemia" id="anemia"
                {{ in_array('Anemia', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="anemia">Anemia</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Angina" id="angina"
                {{ in_array('Angina', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="angina">Angina</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Asthma" id="asthma"
                {{ in_array('Asthma', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="asthma">Asthma</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Emphysema" id="emphysema"
                {{ in_array('Emphysema', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="emphysema">Emphysema</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Bleeding Problems" id="bleeding"
                {{ in_array('Bleeding Problems', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="bleeding">Bleeding Problems</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Blood Disease" id="bloodDisease"
                {{ in_array('Blood Disease', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="bloodDisease">Blood Disease</label>
        </div>
    </div>

    <!-- Column 4 -->
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Head Injuries" id="headInjuries"
                {{ in_array('Head Injuries', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="headInjuries">Head Injuries</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="Arthritis/Rheumatism" id="arthritis"
                {{ in_array('Arthritis/Rheumatism', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="arthritis">Arthritis/Rheumatism</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="illnesses[]" value="none" id="none"
                {{ in_array('None', $knownConditions ?? []) ? 'checked' : '' }}>
            <label class="form-check-label" for="none">None</label>
        </div>

        <!-- Other -->
        <div class="form-check d-flex align-items-center mt-2">
            <label class="form-check-label me-2" for="otherIllness">Others</label>
            <input type="text"
                class="form-control form-control-sm border-bottom border-dark rounded-0 bg-transparent medical-history-extra-field"
                placeholder="..." name="otherIllnessDetails" style="max-width: 150px;"
                value="{{ $patientHistory->known_condition_others ?? '' }}">
        </div>
    </div>
</div>

            </ul>
        </div>
    </div>
</div>
            </div>
            <hr class="my-4" style="border-top: 1px solid black; height: 1px;">
        </form>
        <div class="row">
            @if (Auth::user()->Role ==='Dentist')
            <div class="col-sm-12"><button class="btn btn-primary btn-sm fw-bold lead update-pt-md-history-btn">Update</button></div>
            @endif
        </div>
    </div>
</div>
