@extends('dashboard')
@section('content')
    <div class="container p-3">
        <p class="client-info fw-bold pt-5 mt-5">Personal Info</p>
        <form action="" class="client-personal-info-form">
            <div class="row">
                <div class="col-sm-12 p-3">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="lastname" class="form-label fw-semibold">Last Name</label>
                            <p class='lastname'>{{ $patient->LastName }}</p>
                        </div>
                        <div class="col-sm-4">
                            <label for="firstname" class="form-label fw-semibold">First Name</label>
                            <p class='firstname'>{{ $patient->FirstName }}</p>
                        </div>
                        <div class="col-sm-4">
                            <label for="middlename" class="form-label fw-semibold">Middle Name</label>
                            <p class='middlename'>{{ $patient->MiddleName ?? '--\--' }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 p-3">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="birthdate" class="form-label fw-semibold">Birthdate</label>
                            <p class='birthdate'>{{ $patient->Birthdate ?? '--\--' }}</p>
                        </div>
                        <div class="col-sm-4 client-sex-field-preview">
                            <label for="sex" class="form-label fw-semibold">Sex</label>
                            <p class='sex'>{{ $patient->Gender }}</p>
                        </div>
                        <div class="col-sm-4">
                            <label for="age" class="form-label fw-semibold">Age</label>
                            <p class='age'>{{ $patient->Age }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 p-3">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="religion" class="form-label fw-semibold">Religion</label>
                            <p class="religion">{{ $patient->Religion ?? '--\--'  }}</p>
                        </div>
                        <div class="col-sm-4">
                            <label for="nationality" class="form-label fw-semibold">Nationality</label>
                            <p class='nationality'>{{ $patient->Nationality }}</p>
                        </div>
                        <div class="col-sm-4">
                            <label for="nickname" class="form-label fw-semibold">Nickname</label>
                            <p class='nickname'>{{ $patient->NickName }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 p-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="address" class="form-label fw-semibold">Address</label>
                            <p class='address'>{{ $patient->Address }}</p>
                        </div>
                        <div class="col-sm-6">
                            <label for="homeno" class="form-label fw-semibold">Home No.</label>
                            <p class='homeno'>{{ $patient->HomeNo }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 p-3">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="occupation" class="form-label fw-semibold">Occupation</label>
                            <p class='occupation'>{{ $patient->Occupation }}</p>
                        </div>
                        <div class="col-sm-3">
                            <label for="officeno" class="form-label fw-semibold">Office No.</label>
                            <p class='officeno'>{{ $patient->OfficeNo ?? '--\--'  }}</p>
                        </div>
                        <div class="col-sm-3">
                            <label for="effectivedate" class="form-label fw-semibold">Effective Date</label>
                            <p class='effectivedate'>{{ $patient->EffectiveDate ?? '--\--'  }}</p>
                        </div>
                        <div class="col-sm-3">
                            <label for="faxno" class="form-label fw-semibold">Fax No.</label>
                            <p class='faxno'>{{ $patient->FaxNo ?? '--\--'  }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 p-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <p class='email'>{{ $patient->Email ?? '--\--'  }}</p>
                        </div>
                        <div class="col-sm-6">
                            <label for="mobileno" class="form-label fw-semibold">Mobile No.</label>
                            <p class='mobileno'>{{ $patient->MobileNo ?? '--\--'  }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 p-3 for-minor">
                    <hr style="height: 1px; background-color: black; border: none;" class="mt-5">
                    <p class="fw-semibold" style="font-style: italic">For Minors</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="guardian" class="form-label fw-semibold">Parent/Guardian Name</label>
                            <p class='guardian'>{{ $patient->Guardian ?? '--\--'  }}</p>
                        </div>
                        <div class="col-sm-6">
                            <label for="guardianoccupation" class="form-label fw-semibold">Occupation</label>
                            <p class='guardianoccupation'></p>
                        </div>
                        <div class="col-sm-12 my-5">
                            <label for="referal" class="form-label fw-semibold">Who may we thank for referring you?</label>
                            <p class="referal">{{ $patient->Referal ?? '--\--'  }}</p>
                        </div>
                        <div class="col-sm-12">
                            <label for="consultation" class="form-label fw-semibold">Reason for Consultation</label>
                            <p class="consultationreason">{{ $patient->ReasonForVisit ?? '--\--'  }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <hr class="my-4" style="border-top: 1px solid black; height: 1px;">
        <div class="medical-history-details">
            <p class="fw-bold">Patient History</p>
            <form action="" class="client-medical-history-form">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="previousdentist" class="form-label fw-semibold">Previous Dentist</label>
                        <p class="previousdentist">{{ $patientHistory->previous_dentist ?? '--\--' }}</p>
                    </div>
                    <div class="col-sm-6">
                        <label for="allergies" class="form-label fw-semibold">Last Visit</label>
                        <p class="lastvisit">{{ $patientHistory->last_visit ?? '--\--' }}</p>
                    </div>
                </div>

                <hr class="my-4" style="border-top: 1px solid black; height: 1px;">

                <div class="row">
                    <p class="fw-semibold h4 my-3">Medical History</p>
                    <div class="col-4">
                        <label for="physician" class="fw-semibold">Name of Physician</label>
                        <p class="physician">{{ $patientHistory->physician_name ?? '--\--' }}</p>
                    </div>
                    <div class="col-4">
                        <label for="specialty" class="fw-semibold">Specialty</label>
                        <p class="specialty">{{ $patientHistory->physician_specialty ?? '--\--' }}</p>
                    </div>
                    <div class="col-4">
                        {{-- for spacing --}}
                    </div>
                </div>

                <div class="row my-4 mt-5">
                    <div class="col-4">
                        <label for="officeaddress" class="fw-semibold">Office Address</label>
                        <p class="officeaddress">{{ $patientHistory->physician_office_address ?? '--\--' }}</p>
                    </div>
                    <div class="col-4">
                        <label for="officeno" class="fw-semibold">Office No.</label>
                        <p class="officeno">{{ $patientHistory->physician_office_no ?? '--\--' }}</p>
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
                                <p class="goodhealth">{{ $patientHistory->good_health ? 'Yes' : 'No'}}</p>
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
                                <p class="alcohol">{{ $patientHistory->uses_drugs ? 'Yes' : 'No'}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 my-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <label style="font-weight: 500" for="medicalcondition">Are you under medical treatment
                                    now?</label>
                            </div>
                            <div class="col-sm-12">
                                <p class="medicalcondition">{{ $patientHistory->under_medical_care ? 'Yes' : 'No'}}</p>
                            </div>
                            @if($patientHistory->under_medical_care)
                                <div class="mx-3 medicalconditiontext">{{ $patientHistory->medical_condition_text }}</div>
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

                                <div class="col-sm-12">
                                    <label style="font-weight: 500" for="isAllergicTo">Are you allergic to any of the
                                        following?</label>
                                </div>
                                <div class="col-sm-12">
                                    <ul class="allergies">
                                        @if(is_array($allergies) && count($allergies) > 0)
                                            @foreach($allergies as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        @else
                                            <li>No known allergies</li>
                                        @endif

                                        @if(!empty($patientHistory->allergy_others))
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
                                <label style="font-weight: 500" for="surgery">Have you ever had serious illness or surgical
                                    operation?</label>
                            </div>
                            <div class="col-sm-12">
                                <p class="surgery">{{ $patientHistory->surgery ?? '' }}</p>
                                <div class="mx-3 isFieldRequired surgerytextcontainer">
                                    <div class="text-field-required">
                                        <p class="surgerytext"></p>
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
                                <p class="isPregnant"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 my-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <label style="font-weight: 500" for="hospital">Have you ever been hospitalized?</label>
                            </div>
                            <div class="col-sm-12">
                                <p class="hospital"></p>
                                <div class="mx-3 isFieldRequired hospitaltextcontainer">
                                    <div class="text-field-required">
                                        <p class="hospitaltext"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <label style="font-weight: 500" for="isOnBithControl">Are you taking birth control pills?
                                    <sup class="text-warning">(for women)</sup></label>
                            </div>
                            <div class="col-sm-12">
                                <p class="isOnBithControl"></p>
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
                                <p class="prescription"></p>
                                <div class="mx-3">
                                    <div class="text-field-required">
                                    </div>
                                    <p class="prescriptiontext"></p>
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
                                <p class="isClientASmokeWhack"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <label style="font-weight: 500
                    <label style=" font-weight: 500" for="isClientNursing">Are you nursing? <sup class="text-warning">(for
                                        women)</sup></label>
                            </div>
                            <div class="col-sm-12">
                                <p class="isClientNursing"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mt-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <label style="font-weight: 500" for="bloodType">Blood Type</label>
                            </div>
                            <div class="col-sm-12">
                                <p class="bloodType"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 mt-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <label style="font-weight: 500" for="bloodPressure">Blood Pressure</label>
                            </div>
                            <div class="col-sm-12">
                                <p class="bloodPressure"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4" style="border-top: 1px solid black; height: 1px;">

                <div class="row">
                    <div class="col-sm-12">
                        <p class="fw-semibold h4 my-3">Known Illnesses</p>
                        <ul class="ps-3 known-illnesses">

                        </ul>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-sm-12">
                        <p class="fw-semibold h4 my-3">Allergies</p>
                        <ul class="ps-3 allergies">

                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection