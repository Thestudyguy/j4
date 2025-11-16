$(document).ready(function () {
    console.log('hey im loaded');
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
    $('.toggle-password').on('click', function () {
        var targetId = $(this).data('target');
        var $input = $('#' + targetId);
        var $icon = $(this).find('i');

        if ($input.attr('type') === 'password') {
            $input.attr('type', 'text');
            $icon.removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            $input.attr('type', 'password');
            $icon.removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });


    //     $(document).ready(function () {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('input[name="_token"]').val()
    //         }
    //     });
    //     $('#login-form').on('submit', function (e) {
    //         e.preventDefault();
    //         $('input[name="email"], input[name="password"]').css('border', '1px solid #444');

    //         $.ajax({
    //             type: 'POST',
    //             url: $(this).attr('action'),
    //             data: $(this).serialize(),
    //             success: function () {
    //                 Swal.fire({
    //                     icon: 'success',
    //                     title: 'Login successful!',
    //                     showConfirmButton: false,
    //                     timer: 1500
    //                 }).then(() => {
    //                     window.location.href = "/home";
    //                 });
    //             },
    //             error: function (xhr) {
    //                 // Highlight the fields red
    //                 $('input[name="email"], input[name="password"]').css('border', '1px solid red');

    //                 Swal.fire({
    //                     icon: 'error',
    //                     title: 'Login failed',
    //                     text: 'Incorrect email or password. Please try again.',
    //                 });
    //             }
    //         });
    //     });
    // });


    //for step 2 medical history
    $('input[name="medicalcondition"]').change(function () {
        if ($(this).val() === 'yes') {
            $('.medicalconditiontextcontainer').removeClass('d-none');
        } else {
            $('.medicalconditiontextcontainer').addClass('d-none');
        }
    });

    $('input[name="surgery"]').change(function () {
        if ($(this).val() === 'yes') {
            $('.surgerytextcontainer').removeClass('d-none');
        } else {
            $('.surgerytextcontainer').addClass('d-none');
        }
    });

    $('input[name="hospital"]').change(function () {
        if ($(this).val() === 'yes') {
            $('.hospitaltextcontainer').removeClass('d-none');
        } else {
            $('.hospitaltextcontainer').addClass('d-none');
        }
    });

    $('input[name="prescription"]').change(function () {
        if ($(this).val() === 'yes') {
            $('.prescriptioncontainer').removeClass('d-none');
        } else {
            $('.prescriptioncontainer').addClass('d-none');
        }
    });


    $('#Birthdate').on('change', function (e) {
        let birthdate = new Date($(this).val());
        let today = new Date();

        let age = today.getFullYear() - birthdate.getFullYear();
        let monthDiff = today.getMonth() - birthdate.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
            age--;
        }
        $('#Age').val(age);
        // $('#hiddenage').val(age);

        if (age <= 1) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Age',
                text: 'Patients must be at least 2 years old for consultation. \nthis is a temporary prompt and will inevitably changed to comply with the students needs'
            });
        }

        if (age > 0 && age < 18) {
            $('.for-minor').removeClass('visually-hidden');
        } else {
            $('.for-minor').addClass('visually-hidden');
        }
    });



    let apptStatFlag = null;
    $(document).on('change', '.appointment-update-selection', function (e) {
        if ($(this).val() === 'reschedule') {
            apptStatFlag = false;
            $('.date-picker-update').removeClass('visually-hidden');
        } else {
            apptStatFlag = true;
            $('.date-picker-update').addClass('visually-hidden');
        }
    });

    const workingHours = [
        "09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM",
        "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM"
    ];

    $(document).on('shown.bs.modal', '.patient-update-appt-modal', function () {
        const modal = $(this);
        const apptId = modal.attr('id').replace('update-appointment-', '');
        const calendarEl = document.getElementById(`calendar-container-update-${apptId}`);

        flatpickr(calendarEl, {
            inline: true,
            dateFormat: "Y-m-d",
            minDate: new Date().fp_incr(1),
            onChange: function (selectedDates, dateStr, instance) {
                const readableDate = selectedDates[0].toLocaleDateString('en-US', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                $.ajax({
                    type: 'POST',
                    url: 'available-slots',
                    data: { date: dateStr },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content") },
                    success: function (response) {
                        renderTimeSlots(dateStr, response.availableSlots, apptId);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });

                $(`#selected-date-title-update-${apptId}`).text(`Available Time Slots for ${readableDate}`);
                renderTimeSlots(dateStr, [], apptId);
            }
        });
    });


    function renderTimeSlots(date, availableSlots = [], apptId) {
        const container = $(`#time-slots-update-${apptId}`);
        container.empty();

        const firstCol = $('<div class="col-6 d-flex flex-column gap-2"></div>');
        const secondCol = $('<div class="col-6 d-flex flex-column gap-2"></div>');
        const midpoint = Math.ceil(workingHours.length / 2);

        workingHours.forEach((time, index) => {
            const isAvailable = availableSlots.includes(time);

            const btn = $('<button>')
                .addClass('btn w-100 time-slots')
                .addClass(isAvailable ? 'btn-outline-primary' : 'btn-secondary disabled')
                .attr('data-time', time)
                .attr('data-date', date)
                .attr('data-id', apptId)
                .text(time);

            if (index < midpoint) {
                firstCol.append(btn);
            } else {
                secondCol.append(btn);
            }
        });

        container.append(firstCol, secondCol);
    }

    $(document).on('click', '.time-slots', function () {
        const selectedTime = $(this).data('time');
        const selectedDate = $(this).data('date');
        const apptId = $(this).data('id');

        // Only clear active state inside the same modal
        $(`#time-slots-update-${apptId} .time-slots`).removeClass('active');
        $(this).addClass('active');

        $(`#update_selected_time_${apptId}`).val(selectedTime);
        $(`#update_selected_date_${apptId}`).val(selectedDate);
    });

    $(document).on('click', '.update-appt', function () {
        $('.update-appointment-modal').removeClass('visually-hidden');
        const apptId = $(this).data('id');
        const selectedTime = $(`#update_selected_time_${apptId}`).val();
        const selectedDate = $(`#update_selected_date_${apptId}`).val();
        const apptID = $(`#update_appt_${apptId}`).val();
        console.log(selectedDate);
        console.log(selectedTime);
        if (apptStatFlag === null) {
            Toast.fire({
                icon: 'warning',
                title: 'Invalid Input',
                text: 'Please select update option'
            });
            $('.update-appointment-modal').addClass('visually-hidden');
            return;
        }
        if (apptStatFlag === false) {//false = resched
            if (selectedDate == '' && selectedTime == '') {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please select a date & time before rescheduling.'
                });
                $('.update-appointment-modal').addClass('visually-hidden');
                return;
            }
            // if (selectedTime == null) {
            //     Toast.fire({
            //         icon: 'warning',
            //         title: 'Please select a time before continuing.'
            //     });
            //     $('.update-appointment-modal').addClass('visually-hidden');
            //     return;
            // }
            $.ajax({
                type: 'POST',
                url: '/appointments/update',
                data: {
                    appt_id: apptID,
                    date: selectedDate,
                    time: selectedTime,
                    status: 're-sched'
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('.update-appointment-modal').addClass('visually-hidden');
                    console.log(response.data);


                    localStorage.setItem('appointment', response.status);
                    location.reload();
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    $('.update-appointment-modal').addClass('visually-hidden');
                    Toast.fire({
                        icon: 'error',
                        title: 'Appointment Update Failed!',
                        text: 'Oh my god what did you do? Were all gonna die'
                    });
                }
            });
        }
        if (apptStatFlag === true) {//true = cancel
            const apptId = $(this).data('id');
            const selectedTime = $(`#update_selected_time_${apptId}`).val();
            const selectedDate = $(`#update_selected_date_${apptId}`).val();
            const apptID = $(`#update_appt_${apptId}`).val();
            console.log(selectedTime);
            $.ajax({
                type: 'POST',
                url: '/appointments/update',
                data: {
                    appt_id: apptID,
                    status: 'cancel'
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('.update-appointment-modal').addClass('visually-hidden');

                    localStorage.setItem('appointment', response.status);
                    location.reload();

                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    $('.update-appointment-modal').addClass('visually-hidden');
                    Toast.fire({
                        icon: 'error',
                        title: 'Appointment Update Failed!',
                        text: 'Oh my god what did you do? Were all gonna die'
                    });
                }
            });
        }
    });

    $('.birthdate-field-update').on('change', function () {
        let birthdate = new Date($(this).val());
        let today = new Date();

        let age = today.getFullYear() - birthdate.getFullYear();
        let monthDiff = today.getMonth() - birthdate.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
            age--;
        }
        $('.age-field-update').val(age);

        // $('#hiddenage').val(age);
    });

    $('.edit-patient-personal-info-form').on('submit', function (e) {
        e.preventDefault();
        $('.update-pbi-loader').removeClass('visually-hidden');
        const patientInfo = $(this).serializeArray();
        console.log(patientInfo);

        const optionalFields = [
            'patient-middlename',
            'religion',
            'effectivedate',
            'homeno',
            'officeno',
            'faxno',
            'guardian',
            'guardianoccupation',
            'referal',
            'consultationreason',
            'email',
            'guardian',
            'guardianoccupation',
            'consultationreason'
        ];
        const requiredFieldsMinor = [

        ];
        let hasEmptyRequired = false;
        patientInfo.forEach(field => {
            $(`[name="${field.name}"]`).removeClass('is-invalid');

        });
        patientInfo.forEach(field => {
            if (!optionalFields.includes(field.name) && !field.value.trim()) {
                $(`[name="${field.name}"]`).addClass('is-invalid');
                hasEmptyRequired = true;
            }
        });

        if (hasEmptyRequired) {
            Toast.fire({
                icon: 'error',
                title: 'Missing Fields',
                text: 'Please fill all fields'
            });
            return;
        }
        $.ajax({
            type: 'POST',
            url: '/update/patient-basic-info',
            data: patientInfo,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('.update-pbi-loader').addClass('visually-hidden');
                localStorage.setItem('patient-pbi', 'updated');
                location.reload();
            },
            error: function (jqXHR, err, stat) {
                $('.update-pbi-loader').addClass('visually-hidden');
                Toast.fire({
                    icon: 'error',
                    title: stat,
                    text: jqXHR.responseJSON.error
                });
            }
        });
    });

    let currentStep = 1;
    const totalSteps = $('.walk-in.step').length;

    $('.walk-in.step').hide();
    $('.walk-in.step').eq(currentStep - 1).show();

    function showStep(step) {
        $('.walk-in.step').hide();
        $('.walk-in.step').eq(step - 1).show();

        if (step === 1) {
            $('.walk-in-navback').hide();
        } else {
            $('.walk-in-navback').show();
        }

        if (step === totalSteps) {
            $('.walk-in-navnext').hide();
            $('.save-walk-in').removeClass('visually-hidden');
        } else {
            $('.walk-in-navnext').show();
            $('.save-walk-in').addClass('visually-hidden');
        }
    }

    let dataWalkin = null;
    // Next button click
    let walkInData;
    $('.walk-in-navnext').on('click', function () {
        if (currentStep === 1) {
            walkInData = $('.walk-in-form').serializeArray();
            console.log(walkInData);
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

            const minorRequiredFields = [
                'guardian',
                'guardianoccupation',
                'consultationreason'
            ];

            let hasEmptyRequired = false;
            walkInData.forEach(field => {
                $(`[name="${field.name}"]`).removeClass('is-invalid');

            });
            walkInData.forEach(field => {
                // Case 1: Always required fields (not in optionalFields)
                if (!optionalFields.includes(field.name) && !field.value.trim()) {
                    $(`[name="${field.name}"]`).addClass('is-invalid');
                    hasEmptyRequired = true;
                }

                // Case 2: Minor fields required only if .for-minor is visible
                if (!$('.for-minor').hasClass('visually-hidden') && minorRequiredFields.includes(field.name)) {
                    if (!field.value.trim()) {
                        $(`[name="${field.name}"]`).addClass('is-invalid');
                        hasEmptyRequired = true;
                    }
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
        }
        if (currentStep === 2) {

            if ($('#selected_date').val() === '' && $('#selected_time').val() === '') {
                Toast.fire({
                    icon: 'warning',
                    title: 'No date and time selected',
                    text: 'Please select date and time for your appointment'
                });
                return;
            }
            console.log('selected date and time', $('#selected_date').val(), $('#selected_time').val());
        }
        if (currentStep === 3) {
            if ($('#selected_service_id').val() === '') {
                Toast.fire({
                    icon: 'warning',
                    title: 'No Service selected',
                    text: 'Please select a service'
                });
                return;
            }
            console.log($('#selected_service_id').val());

        }

        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    });

    // Back button click
    $('.walk-in-navback').on('click', function () {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    // Initialize
    showStep(currentStep);


    $('.save-walk-in').on('click', function () {
        console.log($('#selected_doctor_id').val());

        if ($('#selected_doctor_id').val() === '') {
            Toast.fire({
                icon: 'warning',
                title: 'No Doctor selected',
                text: 'Please select a doctor'
            });
            return;
        }
        $('.patients-page').removeClass('visually-hidden');
        $.ajax({
            url: '/new/walk-in-patient',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            },
            data: {
                walkInData: walkInData,
                doctor_id: $('#selected_doctor_id').val(),
                service_id: $('#selected_service_id').val(),
                date: $('#selected_date').val(),
                time: $('#selected_time').val()
            },

            success: function (response) {
                $('.patients-page').addClass('visually-hidden');
                localStorage.setItem('patient-setup', 'created');
                location.reload();
            },
            error: function (jqXHR, err, stat) {
                $('.patients-page').addClass('visually-hidden');
                Toast.fire({
                    icon: 'error',
                    title: stat,
                    text: jqXHR.responseJSON.error
                });
            }
        });
    });

    const appointmentStatus = localStorage.getItem('appointment');
    const patientPbi = localStorage.getItem('patient-pbi');
    if (patientPbi === 'updated') {
        Toast.fire({
            icon: 'success',
            title: 'Patient Info has been updated'
        });
        localStorage.removeItem('patient-pbi'); // clear so it doesn't fire again
    }
    if (localStorage.getItem('patient-setup') === 'created') {
        Toast.fire({
            icon: 'success',
            title: 'Walkin Patient Added'
        });
        localStorage.removeItem('patient-setup'); // clear so it doesn't fire again
    }
    if (appointmentStatus === 'Appointment Rescheduled') {
        Toast.fire({
            icon: 'success',
            title: 'Appointment has been rescheduled successfully.'
        });
        localStorage.removeItem('appointment'); // clear so it doesn't fire again
    }

    if (appointmentStatus === 'Appointment Cancelled') {
        Toast.fire({
            icon: 'info',
            title: 'Appointment has been cancelled.'
        });
        localStorage.removeItem('appointment'); // clear so it doesn't fire again
    }

    //appointment search
    $("#searchAppointments").on("keyup", function () {
        let value = $(this).val().toLowerCase();

        $("#appointmentList .appointment-row").filter(function () {
            $(this).toggle($(this).text().toLowerCase().includes(value));
        });
    });


    //patient search
    $("#searchPatients").on("keyup", function () {
        let value = $(this).val().toLowerCase();

        $("#patientList .appointment-row").filter(function () {
            $(this).toggle($(this).text().toLowerCase().includes(value));
        });
    });


    //inventory search
    $("#searchInventory").on("keyup", function () {
        let value = $(this).val().toLowerCase();

        $("#inventoryList .inventory-row").filter(function () {
            $(this).toggle($(this).text().toLowerCase().includes(value));
        });
    });

});
