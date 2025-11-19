$(document).ready(function () {
  var Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 2000 });

  const workingHours = [
    "09:00 AM","10:00 AM","11:00 AM","12:00 PM",
    "01:00 PM","02:00 PM","03:00 PM","04:00 PM","05:00 PM"
  ];

   function updateDoctorAvailability($modal, selectedDate, selectedTime) {
    $modal.find('.scheduled-appt-doctor-card').removeClass('disabled-card');

    $modal.find('.scheduled-appt-doctor-card').each(function() {
      const offsString = $(this).attr('data-offsched');
      let offs = [];

      try { offs = JSON.parse(offsString); } 
      catch (e) { offs = []; console.warn('Invalid offsched JSON', offsString); }

      const isOff = offs.some(off => off.date === selectedDate && (off.time === selectedTime || off.time === null));
      if (isOff) {
        $(this).addClass('disabled-card');
        $(this).attr('title', 'Dentist unavailable for this date'); // optional tooltip
      } else {
        $(this).removeAttr('title');
      }
    });
  }

  function renderTimeSlots($modal, date, availableSlots = []) {
    const container = $modal.find('#scheduled-time-slots');
    container.empty();
    
    const firstCol = $('<div class="col-6 d-flex flex-column gap-2"></div>');
    const secondCol = $('<div class="col-6 d-flex flex-column gap-2"></div>');
    const midpoint = Math.ceil(workingHours.length / 2);

    workingHours.forEach((time, index) => {
      const isAvailable = (availableSlots || []).includes(time);
      const btn = $('<button>')
        .addClass('btn w-100 scheduled-time-slots')
        .addClass(isAvailable ? 'btn-outline-primary' : 'btn-secondary disabled')
        .attr('data-time', time)
        .attr('data-date', date)
        .text(time);

      (index < midpoint ? firstCol : secondCol).append(btn);
    });

    container.append(firstCol, secondCol);
  }
  function showStep($modal, step, totalSteps) {
    $modal.find('.scheduled-appointment-step').addClass('visually-hidden');
    $modal.find('.scheduled-appointment-prep-step-' + step).removeClass('visually-hidden');

    const $next = $modal.find('.patient-scheduled-appt-btn');
    const $back = $modal.find('.scheduled-appt-bck-btn');

    $back.toggleClass('visually-hidden', step === 1);
    $next.text(step === totalSteps ? 'Confirm' : 'Next');
  }


  // Initialize each schedule modal when shown (so IDs don’t clash across modals)
   $(document).on('shown.bs.modal', '.modal[id^="schedule-patient-appointment-"]', function () {
    const $modal = $(this);
    const totalSteps = $modal.find('.scheduled-appointment-step').length;
    $modal.data('currentStep', 1);
    $modal.data('totalSteps', totalSteps);
    showStep($modal, 1, totalSteps);

    const $cal = $modal.find('#scheduled-calendar-container');
    if ($cal.length && !$cal.data('fp')) {
      const fp = flatpickr($cal[0], {
        inline: true,
        dateFormat: "Y-m-d",
        minDate: new Date().fp_incr(1),
        onChange: function (selectedDates, dateStr) {
          const readableDate = selectedDates[0].toLocaleDateString('en-US', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
          });

          $modal.find('#scheduled-selected-date-title').text(`Available Time Slots for ${readableDate}`);
          renderTimeSlots($modal, dateStr, []);

          $.ajax({
            type: 'POST',
            url: 'available-slots',
            data: { date: dateStr },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content") },
            success: function (response) {
              renderTimeSlots($modal, dateStr, response.availableSlots || []);
              // Reset doctor selection
              $modal.find('input[name="scheduled_appt_selected_time"]').val('');
              $modal.find('input[name="scheduled_appt_selected_doctor_id"]').val('');
              $modal.find('.scheduled-appt-doctor-card').removeClass('disabled-card border-success border-3');
            },
            error: function (error) {
              console.error(error);
            }
          });
        }
      });
      $cal.data('fp', fp);
    }
  });

  $(document).on('click', '.scheduled-time-slots', function () {
    const $modal = $(this).closest('.modal');
    const selectedTime = $(this).data('time');
    const selectedDate = $(this).data('date');

    if ($(this).hasClass('disabled')) return;

    $modal.find('.scheduled-time-slots').removeClass('active');
    $(this).addClass('active');

    $modal.find('input[name="scheduled_appt_selected_time"]').val(selectedTime);
    $modal.find('input[name="scheduled_appt_selected_date"]').val(selectedDate);

    // --- Update Doctor Availability ---
    updateDoctorAvailability($modal, selectedDate, selectedTime);
  });

  // Service pick (scoped)
