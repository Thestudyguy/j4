$(document).ready(function () {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });
    const patientPersonalInfo = {};
    let selectedServiceID = null;
    let selectedDoctorID = null;
    //patient/client selecting a service: block
    $('.is-dom-card-selected').on('click', function () {
        if ($(this).hasClass('border-info')) {
            $(this).removeClass('border border-info');
            selectedServiceID = null;
        } else {
            $('.is-dom-card-selected').removeClass('border border-info');
            $(this).addClass('border border-info');
            selectedServiceID = $(this).attr('id');
        }
    });
    //patient/client selecting a service: block

    //patient/client selecting a doctor: block
    $('.is-doctor-dom-card-selected').on('click', function () {
        if ($(this).hasClass('border-info')) {
            $(this).removeClass('border border-info');
            selectedDoctorID = null;
        } else {
            $('.is-doctor-dom-card-selected').removeClass('border border-info');
            $(this).addClass('border border-info');
            selectedDoctorID = $(this).attr('id');
        }
    });
    //patient/client selecting a doctor: block

    $('#signatureUpload').on('change', function (e) {
        const file = e.target.files[0];
        const $preview = $('#signaturePreview');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $preview.attr('src', e.target.result).removeClass('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            $preview.attr('src', '#').addClass('d-none');
        }
    });


    // multi step nav

    let currentStep = 1;
    const totalSteps = $('.multi-step').length
    FormNav(currentStep);
    //navigate through the form
    $('.form-nav-btn-next').on('click', function (e) {
        if (currentStep === 1) {
            const personalInfoForm = $('.client-personal-info-form').serializeArray();
            const optionalFields = ['guardian', 'referal', 'guardianoccupation', 'faxno', 'nickname', 'officeno']
            let isFormEmpty = false;

            $.each(personalInfoForm, (index, field) => {
                $(`[name='${field.name}']`).removeClass('is-invalid');
            });
            $.each(personalInfoForm, (index, field) => {
                if (optionalFields.includes(field.name)) return;
                const value = field.value.trim();
                if (value === '') {
                    $(`[name='${field.name}']`).addClass('is-invalid');
                    isFormEmpty = true;
                }
            });
            if (!$('input[name="sex"]:checked').val()) {
                $('.client-sex-field').addClass(' border border-danger');
                isFormEmpty = true;
            } else {
                $('.client-sex-field').removeClass(' border border-danger');
            }
            if(isFormEmpty){
                $.each(personalInfoForm, (index, fields)=>{
                    console.log(fields.value);
                    // $(`[name='${fields.name}']`).addClass('is-invalid');
                    return;
                });
                Toast.fire({
                    icon: 'warning',
                    title: 'Missing Fields!',
                    text: 'Please fill out all the required fields'
                });     
                return;
            }  
            const PersonalInfoObj = {};
            $.each(personalInfoForm, (index, fields) => {
                PersonalInfoObj[fields.name] = fields.value
            });
            console.log(PersonalInfoObj);
        }

        if (currentStep === 2) {
            const medicalForm = $('.client-medical-history-form').serializeArray();
            let isFormInvalid = false;

            const requiredRadios = [
                'isHealthy',
                'hasUsedSubstances',
                'hasMedicalCondition',
                'hadSurgery',
                'hadBeenHospitalized',
                'isPregnant',
                'isClientNursing',
                'isOnBithControl',
                'isTakingPrescription',
                'isClientASmokeWhack'
            ];

            $('.is-invalid').removeClass('is-invalid');

            requiredRadios.forEach(name => {
                const selected = $(`input[name="${name}"]:checked`).val();
                if (!selected) {
                    $(`input[name="${name}"]`).closest('.col-sm-12').addClass('is-invalid');
                    isFormInvalid = true;
                }
            });

            if ($('#otherIllness').is(':checked')) {
                const otherDetail = $('input[name="otherIllnessDetails"]');
                if (otherDetail.val().trim() === '') {
                    otherDetail.addClass('border-warning');
                }
            }
            if (isFormInvalid) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Missing Required Fields!',
                    text: 'Please complete all required questions.'
                });
                return;
            }

            const formData = {};
            medicalForm.forEach(({ name, value }) => {
                if (formData[name]) {
                    if (Array.isArray(formData[name])) {
                        formData[name].push(value);
                    } else {
                        formData[name] = [formData[name], value];
                    }
                } else {
                    formData[name] = value;
                }
            });
            if (!$('input[name="illnesses[]"]:checked').length) {
                formData['illnesses'] = [];
            }
            console.log('Step 2 Form Data:', formData);
        }

         if (currentStep === 3 && !selectedServiceID) {
            Toast.fire({
                icon: 'info',
                title: 'No service selected',
                text: 'Please select a service to proceed.'
            });
            return;
        }
        if(currentStep === 4 && !selectedDoctorID){
            Toast.fire({
                icon: 'info',
                title: 'No Doctor selected',
                text: 'Please select a Doctor to proceed.'
            });
        }

        if (currentStep < totalSteps) {
            currentStep++;
            FormNav(currentStep);
        }
    });

    


    $('.form-nav-btn-back').on('click', function () {
        if (currentStep > 1) {
            currentStep--;
            FormNav(currentStep);
        }
    });

    function FormNav(steps) {
        $('.multi-step').addClass('visually-hidden');
        $('.multi-step.step-' + steps).removeClass('visually-hidden');
        $('.form-step-indicator').each(function (index) {

            if (index < steps) {
                $(this).
                    removeClass('bg-secondary')
                    .addClass('bg-info')
            } else {
                $(this)
                    .removeClass('bg-info fw-bold')
                    .addClass('bg-secondary');
            }
        });
    }

    
    $('.button-container .btn:contains("Finish")').on('click', function () {
        // $('.loader-overlay').removeClass('visually-hidden');
        Toast.fire({
            icon: 'success',
            title: 'Form submission',
            text: 'Your appointment form has been successfully submitted!'
        });
    });

});

