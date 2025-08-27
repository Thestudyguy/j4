$(document).ready(function () {
$(document).on('change', '.updateorcreate_under_medical_care', function (e) {
    if ($(this).val() === 'yes') {
        $('.undermedicalcaredetails').removeClass('d-none');
    } else {
        $('.undermedicalcaredetails').addClass('d-none');
        // $('input[name="updateorcreate_under_medical_care_text"]').val(''); // optional: clear the text field when hidden
    }
});
$(document).on('change', '.updateorcreate_had_surgery', function (e) {
    if ($(this).val() === 'yes') {
        $('.surgerytextcontainer').removeClass('d-none');
    } else {
        $('.surgerytextcontainer').addClass('d-none');
        // $('input[name="updateorcreate_surgery_text"]').val(''); // optional: clear the text field when hidden
    }
});
$(document).on('change', '.updateorcreate_hospitalized', function (e) {
    if ($(this).val() === 'yes') {
        $('.hostpitalizationtextcontainer').removeClass('d-none');
    } else {
        $('.hostpitalizationtextcontainer').addClass('d-none');
        // $('input[name="updateorcreate_surgery_text"]').val(''); // optional: clear the text field when hidden
    }
});
$(document).on('change', '.updateorcreate_taking_medications', function (e) {
    if ($(this).val() === 'yes') {
        $('.medicationsdetailscontainer').removeClass('d-none');
    } else {
        $('.medicationsdetailscontainer').addClass('d-none');
        // $('input[name="updateorcreate_surgery_text"]').val(''); // optional: clear the text field when hidden
    }
});
$('.update-pt-md-history-btn').on('click', function (e) {
    e.preventDefault();

    let invalid = false;

    // Reset previous invalid states
    $('input').removeClass('is-invalid');

    // ===== 1. Existing validation =====
    // Required radio groups
    const requiredRadios = [
        'good_health',
        'uses_drugs',
        'update_under_medical_care',
        'update_surgery',
        'update_hospitalized',
        'update_taking_medications',
        'using_tobacco',
        // 'pregnant',
        // 'taking_birth_control',
        // 'nursing'
    ];
    requiredRadios.forEach(function(name) {
        if ($(`input[name="${name}"]:checked`).length === 0) {
            invalid = true;
            $(`input[name="${name}"]`).addClass('is-invalid');
        }
    });

    // Conditional visible text inputs
    $('.undermedicalcaredetails:visible, .surgerytextcontainer:visible, .hostpitalizationtextcontainer:visible, .medicationsdetailscontainer:visible')
        .each(function() {
            let input = $(this).find('input[type="text"]');
            if (input.length && $.trim(input.val()) === '') {
        console.log('this');
                invalid = true;
                input.addClass('is-invalid');
            }
        });

    // ===== 2. New validation =====
    // Blood type and pressure must not be empty
    const bloodType = $('input[name="createorupdate_bloodType"]').val();
    const bloodPressure = $('input[name="createorupdate_bloodPressure"]').val();
    if (bloodType === '') {
        console.log('this');
        invalid = true;
console.log($(this).val())
        $('input[name="createorupdate_bloodType"]').addClass('is-invalid');
    }
    if (bloodPressure === '') {
        console.log('this');
        invalid = true;
        // $('input[name="createorupdate_bloodPressure"]').addClass('is-invalid');
    }

    // At least one allergy selected
    if ($('input[name="isAllergicTo[]"]:checked').length === 0) {
        console.log('this');
        invalid = true;
         Swal.fire({
            position: 'top-end',
            toast: true,
            icon: 'warning',
            title: 'Missing field',
            text: "Please indicate at least one allergy (or select 'None').",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true
        });
        return;
    }

    // At least one illness selected
    if ($('input[name="illnesses[]"]:checked').length === 0) {
        invalid = true;
        console.log('this');
        
        Swal.fire({
            position: 'top-end',
            toast: true,
            icon: 'warning',
            title: 'Missing field',
            text: "Please indicate at least one illnesses (or select 'None').",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true
        });
        return;
    }

    // ===== 3. Show feedback =====
    if (invalid) {
        Swal.fire({
            position: 'top-end',
            toast: true,
            icon: 'warning',
            title: 'Please fill out all required fields!',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true
        });
        return; 
    } else {
        Swal.fire({
            position: 'top-end',
            toast: true,
            icon: 'success',
            title: 'Ready for an ajax call',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true
        });
    }

   let data = $('.client-medical-preview-history-form').serializeArray();

// Ensure all fields appear even if empty
['pregnant', 'taking_birth_control', 'nursing'].forEach(name => {
    if (!data.some(item => item.name === name)) {
        data.push({ name: name, value: '' });
    }
});

console.log(data);

//call for ajax now!!!!!
});



});