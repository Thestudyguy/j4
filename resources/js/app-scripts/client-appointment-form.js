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
    let selectedDoctorCard = '';
    let selectedServiceCard = '';
    //patient/client selecting a service: block
    $('.is-dom-card-selected').on('click', function () {
        if ($(this).hasClass('border-info')) {
            $(this).removeClass('border border-info');
            selectedServiceID = null;
            selectedServiceCard = '';
        } else {
            $('.is-dom-card-selected').removeClass('border border-info');
            $(this).addClass('border border-info');
            selectedServiceID = $(this).attr('id');
            selectedServiceCard = $(this).html();
        }
    });
    //patient/client selecting a service: block

    //patient/client selecting a doctor: block
    $('.is-doctor-dom-card-selected').on('click', function () {
        if ($(this).hasClass('border-info')) {
            $(this).removeClass('border border-info');
            selectedDoctorID = null;
            selectedDoctorCard = '';
        } else {
            $('.is-doctor-dom-card-selected').removeClass('border border-info');
            $(this).addClass('border border-info');
            selectedDoctorID = $(this).attr('id');
            selectedDoctorCard = $(this).html();
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
            let previewHtml = '';
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
            // if(isFormEmpty){
            //     console.log(personalInfoForm);
            //     $.each(personalInfoForm, (index, fields)=>{
            //         // $(`[name='${fields.name}']`).addClass('is-invalid');
            //         return;
            //     });
            //     Toast.fire({
            //         icon: 'warning',
            //         title: 'Missing Fields!',
            //         text: 'Please fill out all the required fields'
            //     });     
            //     return;
            // }
            //building html for preview personal-info
            $.each(personalInfoForm, (index, fields) => {
            const $input = $(`[name='${fields.name}']`);
            const rawId = $input.attr('id') || fields.name;

            const label = rawId
                .replace(/_/g, ' ')
                .replace(/\b\w/g, c => c.toUpperCase());

            const value = fields.value ? fields.value : '';

            previewHtml += `
                <p><strong>${label}:</strong> <span>${value}</span></p>
            `;
        });
        $('#preview-personal-info').html(previewHtml);
            const PersonalInfoObj = {};
            $.each(personalInfoForm, (index, fields) => {
                PersonalInfoObj[fields.name] = fields.value
            });
            console.log(PersonalInfoObj);
        }

        if (currentStep === 2) {
    const medicalForm = $('.client-medical-history-form').serializeArray();
    let isFormInvalid = false;

    const yesFollowUps = {
        hasMedicalCondition: 'medicalConditionDetails',
        hadSurgery: 'surgeryDetails',
        hadBeenHospitalized: 'hospitalizationReason',
        isTakingPrescription: 'prescriptionDetails'
    };

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
    $('.border-warning').removeClass('border-warning');

    // Validate required yes/no radios
    requiredRadios.forEach(name => {
        const selected = $(`input[name="${name}"]:checked`).val();
        const wrapper = $(`input[name="${name}"]`).closest('.col-sm-12');

        if (!selected) {
            wrapper.addClass('is-invalid');
            isFormInvalid = true;
        }

        // If "yes" is selected, validate the follow-up field (if applicable)
        if (selected === 'yes' && yesFollowUps[name]) {
            const followUpField = $(`input[name="${yesFollowUps[name]}"]`);
            if (followUpField.length && followUpField.val().trim() === '') {
                followUpField.addClass('is-invalid');
                isFormInvalid = true;
            }
        }
    });

    // Validate "Other Illness" if checked
    if ($('#otherIllness').is(':checked')) {
        const otherDetail = $('input[name="otherIllnessDetails"]');
        if (otherDetail.val().trim() === '') {
            otherDetail.addClass('border-warning');
            isFormInvalid = true;
        }
    }

    // Uncomment this after testing
    // if (isFormInvalid) {
    //     Toast.fire({
    //         icon: 'warning',
    //         title: 'Missing Required Fields!',
    //         text: 'Please complete all required questions.'
    //     });
    //     return;
    // }

    // Build structured form data
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

    // If no illnesses[] checked, ensure it exists as empty array
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
            console.log(selectedServiceID);
        if(currentStep === 4 && !selectedDoctorID){
            Toast.fire({
                icon: 'info',
                title: 'No Doctor selected',
                text: 'Please select a Doctor to proceed.'
            });
            return;
        }
        console.log(selectedDoctorID);

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
        if (steps === 1) {
        $('.form-nav-btn-back').addClass('visually-hidden');
    } else {
        $('.form-nav-btn-back').removeClass('visually-hidden');
    }
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

