<div class="col-sm-12">
    <div class="medical-history-details">
        <p class="fw-bold">Patient History</p>
        <form action="" class="client-medical-history-form">
            <div class="row">
                <div class="col-sm-6">
                    <label for="previousdentist" class="form-label fw-semibold">Previous Dentist</label>
                    <input type="text" name="" disabled class="form-control" id=""
                        value="{{ $patientHistory->previous_dentist ?? 'N/A' }}">
                    {{-- <p class="previousdentist">{{ $patientHistory->previous_dentist ?? 'N/A' }}</p> --}}
                </div>
                <div class="col-sm-6">
                    <label for="allergies" class="form-label fw-semibold">Last Visit</label>
                    <input type="text" name="" disabled class="form-control" id=""
                        value="{{ $patientHistory->last_visit ?? 'N/A' }}">
                    {{-- <p class="lastvisit">{{ $patientHistory->last_visit ?? 'N/A' }}</p> --}}
                </div>
            </div>

            <hr class="my-4" style="border-top: 1px solid black; height: 1px;">

            <div class="row">
                <p class="fw-semibold h4 my-3">Medical History</p>
                <div class="col-4">
                    <label for="physician" class="fw-semibold">Name of Physician</label>
                    <input type="text" name="" disabled class="form-control" id=""
                        value="{{ $patientHistory->physician_name ?? 'N/A' }}">
                    {{-- <p class="physician">{{ $patientHistory->physician_name ?? 'N/A' }}</p> --}}
                </div>
                <div class="col-4">
                    <label for="specialty" class="fw-semibold">Specialty</label>
                    <input type="text" name="" disabled class="form-control" id=""
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
                    <input type="text" name="" disabled class="form-control" id=""
                        value="{{ $patientHistory->physician_office_address ?? 'N/A' }}">
                    {{-- <p class="officeaddress">{{ $patientHistory->physician_office_address ?? 'N/A' }}</p> --}}
                </div>
                <div class="col-4">
                    <label for="officeno" class="fw-semibold">Office No.</label>
                    <input type="text" name="" disabled class="form-control" id=""
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
                            <label style="font-weight: 500" for="goodhealth">Are you in good health?</label>
                        </div>
                        <div class="col-sm-12">
                            {{-- <p class="goodhealth">{{ $patientHistory->good_health ? 'Yes' : 'No'}}</p> --}}
                            <input type="radio" style="pointer-events: none;"
                                {{ $patientHistory->good_health === 'yes' ? '' : 'checked' }}> Yes
                            <br>
                            <input type="radio" style="pointer-events: none;"
                                {{ $patientHistory->good_health === 'no' ? 'checked' : '' }}> No

                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="alcohol">Do you use alcohol, cocaine, or other
                                dangerous drugs?</label>
                        </div>
                        <div class="col-sm-12">
                            {{-- <p class="alcohol">{{ $patientHistory->uses_drugs ? 'Yes' : 'No'}}</p> --}}
                            <input type="radio" style="pointer-events: none;" name="" id=""
                                {{ $patientHistory->uses_drugs === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" style="pointer-events: none;" name=""
                                id=""{{ $patientHistory->uses_drugs === 'no' ? '' : 'checked' }}>No
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 my-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="medicalcondition">Are you under medical
                                treatment
                                now?</label>
                        </div>
                        <div class="col-sm-12">
                            {{-- <p class="medicalcondition">{{ $patientHistory->under_medical_care ? 'Yes' : 'No'}}
                                        </p> --}}
                            <input type="radio" style="pointer-events: none;" name="" id=""
                                {{ $patientHistory->under_medical_care === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" style="pointer-events: none;" name=""
                                id=""{{ $patientHistory->under_medical_care === 'no' ? '' : 'checked' }}>No
                        </div>
                        @if ($patientHistory->under_medical_care)
                            <div class="mx-3 medicalconditiontext">{{ $patientHistory->medical_condition_text ?? '' }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-sm-6 my-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="isAllergicTo">Are you allergic to any of the
                                following?</label>
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
                                    @if (is_array($allergies) && count($allergies) > 0)
                                        @foreach ($allergies as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    @else
                                        <li>No known allergies</li>
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
                                operation?</label>
                        </div>
                        <div class="col-sm-12">
                            {{-- <p class="surgery">{{ $patientHistory->surgery ? 'Yes' : 'No' }}</p> --}}

                            <input type="radio" style="pointer-events: none;" name="" id=""
                                {{ $patientHistory->surgery === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" style="pointer-events: none;" name=""
                                id=""{{ $patientHistory->surgery === 'no' ? '' : 'checked' }}>No
                            <div class="mx-3 isFieldRequired surgerytextcontainer">
                                <div class="text-field-required">
                                    <p class="surgerytext">{{ $patientHistory->surgery_text ?? '' }}</p>
                                </div>
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
                            <input type="radio" style="pointer-events: none;" name="" id=""
                                {{ $patientHistory->pregnant === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" style="pointer-events: none;" name=""
                                id=""{{ $patientHistory->pregnant === 'no' ? '' : 'checked' }}>No
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 my-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="hospital">Have you ever been
                                hospitalized?</label>
                        </div>
                        <div class="col-sm-12">
                            {{-- <p class="hospital">{{ $patientHistory->hospitalized ? 'Yes' : 'No' }}</p> --}}
                            <input type="radio" style="pointer-events: none;" name="" id=""
                                {{ $patientHistory->hospitalization_details === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" style="pointer-events: none;" name=""
                                id=""{{ $patientHistory->hospitalization_details === 'no' ? '' : 'checked' }}>No

                            <div class="mx-3 isFieldRequired hospitaltextcontainer">
                                <div class="text-field-required">
                                    <p class="hospitaltext">{{ $patientHistory->hospitalization_details ?? '' }}
                                    </p>
                                </div>
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
                            <input type="radio" style="pointer-events: none;" name="" id=""
                                {{ $patientHistory->taking_birth_control === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" style="pointer-events: none;" name=""
                                id=""{{ $patientHistory->taking_birth_control === 'no' ? '' : 'checked' }}>No
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 my-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="prescription">Are you taking any
                                prescription/non-prescription medication?</label>
                        </div>
                        <div class="col-sm-12">
                            {{-- <p class="prescription">{{ $patientHistory->taking_medications ? 'Yes' : 'No' }}</p> --}}
                            <input type="radio" style="pointer-events: none;" name="" id=""
                                {{ $patientHistory->taking_medications === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" style="pointer-events: none;" name=""
                                id=""{{ $patientHistory->taking_medications === 'no' ? '' : 'checked' }}>No
                            <div class="mx-3">
                                <div class="text-field-required">
                                </div>
                                <p class="prescriptiontext">{{ $patientHistory->medications_details ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="isClientASmokeWhack">Do you use tobacco
                                products?</label>
                        </div>
                        <div class="col-sm-12">
                            <input type="radio" style="pointer-events: none;" name="" id=""
                                {{ $patientHistory->using_tobacco === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" style="pointer-events: none;" name=""
                                id=""{{ $patientHistory->using_tobacco === 'no' ? '' : 'checked' }}>No
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
                            <input type="radio" style="pointer-events: none;" name="" id=""
                                {{ $patientHistory->nursing === 'yes' ? 'checked' : '' }}>Yes
                            <br>
                            <input type="radio" style="pointer-events: none;" name=""
                                id=""{{ $patientHistory->nursing === 'no' ? '' : 'checked' }}>No
                            {{-- <p class="isClientNursing">{{ $patientHistory->nursing ? 'Yes' : 'No' }}</p> --}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 mt-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="bloodType">Blood Type</label>
                        </div>
                        <div class="col-sm-12">
                            <p class="bloodType">{{ $patientHistory->blood_type ?? '' }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 mt-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style="font-weight: 500" for="bloodPressure">Blood Pressure</label>
                        </div>
                        <div class="col-sm-12">
                            <p class="bloodPressure">{{ $patientHistory->blood_pressure ?? '' }}</p>
                        </div>
                    </div>
                </div>
                 @php
    $knownConditions = json_decode($patientHistory->known_condition, true); // Decode as array
@endphp

<div class="col-sm-6 my-4">
    <div class="row">
        <div class="col-sm-12">
            <label style="font-weight: 500">Do you have any known medical conditions?</label>
        </div>
        <div class="col-sm-12">
            <ul class="known-conditions">
                @if (is_array($knownConditions) && count($knownConditions) > 0 && !(count($knownConditions) === 1 && $knownConditions[0] === 'none'))
                    @foreach ($knownConditions as $condition)
                        <li>{{ $condition }}</li>
                    @endforeach
                @else
                    <li>No known condition</li>
                @endif

                @if (!empty($patientHistory->known_condition_others))
                    <li>{{ $patientHistory->known_condition_others }}</li>
                @endif
            </ul>
        </div>
    </div>
</div>
            </div>
            <hr class="my-4" style="border-top: 1px solid black; height: 1px;">
        </form>
    </div>
</div>
