$(document).ready(function() {
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
                $icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                $input.attr('type', 'password');
                $icon.removeClass('fa-eye-slash').addClass('fa-eye');
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
    $('input[name="medicalcondition"]').change(function() {
        if($(this).val() === 'yes'){
            $('.medicalconditiontextcontainer').removeClass('d-none');
        }else{
            $('.medicalconditiontextcontainer').addClass('d-none');
        }
    });

    $('input[name="surgery"]').change(function() {
        if($(this).val() === 'yes'){
            $('.surgerytextcontainer').removeClass('d-none');
        }else{
            $('.surgerytextcontainer').addClass('d-none');
        }
    });

    $('input[name="hospital"]').change(function() {
        if($(this).val() === 'yes'){
            $('.hospitaltextcontainer').removeClass('d-none');
        }else{
            $('.hospitaltextcontainer').addClass('d-none');
        }
    });

    $('input[name="prescription"]').change(function() {
        if($(this).val() === 'yes'){
            $('.prescriptioncontainer').removeClass('d-none');
        }else{
            $('.prescriptioncontainer').addClass('d-none');
        }
    });


$('#Birthdate').on('change', function(e){
      let birthdate = new Date($(this).val());
    let today = new Date();

    let age = today.getFullYear() - birthdate.getFullYear();
    let monthDiff = today.getMonth() - birthdate.getMonth();

    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
        age--;
    }
    $('#Age').val(age);
    // $('#hiddenage').val(age);

    if(age <= 1 ){
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
$(document).on('change', '.appointment-update-selection', function(e) {
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

    $(document).on('shown.bs.modal', '.patient-update-appt-modal', function() {
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

    $('.update-appt').on('click', function(){
        $('.update-appointment-modal').removeClass('visually-hidden');
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
                date: selectedDate,
                time: selectedTime,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('.update-appointment-modal').addClass('visually-hidden');
                console.log(response.data);
                Toast.fire({
                    icon: 'success',
                    title: 'Appointment Updated!',
                    text: 'Your appointment has been rescheduled. We will be contacting you soon.'
                });
                // location.reload();
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
    });

});
