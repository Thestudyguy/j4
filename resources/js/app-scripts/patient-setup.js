$(document).ready(function () {
    let currentStep = 1;
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });

    let personalInfo = {};
    let medicalHistory = {};
    let medicalHistoryIllneses = {};

    var ToastError = Swal.mixin({
        toast: false,
        position: 'bottom-end',
    });
    //toggling field visibility on required fields
    $(document).on('change', '.toggle-extra-field', function () {
        const target = $(this).data('target');
        if ($(this).val() === 'yes') {
            $(target).removeClass('d-none');
        } else {
            $(target).addClass('d-none');
            $(target).find('input').removeClass('is-invalid').val(''); // clear field
        }
    });


    const totalSteps = $('.patient-setup').length
    function NavStep(steps) {
        $('.patient-setup').addClass('visually-hidden');
        $('.patient-setup.patient-setup-step-' + steps).removeClass('visually-hidden');

        $('.form-step-indicator').each(function (index) {
            if (index < steps) {
                $(this).removeClass('bg-secondary').addClass('bg-info');
            } else {
                $(this).removeClass('bg-info fw-bold').addClass('bg-secondary');
            }
        });

        if (steps === 1) {
            $('.patient-account-setup-back-btn').addClass('visually-hidden');
        } else {
            $('.patient-account-setup-back-btn').removeClass('visually-hidden');
        }

        if (steps === totalSteps) {
            $('.patient-account-setup-next-btn').addClass('visually-hidden');
            $('.patient-account-setup-finish-btn').removeClass('visually-hidden');
        } else {
            $('.patient-account-setup-next-btn').removeClass('visually-hidden');
            $('.patient-account-setup-finish-btn').addClass('visually-hidden');
        }
    }


    $('.patient-account-setup-back-btn').on('click', function () {
        if (currentStep > 1) {
            currentStep--;
            NavStep(currentStep);
        }
    });


    $('.patient-account-setup-next-btn').on('click', function (e) {
        if (currentStep === 1) {

            let PersonalInfoObj = {};
            const formData = $('.client-personal-info-form').serializeArray();
            console.log(formData);

            const optionalFields = [
                'middlename',
                'religion',
                'effectivedate',
                'homeno',
                'officeno',
                'faxno',
                'guardian',
                'guardianoccupation',
                'referal',
                'consultationreason',
                'email'
            ];

            let hasEmptyRequired = false;
            formData.forEach(field => {
                $(`[name="${field.name}"]`).removeClass('is-invalid');

            });
            formData.forEach(field => {
                if (optionalFields.includes(field.name)) return;

                if (!field.value.trim()) {
                    $(`[name="${field.name}"]`).addClass('is-invalid');
                    hasEmptyRequired = true;
                }
            });
            if (!$('input[name="sex"]:checked').val()) {
                $('.client-sex-field').addClass(' border border-danger');
                hasEmptyRequired = true;
            } else {
                $('.client-sex-field').removeClass(' border border-danger');
            }

            if (hasEmptyRequired) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Missing Fields!',
                    text: 'Please fill out all required fields.'
                });
                return;
            }
            $.each(formData, (index, fields) => {
                PersonalInfoObj[fields.name] = fields.value;
            });
            console.log(PersonalInfoObj);
            personalInfo = PersonalInfoObj
            $.each(PersonalInfoObj, function (key, value) {
                const target = $('.preview-' + key);
                if (target.length) {
                    target.text(value || '--/--');
                }
            });
            console.log(PersonalInfoObj);
            
        }

        if (currentStep === 2) {
            let isValid = true;

            function markInvalid($el) {
                $el.addClass('is-invalid');
                isValid = false;
            }

            function clearInvalid($el) {
                $el.removeClass('is-invalid');
            }
            console.log($('.client-medical-history-form').serializeArray());
            
            const conditionalFields = [
                { container: '.medicalconditiontextcontainer', input: 'input[name="medicalconditiontext"]' },
                { container: '.surgerytextcontainer', input: 'input[name="surgerytext"]' },
                { container: '.hospitaltextcontainer', input: 'input[name="hospitaltext"]' },
                { container: '.prescriptioncontainer', input: 'input[name="prescriptiontext"]' }
            ];


            for (const field of conditionalFields) {
                const $container = $(field.container);
                const $input = $(field.input);
                if (!$container.hasClass('d-none')) {
                    const value = $input.val().trim();
                    if (value === '') {
                        markInvalid($input);
                    } else {
                        clearInvalid($input);
                    }
                } else {
                    clearInvalid($input);
                }
            }

            const $illnesses = $('input[name="illnesses[]"]');
            const $illnessOther = $('input[name="otherIllnessDetails"]');
            const isIllnessChecked = $illnesses.is(':checked');
            const isOtherIllnessChecked = $('#illnessOtherCheck').is(':checked');

            if (!isIllnessChecked) {
                markInvalid($illnesses.closest('.illness-container'));
            } else {
                clearInvalid($illnesses.closest('.illness-container'));

                if (isOtherIllnessChecked && $illnessOther.val().trim() === '') {
                    markInvalid($illnessOther);
                } else {
                    clearInvalid($illnessOther);
                }
            }

            const $allergies = $('input[name="isAllergicTo[]"]');
            const $allergyOther = $('input[name="isAllergicToTextInput"]');
            const isAllergyChecked = $allergies.is(':checked');
            const isOtherAllergyChecked = $('#allergyOtherCheck').is(':checked');

            if (!isAllergyChecked) {
                markInvalid($allergies.closest('.allergy-container'));
            } else {
                clearInvalid($allergies.closest('.allergy-container'));

                if (isOtherAllergyChecked && $allergyOther.val().trim() === '') {
                    markInvalid($allergyOther);
                } else {
                    clearInvalid($allergyOther);
                }
            }

            // Required radio groups
            const radioGroups = [
                'medicalcondition', 'surgery', 'hospital', 'prescription',
                'goodhealth', 'alcohol',
                'isClientASmokeWhack', 'isClientNursing'
            ];

            for (const name of radioGroups) {
                if (!$(`input[name="${name}"]:checked`).length) {
                    markInvalid($(`input[name="${name}"]`).closest('.radio-group'));
                } else {
                    clearInvalid($(`input[name="${name}"]`).closest('.radio-group'));
                }
            }

            if (!isValid) {
                ToastError.fire({
                    icon: 'error',
                    title: 'Missing or Incomplete Fields',
                    text: 'Please complete all required fields before continuing.'
                });
                return;
            }

            let formData = $('.client-medical-history-form').serializeArray();
            const grouped = {
                Illnesses: {
                    list: formData.filter(f => f.name === "illnesses[]").map(f => f.value),
                    otherDetails: formData.find(f => f.name === "otherIllnessDetails")?.value || ""
                },
                Allergies: {
                    list: formData.filter(f => f.name === "isAllergicTo[]").map(f => f.value),
                    otherDetails: formData.find(f => f.name === "isAllergicToTextInput")?.value || ""
                }
            };
            console.log(grouped);
            console.log('below');
            console.log($('.client-medical-history-form').serializeArray());
            medicalHistoryIllneses = grouped;
            let previewObj = {};
            $.each(formData, (index, fields) => {
                previewObj[fields.name] = fields.value;
            });
            formData = medicalHistory;

            // Preview all standard fields except arrays
            $.each(previewObj, function (name, value) {
                // Skip array fields handled separately
                if (name.includes('[]') || name === 'otherIllnessDetails' || name === 'isAllergicToTextInput') return;

                // Escape square brackets if ever present (defensive)
                const safeName = name.replace(/\[/g, '\\[').replace(/\]/g, '\\]');
                $(`.preview-${safeName}`).text(value);
            });

            // ✅ Allergies Preview using `grouped`
            const $allergyPreview = $('.preview-allergies');
            $allergyPreview.empty();

            if (grouped.Allergies.list && grouped.Allergies.list.length > 0) {
                grouped.Allergies.list.forEach(item => {
                    $allergyPreview.append(`<li>${item}</li>`);
                });
            }
            if (grouped.Allergies.otherDetails) {
                $allergyPreview.append(`<li>${grouped.Allergies.otherDetails}</li>`);
            }

            // ✅ Illnesses Preview using `grouped`
            const $illnessPreview = $('.preview-known-illnesses');
            $illnessPreview.empty();

            if (grouped.Illnesses.list && grouped.Illnesses.list.length > 0) {
                grouped.Illnesses.list.forEach(item => {
                    $illnessPreview.append(`<li>${item}</li>`);
                });
            }
            if (grouped.Illnesses.otherDetails) {
                $illnessPreview.append(`<li>${grouped.Illnesses.otherDetails}</li>`);
            }

            // ✅ Conditional Text Fields (only show if "yes")
            if (previewObj.medicalcondition === 'yes') {
                $('.preview-medicalconditiontext').text(previewObj.medicalconditiontext || '');
            } else {
                $('.preview-medicalconditiontext').text('');
            }

            if (previewObj.surgery === 'yes') {
                $('.preview-surgerytext').text(previewObj.surgerytext || '');
            } else {
                $('.preview-surgerytext').text('');
            }

            if (previewObj.hospital === 'yes') {
                $('.preview-hospitaltext').text(previewObj.hospitaltext || '');
            } else {
                $('.preview-hospitaltext').text('');
            }

            if (previewObj.prescription === 'yes') {
                $('.preview-prescriptiontext').text(previewObj.prescriptiontext || '');
            } else {
                $('.preview-prescriptiontext').text('');
            }

        }
        if (currentStep < totalSteps) {
            currentStep++;
            NavStep(currentStep);
        }
    });

    
        // let formData = new FormData($('#patient-form')[0]);

        $('.patient-account-setup-finish-btn').on('click', function (e) {
            e.preventDefault();
        $.ajax({
        url: 'patient-setup',
        type: 'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            },
        contentType: 'application/json',
        data: JSON.stringify({
            patient_personal_info: personalInfo,
            patient_med_history: {
                basic_info: $('.client-medical-history-form').serializeArray(),
                listed_allergies_illness: medicalHistoryIllneses
            }
        }),
        success: function (response) {
            localStorage.setItem('patient-setup', 'created');
            location.reload();
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Something went wrong while saving the data.'
            });
        }
    });

        });

        if(localStorage.getItem('patient-setup') === 'created'){
        Swal.fire({
            icon: 'success',
            title: 'All Set!',
            text: 'Your patient profile has been successfully created. You can now proceed to book an appointment.'
        });
        localStorage.removeItem('patient-setup');
    }

        
});