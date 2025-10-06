<p class="client-info fw-bold pt-5 mt-5">Personal Info</p>
        <form action="" class="edit-patient-personal-info-form" id="{{ $patient->id }}">
            <input type="hidden" name="patient-id" value="{{ $patient->id }}">
            <div class="row">
                <div class="col-sm-12 p-3">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="lastname" class="form-label fw-semibold">Last Name</label>
                            {{-- <p class='lastname'>{{ $patient->LastName }}</p> --}}
                            <input type="text" class="form-control" name="patient-lastname" id=""
                                value="{{ $patient->LastName }}"{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                        </div>
                        <div class="col-sm-4">
                            <label for="firstname" class="form-label fw-semibold">First Name</label>
                            <input type="text" class="form-control" name="patient-firstname" id=""
                                value="{{ $patient->FirstName }}"{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                            {{-- <p class='firstname'>{{ $patient->FirstName }}</p> --}}
                        </div>
                        <div class="col-sm-4">
                            <label for="middlename" class="form-label fw-semibold">Middle Name</label>
                            <input type="text" class="form-control" name="patient-middlename" id=""
                                value="{{ $patient->MiddleName }}"{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                            {{-- <p class='middlename'>{{ $patient->MiddleName ?? '--\--' }}</p> --}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 p-3">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="birthdate" class="form-label fw-semibold">Birthdate</label>
                            {{-- <p class='birthdate'>{{ $patient->Birthdate ?? '--\--' }}</p> --}}
                            <input type="date" class="form-control birthdate-field-update" name="birthdate"
                                id="" value="{{ $patient->BirthDate }}"{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                        </div>
                        <div class="col-sm-4 client-sex-field-preview">
                            <label for="sex" class="form-label fw-semibold">Sex</label>
                            {{-- <p class='sex'>{{ $patient->Gender }}</p> --}}
                            {{-- <input type="radio" name="sex" value="male" {{ $patient->Gender === 'Male' ? 'checked' : '' }}>
                            <br><input type="radio" name="sex" value="female" {{ $patient->Gender === 'Female' ? 'checked' : '' }}> --}}
                            <div class="row p-2 sex-container"><!-- goffy ahh class name -->
                                <div class="col-sm-6"><input type="radio" name="sex" value="Male"
                                        {{ $patient->Gender === 'Male' ? 'checked' : '' }} style="pointer-events: {{Auth::user()->Role === 'Admin' ? 'none' : ''}}">Male</div>
                                <div class="col-sm-6"><input type="radio" name="sex" value="Female"
                                        {{ $patient->Gender === 'Female' ? 'checked' : '' }} style="pointer-events: {{Auth::user()->Role === 'Admin' ? 'none' : ''}}">Female</div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="age" class="form-label fw-semibold">Age</label>
                            {{-- <p class='age'>{{ $patient->Age }}</p> --}}
                            <input type="text" class="form-control age-field-update" name="age" id=""
                                style="pointer-events: none;" value="{{ $patient->Age }}"{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 p-3">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="religion" class="form-label fw-semibold">Religion</label>
                            {{-- <p class="religion">{{ $patient->Religion ?? '--\--'  }}</p> --}}
                            <input type="text" name="religion" value="{{ $patient->Religion }}" class="form-control"
                                id=""{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                        </div>
                        <div class="col-sm-4">
                            <label for="nationality" class="form-label fw-semibold">Nationality</label>
                            {{-- <p class='nationality'>{{ $patient->Nationality }}</p> --}}
                            <select name="nationality" class="form-control" id="" style="pointer-events: {{Auth::user()->Role !== 'Staff' ? 'none' : ''}}">
                                <option value="{{ $patient->Nationality }}" selected hidden>{{ $patient->Nationality }}
                                </option>
                                <option value="Afghan">Afghan</option>
                                <option value="Albanian">Albanian</option>
                                <option value="Algerian">Algerian</option>
                                <option value="American">American</option>
                                <option value="Andorran">Andorran</option>
                                <option value="Angolan">Angolan</option>
                                <option value="Antiguan">Antiguan</option>
                                <option value="Argentine">Argentine</option>
                                <option value="Armenian">Armenian</option>
                                <option value="Australian">Australian</option>
                                <option value="Austrian">Austrian</option>
                                <option value="Azerbaijani">Azerbaijani</option>
                                <option value="Bahamian">Bahamian</option>
                                <option value="Bahraini">Bahraini</option>
                                <option value="Bangladeshi">Bangladeshi</option>
                                <option value="Barbadian">Barbadian</option>
                                <option value="Belarusian">Belarusian</option>
                                <option value="Belgian">Belgian</option>
                                <option value="Belizean">Belizean</option>
                                <option value="Beninese">Beninese</option>
                                <option value="Bhutanese">Bhutanese</option>
                                <option value="Bolivian">Bolivian</option>
                                <option value="Bosnian">Bosnian</option>
                                <option value="Botswanan">Botswanan</option>
                                <option value="Brazilian">Brazilian</option>
                                <option value="British">British</option>
                                <option value="Bruneian">Bruneian</option>
                                <option value="Bulgarian">Bulgarian</option>
                                <option value="Burkinabe">Burkinabe</option>
                                <option value="Burmese">Burmese</option>
                                <option value="Burundian">Burundian</option>
                                <option value="Cabo Verdean">Cabo Verdean</option>
                                <option value="Cambodian">Cambodian</option>
                                <option value="Cameroonian">Cameroonian</option>
                                <option value="Canadian">Canadian</option>
                                <option value="Central African">Central African</option>
                                <option value="Chadian">Chadian</option>
                                <option value="Chilean">Chilean</option>
                                <option value="Chinese">Chinese</option>
                                <option value="Colombian">Colombian</option>
                                <option value="Comorian">Comorian</option>
                                <option value="Congolese (Congo-Brazzaville)">Congolese (Congo-Brazzaville)</option>
                                <option value="Congolese (Congo-Kinshasa)">Congolese (Congo-Kinshasa)</option>
                                <option value="Costa Rican">Costa Rican</option>
                                <option value="Croatian">Croatian</option>
                                <option value="Cuban">Cuban</option>
                                <option value="Cypriot">Cypriot</option>
                                <option value="Czech">Czech</option>
                                <option value="Danish">Danish</option>
                                <option value="Djiboutian">Djiboutian</option>
                                <option value="Dominican">Dominican</option>
                                <option value="Dutch">Dutch</option>
                                <option value="East Timorese">East Timorese</option>
                                <option value="Ecuadorean">Ecuadorean</option>
                                <option value="Egyptian">Egyptian</option>
                                <option value="Emirati">Emirati</option>
                                <option value="Equatoguinean">Equatoguinean</option>
                                <option value="Eritrean">Eritrean</option>
                                <option value="Estonian">Estonian</option>
                                <option value="Eswatini">Eswatini</option>
                                <option value="Ethiopian">Ethiopian</option>
                                <option value="Fijian">Fijian</option>
                                <option value="Finnish">Finnish</option>
                                <option value="French">French</option>
                                <option value="Gabonese">Gabonese</option>
                                <option value="Gambian">Gambian</option>
                                <option value="Georgian">Georgian</option>
                                <option value="German">German</option>
                                <option value="Ghanaian">Ghanaian</option>
                                <option value="Greek">Greek</option>
                                <option value="Grenadian">Grenadian</option>
                                <option value="Guatemalan">Guatemalan</option>
                                <option value="Guinean">Guinean</option>
                                <option value="Guinea-Bissauan">Guinea-Bissauan</option>
                                <option value="Guyanese">Guyanese</option>
                                <option value="Haitian">Haitian</option>
                                <option value="Honduran">Honduran</option>
                                <option value="Hungarian">Hungarian</option>
                                <option value="Icelandic">Icelandic</option>
                                <option value="Indian">Indian</option>
                                <option value="Indonesian">Indonesian</option>
                                <option value="Iranian">Iranian</option>
                                <option value="Iraqi">Iraqi</option>
                                <option value="Irish">Irish</option>
                                <option value="Israeli">Israeli</option>
                                <option value="Italian">Italian</option>
                                <option value="Ivorian">Ivorian</option>
                                <option value="Jamaican">Jamaican</option>
                                <option value="Japanese">Japanese</option>
                                <option value="Jordanian">Jordanian</option>
                                <option value="Kazakh">Kazakh</option>
                                <option value="Kenyan">Kenyan</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korean (North)">Korean (North)</option>
                                <option value="Korean (South)">Korean (South)</option>
                                <option value="Kuwaiti">Kuwaiti</option>
                                <option value="Kyrgyz">Kyrgyz</option>
                                <option value="Lao">Lao</option>
                                <option value="Latvian">Latvian</option>
                                <option value="Lebanese">Lebanese</option>
                                <option value="Liberian">Liberian</option>
                                <option value="Libyan">Libyan</option>
                                <option value="Liechtensteiner">Liechtensteiner</option>
                                <option value="Lithuanian">Lithuanian</option>
                                <option value="Luxembourgish">Luxembourgish</option>
                                <option value="Malagasy">Malagasy</option>
                                <option value="Malawian">Malawian</option>
                                <option value="Malaysian">Malaysian</option>
                                <option value="Maldivian">Maldivian</option>
                                <option value="Malian">Malian</option>
                                <option value="Maltese">Maltese</option>
                                <option value="Marshallese">Marshallese</option>
                                <option value="Mauritanian">Mauritanian</option>
                                <option value="Mauritian">Mauritian</option>
                                <option value="Mexican">Mexican</option>
                                <option value="Micronesian">Micronesian</option>
                                <option value="Moldovan">Moldovan</option>
                                <option value="Monacan">Monacan</option>
                                <option value="Mongolian">Mongolian</option>
                                <option value="Montenegrin">Montenegrin</option>
                                <option value="Moroccan">Moroccan</option>
                                <option value="Mozambican">Mozambican</option>
                                <option value="Namibian">Namibian</option>
                                <option value="Nauruan">Nauruan</option>
                                <option value="Nepali">Nepali</option>
                                <option value="New Zealander">New Zealander</option>
                                <option value="Nicaraguan">Nicaraguan</option>
                                <option value="Nigerien">Nigerien</option>
                                <option value="Nigerian">Nigerian</option>
                                <option value="North Macedonian">North Macedonian</option>
                                <option value="Norwegian">Norwegian</option>
                                <option value="Omani">Omani</option>
                                <option value="Pakistani">Pakistani</option>
                                <option value="Palauan">Palauan</option>
                                <option value="Palestinian">Palestinian</option>
                                <option value="Panamanian">Panamanian</option>
                                <option value="Papua New Guinean">Papua New Guinean</option>
                                <option value="Paraguayan">Paraguayan</option>
                                <option value="Peruvian">Peruvian</option>
                                <option value="Philippine">Filipino</option>
                                <option value="Polish">Polish</option>
                                <option value="Portuguese">Portuguese</option>
                                <option value="Qatari">Qatari</option>
                                <option value="Romanian">Romanian</option>
                                <option value="Russian">Russian</option>
                                <option value="Rwandan">Rwandan</option>
                                <option value="Saint Lucian">Saint Lucian</option>
                                <option value="Salvadoran">Salvadoran</option>
                                <option value="Samoan">Samoan</option>
                                <option value="San Marinese">San Marinese</option>
                                <option value="Sao Tomean">Sao Tomean</option>
                                <option value="Saudi">Saudi</option>
                                <option value="Scottish">Scottish</option>
                                <option value="Senegalese">Senegalese</option>
                                <option value="Serbian">Serbian</option>
                                <option value="Seychellois">Seychellois</option>
                                <option value="Sierra Leonean">Sierra Leonean</option>
                                <option value="Singaporean">Singaporean</option>
                                <option value="Slovak">Slovak</option>
                                <option value="Slovenian">Slovenian</option>
                                <option value="Solomon Islander">Solomon Islander</option>
                                <option value="Somali">Somali</option>
                                <option value="South African">South African</option>
                                <option value="South Sudanese">South Sudanese</option>
                                <option value="Spanish">Spanish</option>
                                <option value="Sri Lankan">Sri Lankan</option>
                                <option value="Sudanese">Sudanese</option>
                                <option value="Surinamese">Surinamese</option>
                                <option value="Swazi">Swazi</option>
                                <option value="Swedish">Swedish</option>
                                <option value="Swiss">Swiss</option>
                                <option value="Syrian">Syrian</option>
                                <option value="Taiwanese">Taiwanese</option>
                                <option value="Tajik">Tajik</option>
                                <option value="Tanzanian">Tanzanian</option>
                                <option value="Thai">Thai</option>
                                <option value="Togolese">Togolese</option>
                                <option value="Tongan">Tongan</option>
                                <option value="Trinidadian">Trinidadian</option>
                                <option value="Tunisian">Tunisian</option>
                                <option value="Turkish">Turkish</option>
                                <option value="Turkmen">Turkmen</option>
                                <option value="Tuvaluan">Tuvaluan</option>
                                <option value="Ugandan">Ugandan</option>
                                <option value="Ukrainian">Ukrainian</option>
                                <option value="Uruguayan">Uruguayan</option>
                                <option value="Uzbek">Uzbek</option>
                                <option value="Vanuatuan">Vanuatuan</option>
                                <option value="Venezuelan">Venezuelan</option>
                                <option value="Vietnamese">Vietnamese</option>
                                <option value="Welsh">Welsh</option>
                                <option value="Yemeni">Yemeni</option>
                                <option value="Zambian">Zambian</option>
                                <option value="Zimbabwean">Zimbabwean</option>
                            </select>

                        </div>
                        <div class="col-sm-4">
                            <label for="nickname" class="form-label fw-semibold">Nickname</label>
                            {{-- <p class='nickname'>{{ $patient->NickName }}</p> --}}
                            <input type="text" name="nickname" class="form-control" value='{{ $patient->NickName }}'
                                id=""{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 p-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="address" class="form-label fw-semibold">Address</label>
                            <input type="text" name="address" class="form-control" value='{{ $patient->Address }}'
                                id=""{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                            {{-- <p class='address'>{{ $patient->Address }}</p> --}}
                        </div>
                        <div class="col-sm-6">
                            <label for="homeno" class="form-label fw-semibold">Home No.</label>
                            <input type="text" name="homeno" class="form-control" value='{{ $patient->HomeNo }}'
                                id=""{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                            {{-- <p class='homeno'>{{ $patient->HomeNo }}</p> --}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 p-3">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="occupation" class="form-label fw-semibold">Occupation</label>
                            <input type="text" name="occupation" class="form-control"
                                value='{{ $patient->Occupation }}' id=""{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                            {{-- <p class='occupation'>{{ $patient->Occupation }}</p> --}}
                        </div>
                        <div class="col-sm-3">
                            <label for="officeno" class="form-label fw-semibold">Office No.</label>
                            <input type="text" name="officeno" class="form-control" value='{{ $patient->OfficeNo }}'
                                id=""{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                            {{-- <p class='officeno'>{{ $patient->OfficeNo ?? '--\--'  }}</p> --}}
                        </div>
                        <div class="col-sm-3">
                            <label for="effectivedate" class="form-label fw-semibold">Effective Date</label>
                            <input type="text" name="effectivedate" class="form-control"
                                value='{{ $patient->EffectiveDate }}' id=""{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                            {{-- <p class='effectivedate'>{{ $patient->EffectiveDate ?? '--\--'  }}</p> --}}
                        </div>
                        <div class="col-sm-3">
                            <label for="faxno" class="form-label fw-semibold">Fax No.</label>
                            <input type="text" name="faxno" class="form-control" value='{{ $patient->FaxNo }}'
                                id=""{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                            {{-- <p class='faxno'>{{ $patient->FaxNo ?? '--\--'  }}</p> --}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 p-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="text" name="email" {{Auth::user()->Role === 'Dentist' ? 'disabled' : ''}} class="form-control" value='{{ $patient->Email }}'
                                id="" {{ Auth::user()->Role === 'Admin' ? 'disabled' : '' }}>
                            {{-- <p class='email'>{{ $patient->Email ?? '--\--'  }}</p> --}}
                        </div>
                        <div class="col-sm-6">
                            <label for="mobileno" class="form-label fw-semibold">Mobile No.</label>
                            <input type="text" name="mobileno" {{Auth::user()->Role === 'Dentist' ? 'disabled' : ''}} class="form-control" value='{{ $patient->MobileNo }}'
                                id=""{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                            {{-- <p class='mobileno'>{{ $patient->MobileNo ?? '--\--'  }}</p> --}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 p-3 for-minor">
                    <hr style="height: 1px; background-color: black; border: none;" class="mt-5">
                    <p class="fw-semibold" style="font-style: italic">For Minors</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="guardian" class="form-label fw-semibold">Parent/Guardian Name</label>
                            <input type="text" name="guardian" class="form-control" value='{{ $patient->Guardian }}'
                                id=""{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                            {{-- <p class='guardian'>{{ $patient->Guardian ?? '--\--'  }}</p> --}}
                        </div>
                        <div class="col-sm-6">
                            <label for="guardianoccupation" class="form-label fw-semibold">Occupation</label>
                            <input type="text" name="guardianoccupation" class="form-control"
                                value='{{ $patient->GuardianOccupation }}' id=""{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                            {{-- <p class='guardianoccupation'></p> --}}
                        </div>
                        <div class="col-sm-12 my-5">
                            <label for="referal" class="form-label fw-semibold">Who may we thank for referring
                                you?</label>
                            <input type="text" name="referal" class="form-control" value='{{ $patient->Referal }}'
                                id=""{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}>
                            {{-- <p class="referal">{{ $patient->Referal ?? '--\--'  }}</p> --}}
                        </div>
                        <div class="col-sm-12">
                            <label for="consultation" class="form-label fw-semibold">Reason for Consultation</label>
                            <textarea name="consultationreason" id="Reason_For_Consultation" value="{{ $patient->ReasonForVisit }}"{{Auth::user()->Role !== 'Front Desk' ? 'disabled' : ''}}
                                cols="30" rows="10" class="form-control form-control-sm" style="resize: none;">{{ $patient->ReasonForVisit }}</textarea>
                            {{-- <p class="consultationreason">{{ $patient->ReasonForVisit ?? '--\--'  }}</p> --}}
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->Role !== 'Dentist')
            <button class="submit btn-primary btn-sm form-control fw-bold update-patient-basic-info {{ Auth::user()->Role !== 'Dentist' ? 'text-muted' : '' }}" {{ Auth::user()->Role !== 'Dentist' ? 'disabled' : '' }}>Update</button>
            @endif
        </form>