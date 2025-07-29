@extends('dashboard')
@section('content')

    <div class="container bg-light">
        <div class="container-fluid pt-5 bg-light py-5 mt-3">


            <div class="container py-4">
                <h4 class="fw-bold text-dark mb-4 text-left">My Profile</h4>
                <div class="row p-2 rounded-2 mb-2" style="background: #f0f0f0;">
                    <div class="col-sm-2 text-sm">Date</div>
                    <div class="col-sm-2 text-sm">Time</div>
                    <div class="col-sm-2 text-sm">Dentist</div>
                    <div class="col-sm-2 text-sm">Procedure</div>
                    <div class="col-sm-2 text-sm">Status</div>

                </div>
            </div>
            @foreach($prepAppointment as $appt)
                <div class="row p-2 rounded-2 my-2 text-sm" style="background: #f0f0f0;">
                    <div class="col-sm-2 text-sm">{{ $appt->Date }}</div>
                    <div class="col-sm-2 text-sm">{{ $appt->Time }}</div>
                    <div class="col-sm-2 text-sm">{{ $appt->title }} {{ $appt->dfName }} {{ $appt->dlname }}</div>
                    <div class="col-sm-2 text-sm">{{ $appt->service }}</div>
                    <div class="col-sm-2 text-sm"><span class="badge bg-warning" style="cursor: pointer;"
                            data-bs-target="#update-appointment-{{ $appt->id }}"
                            data-bs-toggle="modal">{{ $appt->status }}</span></div>
                    <!-- <div class="col-sm-2 text-sm text-center mt-2">

                                    </div> -->

                    @include('modals.patient-appointment-update-modal')
            @endforeach

            </div>
        </div>
        <hr class="my-4" style="border-top: 1px solid black; height: 1px;">
        <div class="container-title fw-semibold lead mb-3">Due Payments</div>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header text-dark fw-bold">
                        Services Availed
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @forelse($prepAppointment as $appointment)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $appointment->service }}
                                    <span class="badge bg-success rounded-pill">
                                        ₱{{ number_format($appointment->price, 2) }}
                                    </span>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">No services availed.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="card-footer bg-light fw-bold d-flex justify-content-between">
                        Total Due:
                        <span>₱{{ number_format($patientDuePayments, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
<hr class="my-4" style="border-top: 1px solid black; height: 1px;">
        <div class="row">
            <p class="fw-semibold lead">Patient Information</p>
            <div class="col-sm-6">
                <p class="client-info fw-bold pt-5 mt-5">Personal Info <sup><i
                            class="fas fa-pen text-success mx-1"></i></sup></p>
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
                                    <label for="referal" class="form-label fw-semibold">Who may we thank for referring
                                        you?</label>
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
            </div>
            <div class="col-sm-6 border-start ps-3">
                <div class="medical-history-details">
                    <p class="fw-bold">Patient History <sup><i class="fas fa-pen text-success"></i></sup></p>
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
                                        <label style="font-weight: 500" for="medicalcondition">Are you under medical
                                            treatment
                                            now?</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="medicalcondition">{{ $patientHistory->under_medical_care ? 'Yes' : 'No'}}
                                        </p>
                                    </div>
                                    @if($patientHistory->under_medical_care)
                                        <div class="mx-3 medicalconditiontext">{{ $patientHistory->medical_condition_text }}
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

                                        <div class="col-sm-12">
                                            <label style="font-weight: 500" for="isAllergicTo">Are you allergic to any of
                                                the
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
                                        <label style="font-weight: 500" for="surgery">Have you ever had serious illness or
                                            surgical
                                            operation?</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="surgery">{{ $patientHistory->surgery ? 'Yes' : 'No' }}</p>
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
                                        <p class="isPregnant">{{ $patientHistory->pregnant ? 'Yes' : 'No' }}</p>
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
                                        <p class="hospital">{{ $patientHistory->hospitalized ? 'Yes' : 'No' }}</p>
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
                                        <p class="isOnBithControl">
                                            {{ $patientHistory->taking_birth_control ? 'Yes' : 'No' }}</p>
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
                                        <p class="prescription">{{ $patientHistory->taking_medications ? 'Yes' : 'No' }}</p>
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
                                        <p class="isClientASmokeWhack">{{ $patientHistory->using_tobacco ? 'Yes' : 'No' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label style="font-weight: 500
                        <label style=" font-weight: 500" for="isClientNursing">Are you nursing? <sup
                                                class="text-warning">(for
                                                women)</sup></label>
                                    </div>
                                    <div class="col-sm-12">
                                        <p class="isClientNursing">{{ $patientHistory->nursing ? 'Yes' : 'No' }}</p>
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
                        </div>

                        <hr class="my-4" style="border-top: 1px solid black; height: 1px;">

                        <!-- <div class="row">
                        <div class="col-sm-12">
        <p class="fw-semibold h4 my-3">Known Illnesses</p>
        <ul class="ps-3 known-illnesses">
        <li>{{ $patientHistory->allergy}}</li>

        @if(!empty($patientHistory->allergy_others))
            <li>{{ $patientHistory->allergy_others }}</li>
        @endif
    </ul>
    </div>

                    </div> -->

                        <!-- <div class="row mt-4">
                        <div class="col-sm-12">
                            <p class="fw-semibold h4 my-3">Allergies</p>
                            <ul class="ps-3 allergies">

                            </ul>
                        </div>
                    </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection