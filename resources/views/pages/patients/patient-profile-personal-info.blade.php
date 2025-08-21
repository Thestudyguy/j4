<div class="col-sm-12">
    <p class="client-info fw-bold pt-5 mt-5">Personal Info </p>
    <form action="" class="client-personal-info-form">
        <div class="row">
            <div class="col-sm-12 p-3">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="lastname" class="form-label fw-semibold">Last Name</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->LastName ?? 'N/A' }}">
                        {{-- <p class='lastname'>{{ $patient->LastName }}</p> --}}
                    </div>
                    <div class="col-sm-4">
                        <label for="firstname" class="form-label fw-semibold">First Name</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->FirstName ?? 'N/A' }}">
                        <p class='firstname'>{{ $patient->FirstName }}</p>
                    </div>
                    <div class="col-sm-4">
                        <label for="middlename" class="form-label fw-semibold">Middle Name</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->MiddleName ?? 'N/A' }}">
                        {{-- <p class='middlename'>{{ $patient->MiddleName ?? 'N/A' }}</p> --}}
                    </div>
                </div>
            </div>

            <div class="col-sm-12 p-3">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="birthdate" class="form-label fw-semibold">Birthdate</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->Birthdate ?? 'N/A' }}">
                        {{-- <p class='birthdate'>{{ $patient->Birthdate ?? 'N/A' }}</p> --}}
                    </div>
                    <div class="col-sm-4 client-sex-field-preview">
                        <label for="sex" class="form-label fw-semibold">Sex</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->Gender ?? 'N/A' }}">
                        {{-- <p class='sex'>{{ $patient->Gender }}</p> --}}
                    </div>
                    <div class="col-sm-4">
                        <label for="age" class="form-label fw-semibold">Age</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->Age ?? 'N/A' }}">
                        {{-- <p class='age'>{{ $patient->Age }}</p> --}}
                    </div>
                </div>
            </div>

            <div class="col-sm-12 p-3">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="religion" class="form-label fw-semibold">Religion</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->Religion ?? 'N/A' }}">
                        {{-- <p class="religion">{{ $patient->Religion ?? 'N/A' }}</p> --}}
                    </div>
                    <div class="col-sm-4">
                        <label for="nationality" class="form-label fw-semibold">Nationality</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->Nationality ?? 'N/A' }}">
                        {{-- <p class='nationality'>{{ $patient->Nationality }}</p> --}}
                    </div>
                    <div class="col-sm-4">
                        <label for="nickname" class="form-label fw-semibold">Nickname</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->NickName ?? 'N/A' }}">
                        {{-- <p class='nickname'>{{ $patient->NickName }}</p> --}}
                    </div>
                </div>
            </div>

            <div class="col-sm-12 p-3">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="address" class="form-label fw-semibold">Address</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->Address ?? 'N/A' }}">
                        {{-- <p class='address'>{{ $patient->Address }}</p> --}}
                    </div>
                    <div class="col-sm-6">
                        <label for="homeno" class="form-label fw-semibold">Home No.</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->HomeNo ?? 'N/A' }}">
                        {{-- <p class='homeno'>{{ $patient->HomeNo }}</p> --}}
                    </div>
                </div>
            </div>

            <div class="col-sm-12 p-3">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="occupation" class="form-label fw-semibold">Occupation</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->Occupation ?? 'N/A' }}">
                        {{-- <p class='occupation'>{{ $patient->Occupation }}</p> --}}
                    </div>
                    <div class="col-sm-3">
                        <label for="officeno" class="form-label fw-semibold">Office No.</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->OfficeNo ?? 'N/A' }}">
                        {{-- <p class='officeno'>{{ $patient->OfficeNo ?? 'N/A' }}</p> --}}
                    </div>
                    <div class="col-sm-3">
                        <label for="effectivedate" class="form-label fw-semibold">Effective Date</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->EffectiveDate ?? 'N/A' }}">
                        {{-- <p class='effectivedate'>{{ $patient->EffectiveDate ?? 'N/A' }}</p> --}}
                    </div>
                    <div class="col-sm-3">
                        <label for="faxno" class="form-label fw-semibold">Fax No.</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->FaxNo ?? 'N/A' }}">
                        {{-- <p class='faxno'>{{ $patient->FaxNo ?? 'N/A' }}</p> --}}
                    </div>
                </div>
            </div>

            <div class="col-sm-12 p-3">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->Email ?? 'N/A' }}">
                        {{-- <p class='email'>{{ $patient->Email ?? 'N/A' }}</p> --}}
                    </div>
                    <div class="col-sm-6">
                        <label for="mobileno" class="form-label fw-semibold">Mobile No.</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->MobileNo ?? 'N/A' }}">
                        {{-- <p class='mobileno'>{{ $patient->MobileNo ?? 'N/A' }}</p> --}}
                    </div>
                </div>
            </div>

            <div class="col-sm-12 p-3 for-minor">
                <hr style="height: 1px; background-color: black; border: none;" class="mt-5">
                <p class="fw-semibold" style="font-style: italic">For Minors</p>
                <div class="row">
                    <div class="col-sm-6">
                        <label for="guardian" class="form-label fw-semibold">Parent/Guardian Name</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->Guardian ?? 'N/A' }}">
                        {{-- <p class='guardian'>{{ $patient->Guardian ?? 'N/A' }}</p> --}}
                    </div>
                    <div class="col-sm-6">
                        <label for="guardianoccupation" class="form-label fw-semibold">Occupation</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->Occupation ?? 'N/A' }}">
                        {{-- <p class='guardianoccupation'></p> --}}
                    </div>
                    <div class="col-sm-12 my-5">
                        <label for="referal" class="form-label fw-semibold">Who may we thank for referring
                            you?</label>
                        <input type="text" name="" disabled class="form-control" id=""
                            value="{{ $patient->Referal ?? 'N/A' }}">
                        {{-- <p class="referal">{{ $patient->Referal ?? 'N/A' }}</p> --}}
                    </div>
                    <div class="col-sm-12">
                        <label for="consultation" class="form-label fw-semibold">Reason for Consultation</label>
                        <textarea name="" class="form-control" disabled id="" cols="30" rows="10">{{ $patient->ReasonForVisit ?? 'N/A' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
