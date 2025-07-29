$(document).ready(function () {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });

    const workingHours = [
        "09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM",
        "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM"
    ];

    flatpickr("#calendar-container", {
        inline: true,
        dateFormat: "Y-m-d",
        minDate: new Date().fp_incr(1), // disables today and past dates
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
                    renderTimeSlots(dateStr, response.availableSlots);
                },
                error: function (error) {
                    console.error(error);
                }
            });

            $('#selected-date-title').text(`Available Time Slots for ${readableDate}`);
            renderTimeSlots(dateStr);
        }
    });

    function renderTimeSlots(date, availableSlots = []) {
        const container = $('#time-slots');
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
        // Remove 'active' from all time-slots
        $('.time-slots').removeClass('active');

        $(this).addClass('active');




        $('#selected_time').val(selectedTime);
        $('#selected_date').val(selectedDate);
    });

    $(document).on('click', '.service-card', function () {
        // Deselect all first
        $('.service-card').removeClass('border-primary border-3');
        // Highlight selected one
        $(this).addClass('border-primary border-3');

        const selectedServiceId = $(this).data('id');
        $('#selected_service_id').val(selectedServiceId);
    });

    $(document).on('click', '.doctor-card', function () {
        $('.doctor-card').removeClass('border-success border-3');
        $(this).addClass('border-success border-3');

        const selectedDoctorId = $(this).data('id');
        $('#selected_doctor_id').val(selectedDoctorId);


    });

    let currentStep = 1;
    const totalSteps = $('.appointment-step').length;

    function showStep(step) {
        // Hide all steps
        $('.appointment-step').addClass('visually-hidden');
        // Show the current step
        $('.appointment-step.appointment-prep-step-' + step).removeClass('visually-hidden');
        toggleButtons(step);
    }

    function toggleButtons(step) {
        // Toggle Next and Confirm buttons
        if (step === totalSteps) {
            $('#Next-appointment-btn').addClass('visually-hidden');
            $('#confirm-appointment-btn').removeClass('visually-hidden');
        } else {
            $('#Next-appointment-btn').removeClass('visually-hidden');
            $('#confirm-appointment-btn').addClass('visually-hidden');
        }

        // Show the Back button if not on the first step
        if (step > 1) {
            $('#back-appointment-btn').removeClass('visually-hidden');
        } else {
            $('#back-appointment-btn').addClass('visually-hidden');
        }
    }

    // // Handle the Next button click
    // $('#Next-appointment-btn').on('click', function (e) {
    //     e.preventDefault();
    //     if (currentStep < totalSteps) {
    //         currentStep++;
    //         showStep(currentStep);
    //     }
    // });

    // Handle the Back button click
    $('#back-appointment-btn').on('click', function (e) {
        e.preventDefault();
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    $('#Next-appointment-btn').on('click', function (e) {
        e.preventDefault();
        if (currentStep === 1) {
            if ($('#selected_date').val() === '' && $('#selected_time').val() === '') {
                Toast.fire({
                    icon: 'warning',
                    title: 'No date and time selected',
                    text: 'Please select date and time for your appointment'
                });
                return;
            }
        }
        if (currentStep === 2) {
            if ($('#selected_service_id').val() === '') {
                Toast.fire({
                    icon: 'warning',
                    title: 'No Service selected',
                    text: 'Please select a service'
                });
                return;
            }
        }
        if (currentStep === 3) {
            if ($('#selected_doctor_id').val() === '') {
                Toast.fire({
                    icon: 'warning',
                    title: 'No Doctor selected',
                    text: 'Please select a doctor'
                });
                return;
            }
        }

        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    });

    $('#confirm-appointment-btn').on('click', function (e) {

        e.preventDefault();
        if($('#selected_doctor_id').val() === ''){
            Toast.fire({
                icon: 'warning',
                title: 'No doctor selecteed',
                text: 'Please select a doctor'
            });
            return;
        }
        $('.appointment-loader-container').removeClass('is-invalid');
        const date = $('#selected_date').val();
        const time = $('#selected_time').val();
        const doctor = $('#selected_doctor_id').val();
        const service = $('#selected_service_id').val();

        if (!date || !time || !doctor || !service) {
            // alert('Please select date, time, doctor, and service first.');
            Swal.fire({
                icon: 'info',
                title: 'Please select all necesarry data'
            });
            return;
        }

        // Optional: Show loader or disable button
        $(this).prop('disabled', true).text('Booking...');

        $.ajax({
            url: '/appointments',
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                selected_date: date,
                selected_time: time,
                selected_doctor_id: doctor,
                selected_service_id: service,
            },
            success: function (response) {
                $('.appointment-loader-container').addClass('is-invalid');
                // location.reload(); // or redirect
                window.location.href = response.redirect;
                localStorage.setItem('appointment', 'created');
            },
            error: function (xhr) {
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong',
                    text: xhr.responseJSON.message
                });
                $('.appointment-loader-container').addClass('is-invalid');
                $('#confirm-appointment-btn').prop('disabled', false).text('Confirm Appointment');
            }
        });
    });

    if (localStorage.getItem('appointment') === 'created') {
        Swal.fire({
            icon: 'success',
            title: 'Your appointment has been created!',
            text: "We'll be contacting you throughh enmail about the status of your appointnent"
        });
        localStorage.removeItem('appointment');
    }
});
