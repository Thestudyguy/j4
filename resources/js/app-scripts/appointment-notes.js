$(document).ready(function () {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });

   $('.save-nts').on('click', function () {
    let formData = $('.pt-apt-nts').serializeArray();
    console.log(formData);
    let callFlag = true; // assume valid by default

    $.each(formData, (index, fields) => {
        let $input = $(`[name='${fields.name}']`);
        $input.removeClass('is-invalid');

        if (fields.value.trim() === '') {
            callFlag = false; // once false, keep it false
            Toast.fire({
                icon: 'warning',
                title: 'Missing Fields',
                text: 'Please fill out all fields'
            });
            $input.addClass('is-invalid');
        }
    });
    if (callFlag) {
        $.ajax({
            type: 'POST',
            url: 'appointments/new-note',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            },
            data: formData,
            success: function(response){
                console.log(response);
                localStorage.setItem('notes', 'created');
                location.reload();
            },
            error: function (xhr) {
                // $('.loader-container').addClass('visually-hidden');
                Toast.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON.message
                });
            }

        });
        Toast.fire({
            icon: 'success',
            title: 'Prep for call',
            text: 'ajax cue'
        });
    }
});

if(localStorage.getItem('notes') === 'created'){
    Toast.fire({
        icon: 'success',
        title: 'Appointment Note',
        text: 'Notes Added!'
    });
    localStorage.removeItem('notes');
}
});