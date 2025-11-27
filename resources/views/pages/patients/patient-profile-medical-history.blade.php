@extends('dashboard')

@section('content')
<div class="container-fluid pt-5 bg-light">
    <div class="container py-4">

        <div>
    <div class="" style="border-top: 5px solid black;">

        <h2 class="fw-boldx py-3">Dental History:</h2>
        <form action="" class="client-medical-history-form">
            <div class="row">
                <div class="col-sm-6 d-flex align-items-center">
                    <label for="previousdentist" class="form-label fw-normal">Previous Dentist: </label>
                    <p class="previousdentist border-bottom flex-grow-1 mt-1 mx-2 small">{{ $patientHistory->previous_dentist ?? '—' }}</p>
                </div>
                <div class="col-sm-12"></div>
                <div class="col-sm-6 d-flex align-items-center" style="">
                    <label for="allergies" class="form-label fw-normal">Last Visit:</label>
                    <p class="lastvisit border-bottom flex-grow-1 mt-1 mx-2 small">{{ $patientHistory->last_visit ?? '—' }}</p>
                </div>
            </div>

            <div class="my-4" style="border-top: 5px solid black; height: 1px;"></div>

            <div class="row">
                <p class="fw-semibold h4 my-3">Medical History</p>
                <div class="col-sm-6 d-flex align-items-center">
                    <label for="physician" class="fw-normal">Name of Physician:</label>
                    <p class="physician border-bottom flex-grow-1 mt-1 mx-2 small">{{ $patientHistory->physician_name ?? '—' }}</p>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-4 d-flex align-items-center">
                    <label for="specialty" class="fw-normal">Specialty</label>
                    <p class="specialty border-bottom flex-grow-1 mt-1 mx-2 small">{{ $patientHistory->physician_specialty ?? '—' }}</p>
                </div>
                <div class="col-4">
                    {{-- for spacing --}}
                </div>
            </div>

            <div class="row my-4 mt-5">
                <div class="col-6 d-flex align-items-center">
                    <label for="officeaddress" class="fw-normal">Office Address:</label>
                    <p class="officeaddress border-bottom flex-grow-1 mt-1 mx-2 small">{{ $patientHistory->physician_office_address ?? '—' }}</p>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-4 d-flex align-items-center">
                    <label for="officeno" class="fw-normal">Office No:</label>
                    <p class="officeno border-bottom flex-grow-1 mt-1 mx-2 small">{{ $patientHistory->physician_office_no ?? '—' }}</p>
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
                            <p class="goodhealth">{{ $patientHistory->good_health ?? '—' }}</p>
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
                            <p class="alcohol">{{ $patientHistory->uses_drugs ?? '—' }}</p>
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
                                <p class="medicalconditiontext border-bottom flex-grow-1 mt-2 mx-2 small">{{ $patientHistory->medical_condition_text}}</p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <p class="medicalcondition">{{ $patientHistory->under_medical_care }}</p>
                        </div>

                        {{-- <div class="mx-3 m-0 medicalconditiontext small"></div> --}}
                    </div>
                </div>

                {{-- <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-10">
                            <label style="font-weight: normal;" for="isAllergicTo">Are you allergic to any of the
                                following? </label>
                        </div>
                        <div class="col-sm-2">
                            <ul class="allergies"></ul>
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
                                <p class="hospitaltext border-bottom flex-grow-1 mt-2 mx-2 small">{{ $patientHistory->hospitalization_details }}</p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <p class="hospital">{{ $patientHistory->hospitalized }}</p>
                        </div>
                        {{-- <div class="mx-3 isFieldRequired hospitaltextcontainer">
                            <div class="text-field-required">
                                <p class="hospitaltext"></p>
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
                                <p class="prescriptiontext border-bottom flex-grow-1 mt-2 mx-2 small">{{ $patientHistory->medications_details }}</p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <p class="prescription">{{ $patientHistory->taking_medications }}</p>
                        </div>
                        {{-- <div class="mx-3">
                            <div class="text-field-required">
                            </div>
                            <p class="prescriptiontext small"></p>
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
                            <p class="isClientASmokeWhack">{{ $patientHistory->using_tobacco }}</p>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-10">
                            <label style="font-weight: normal;" for="alcohol">7.Do you use alcohol, cocaine, or other
                                dangerous drugs?</label>
                        </div>
                        <div class="col-sm-2">
                            <p class="alcohol"></p>
                        </div>
                    </div>
                </div> --}}

                <div class="col-sm-12">
    <div class="row">
        <div class="col-sm-10">
            <label style="font-weight: normal;" for="isAllergicTo">
                7. Are you allergic to any of the following?
            </label>
        </div>

        <div class="col-sm-2">
            <ul class="allergies" style="padding-left: 18px; margin: 0;">
                @php
                    $allergies = $patientHistory->allergy_others
                        ? json_decode($patientHistory->allergy_others, true)
                        : [];
                @endphp

                @forelse($allergies as $item)
                    <li>{{ $item }}</li>
                @empty
                    <li>None</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>


                <div class="col-sm-12">
                    <div class="row">
                        <span class="fw-semibold">8.Fow women only:</span>
                        <div class="col-sm-3 mx-5">
                            <label style="font-weight: normal;" for="isPregnant">Are you pregnant? </label>
                        </div>
                        <div class="col-sm-6">
                            <p class="isPregnant">{{ $patientHistory->pregnant }}</p>
                        </div>
                        <div class="col-sm-3 mx-5">
                            <label style="font-weight: normal" for="isClientNursing">Are you nursing? </label>
                        </div>
                        <div class="col-sm-6">
                            <p class="isClientNursing">{{ $patientHistory->nursing }}</p>
                        </div>
                        <div class="col-sm-3 mx-5">
                            <label style="font-weight: normal" for="isOnBithControl">Are you taking birth control
                                pills? </label>
                        </div>
                        <div class="col-sm-6">
                            <p class="isOnBithControl">{{ $patientHistory->taking_birth_control }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 d-flex align-items-center">
                    <label style="font-weight: normal;" for="bloodType">19.Blood Type: </label>
                    <p class="bloodType border-bottom flex-grow-1 mt-1 mx-2 small">{{ $patientHistory->blood_type }}</p>
                </div>
                <div class="col-sm-6"></div>
                <div class="col-sm-6 d-flex align-items-center">
                    <label style="font-weight: normal;" for="bloodPressure">10.Blood Pressure</label>
                    <p class="bloodPressure border-bottom flex-grow-1 mt-1 mx-2 small">{{ $patientHistory->blood_pressure }}</p>
                </div>




               <div class="row">
    <div class="col-sm-12">
        <p class="fw-semibold my-3">11. Do you have or had any of the following?</p>
        <ul class="ps-3 known-illnesses" style="padding-left: 18px; margin: 0;">
            @php
                $illnesses = $patientHistory->known_conditions
                    ? json_decode($patientHistory->known_conditions, true)
                    : [];
            @endphp

            @forelse($illnesses as $illness)
                <li>{{ $illness }}</li>
            @empty
                <li>None</li>
            @endforelse
        </ul>
    </div>
</div>

                {{-- <div class="row mt-4">
                <div class="col-sm-12">
                    <p class="fw-semibold h4 my-3">Allergies</p>
                    <ul class="ps-3 allergies">

                    </ul>
                </div>
            </div> --}}
        </form>
    </div>

    </div>
</div>
@endsection

       
