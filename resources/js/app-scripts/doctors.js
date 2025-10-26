$(document).ready(function () {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });

    $('.save-new-doctor').on('click', function (e) {

        e.preventDefault();
        const form = $('.new-doctor-form')[0];
        const formData = new FormData(form);
        let hasEmpty = false;
        $('.new-doctor-form input').each(function () {
            const fieldName = $(this).attr('name');
            const isOptional = ['Suffix', 'MiddleName', 'ProfessionalTitle', 'AreaOfExpertise'].includes(fieldName);

            if (!isOptional && $(this).val().trim() === '') {
                Toast.fire({
                    icon: 'warning',
                    title: 'Missing Fields',
                    text: 'Please fill out all required fields'
                });
                $(this).addClass('is-invalid');
                hasEmpty = true;
            } else {
                $(this).removeClass('is-invalid');
            }
        });


        if (hasEmpty) return;
        $('.doctors-page').removeClass('visually-hidden');
        // $('.loader-container').removeClass('visually-hidden');

        $.ajax({
            type: 'POST',
            url: '/doctors/new',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            },
            success: function (response) {
                $('.doctors-page').addClass('visually-hidden');
                location.reload();
                localStorage.setItem('doctor', 'created');
                // $('.new-doctor-form')[0].reset();
            },
            error: function (xhr) {
                $('.doctors-page').addClass('visually-hidden');
                const errors = xhr.responseJSON?.errors;
                if (errors) {
                    Object.keys(errors).forEach(key => {
                        // $(`[name='${key}']`).addClass('is-invalid');
                        Toast.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: errors[key][0]
                        });
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.'
                    });
                }
            }
        });
    });


    $('#search-doctors').on('input', function () {
        let query = $(this).val().toLowerCase();

        $('.doctor-row-container').each(function () {
            let name = $(this).find('div:first').text().toLowerCase();
            let price = $(this).find('div:last').text().toLowerCase();

            if (name.includes(query) || price.includes(query)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    function setPostActionToast(messageType = 'success', messageTitle = '', messageText = '') {
        localStorage.setItem('postActionToast', JSON.stringify({
            type: messageType,
            title: messageTitle,
            text: messageText
        }));
    }

    $('.doctor-row-container').on('click', function (e) {
        let htx = '';
        let docID = $(this).attr('id').split('-')[1];
        $('.clicked-doc').text($(this).data('doc'));
        $('.doctor-loader-container').removeClass('visually-hidden');
        // $('.doc-info-container').addClass('visually-hidden');
        $.ajax({
            url: `doctors/get-doctors-appointment/${docID}`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            },
            success: function (response) {
                console.log(response);
                htx += `<div class="row d-flex justify-content-center align-items-center text-left">
                            <div class="row doc-appt-data-header">
                                <div class="col-sm-2 text-sm lead fw-semibold">Time</div>
                                <div class="col-sm-2 text-sm lead fw-semibold">Date</div>
                                <div class="col-sm-2 text-sm lead fw-semibold">Status</div>
                                <div class="col-sm-2 text-sm lead fw-semibold">Patient</div>
                                <div class="col-sm-2 text-sm lead fw-semibold">Procedure</div>
                            </div>
            `;
                $('.doctor-loader-container').addClass('visually-hidden');
                // $('.doc-info-container').addClass('visually-hidden');
                $.each(response.appointments, (index, data) => {
                    htx += `
                    <div class="row patient-data mt-2 bg-light rounded-3" ${data.status === 'cancel' ? "style='pointer-events: none;'" : ''}>
                                <div class="col-sm-2 small">${data.time}</div>
                                <div class="col-sm-2 small">${data.date}</div>
                                <div class="col-sm-2 small">
                                <span
                                style='cursor: pointer;'
                                class='prep-appt-doc-admin'
                                data-time='${data.time}'
                                data-date='${data.date}'
                                data-status='${data.status}'
                                data-dentist='${data.LastName}, ${data.FirstName}'
                                data-service='${data.Service}'
                                data-id='${data.ApptID}'
                                
                                >
                                <i class="fw-semibold small rounded-2 p-1
                                    ${data.status === 're-sched' ? 'bg-info text-dark' : ''}
                                    ${data.status === 'Pending' ? 'bg-warning text-dark' : ''}
                                    ${data.status === 'completed' ? 'disable bg-success text-white' : ''}
                                    ${data.status === 'cancel' ? 'bg-secondary text-white' : ''}
                                    ${data.status === 'overdue' ? 'bg-danger text-white' : ''}">
                                    ${data.status}
                                </i>
                                </span>
                                </div>
                                <div class="col-sm-2 small">${data.LastName}, ${data.FirstName}</div>
                                <div class="col-sm-2 small">${data.Service}</div>
                                <div class="col-sm-2 small">
                                </div>
                            </div>
                    `;
                });
                htx += '</div>';
                
                $('.doc-info-container').html(htx);
            },
            error: function (xhr) {
                $('.doctor-loader-container').addClass('visually-hidden');
                $('.doc-info-container').removeClass('visually-hidden');
                // $('.doctors-page').addClass('visually-hidden');
                const errors = xhr.responseJSON?.errors;
                if (errors) {
                    Object.keys(errors).forEach(key => {
                        // $(`[name='${key}']`).addClass('is-invalid');
                        Toast.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: errors[key][0]
                        });
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.'
                    });
                }
            }
        });
    });

    $(document).on('click', '.prep-appt-doc-admin', function(){
        let apptData = $(this).data();
        $('[name="appt_id_update"]').val(apptData.id);
        $('[name="update_selected_date"]').val(apptData.date);
        $('[name="update_selected_time"]').val(apptData.time);
        $('.stat-opt').val(apptData.status);
        $('.stat-opt').text(apptData.status);
        $('.apptDate').text(apptData.date);
        $('.apptTime').text(apptData.time);
        $('.apptService').text(apptData.service);
        $('.apptDentist').text(apptData.dentist);
        $('.update-appt').attr('data-id', apptData.ApptID);
        console.log(apptData.id);
        
        console.log(
            $('[name="appt_id_update"]').val()
        );
    });

    const doctorStatus = localStorage.getItem('doctor');

    if (doctorStatus === 'created') {
        Swal.fire({
            icon: 'success',
            title: 'Doctor Account Created',
            text: 'A new dentist has been successfully added.',
            confirmButtonText: 'OK'
        });

        localStorage.removeItem('doctor');
    }
});