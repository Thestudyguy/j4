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

$('.doctor-row-container').on('click', function(e){
    console.log($(this).attr('id'));
    
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