$(document).on('click', '.scheduled-appt-service-card', function () {
    const $modal = $(this).closest('.modal');
    $modal.find('.scheduled-appt-service-card').removeClass('border-primary border-3');
    $(this).addClass('border-primary border-3');
    $modal.find('input[name="scheduled_appt_selected_service_id"]').val($(this).data('id'));
  });

  // Doctor pick (scoped)
   $(document).on('click', '.scheduled-appt-doctor-card', function () {
    const $modal = $(this).closest('.modal');
    if ($(this).hasClass('disabled-card')) {
      Swal.fire({
        icon: 'warning',
        title: 'Doctor unavailable',
        text: 'This dentist is off-schedule for the selected date/time.'
      });
      return;
    }
    $modal.find('.scheduled-appt-doctor-card').removeClass('border-success border-3');
    $(this).addClass('border-success border-3');
    $modal.find('input[name="scheduled_appt_selected_doctor_id"]').val($(this).data('id'));
  });
  // Back
  $(document).on('click', '.scheduled-appt-bck-btn', function (e) {
    e.preventDefault();
    const $modal = $(this).closest('.modal');
    let step = $modal.data('currentStep') || 1;
    const totalSteps = $modal.data('totalSteps') || 3;

    if (step > 1) {
      step--;
      $modal.data('currentStep', step);
      showStep($modal, step, totalSteps);
    }
  });

  // Next / Confirm
  $(document).on('click', '.patient-scheduled-appt-btn', function (e) {
    e.preventDefault();
    const $modal = $(this).closest('.modal');
    let step = $modal.data('currentStep') || 1;
    const totalSteps = $modal.data('totalSteps') || $modal.find('.scheduled-appointment-step').length;

    // per-step validation
    if (step === 1) {
      const date = $modal.find('input[name="scheduled_appt_selected_date"]').val();
      const time = $modal.find('input[name="scheduled_appt_selected_time"]').val();
      if (!date || !time) {
        Toast.fire({ icon: 'warning', title: 'No date/time selected', text: 'Please select date and time' });
        return;
      }
    }
    if (step === 2) {
      if (!$modal.find('input[name="scheduled_appt_selected_service_id"]').val()) {
        Toast.fire({ icon: 'warning', title: 'No service selected', text: 'Please select a service' });
        return;
      }
    }
    if (step === 3) {
      if (!$modal.find('input[name="scheduled_appt_selected_doctor_id"]').val()) {
        Toast.fire({ icon: 'warning', title: 'No doctor selected', text: 'Please select a doctor' });
        return;
      }
    }

    // advance or submit
    if (step < totalSteps) {
      step++;
      $modal.data('currentStep', step);
      showStep($modal, step, totalSteps);
      return;
    }

    // last step → confirm
    const $btn = $(this);
    const payload = {
      _token: $('meta[name="csrf-token"]').attr("content"),
      selected_date:  $modal.find('input[name="scheduled_appt_selected_date"]').val(),
      selected_time:  $modal.find('input[name="scheduled_appt_selected_time"]').val(),
      selected_doctor_id: $modal.find('input[name="scheduled_appt_selected_doctor_id"]').val(),
      selected_service_id: $modal.find('input[name="scheduled_appt_selected_service_id"]').val(),
      patient_id: $modal.find('input[name="scheduled_appt_patient_id"]').val() // FIXED selector
    };
    console.log(payload);
    
    $btn.prop('disabled', true).text('Booking...');
    $.ajax({
      url: 'patient/appointment/scheduled-appointment',
      method: 'POST',
      data: payload,
      success: function (response) {
        $btn.prop('disabled', false).text('Confirm');
        localStorage.setItem('appt', 'Created');
        // Swal.fire({ icon: 'success', title: 'Appointment created!' });
        location.reload();
        // optionally: $modal.modal('hide'); location.reload();
      },
      error: function (xhr) {
        $btn.prop('disabled', false).text('Confirm');
        Toast.fire({ icon: 'error', title: 'Something went wrong', text: xhr.responseJSON?.message || '' });
      }
    });
  });
    const apptStat = localStorage.getItem('appt');
    if(apptStat === 'Created'){
        Swal.fire({ icon: 'success', title: 'Appointment created!' });
        localStorage.removeItem('appt');
    }
});
