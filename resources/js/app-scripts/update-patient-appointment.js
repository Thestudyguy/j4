$(document).ready(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });

    console.log('js loaded');
    
    $('.patient-appointment-update').on('change', function(e){
        console.log($(this).val());
        // You can store the changed value or use it immediately if needed
    });

    $('.update-appointment').on('click', function(e){
        e.preventDefault();

        let form = $(this).closest('.modal').find('.appointment-updation-admin-shit');
        let formData = form.serializeArray();
        $('.appointment-page').removeClass('visually-hidden');
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: '/patient-appointment-update',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // assumes you have a meta tag for CSRF
            },
            success: function(response) {
                $('.appointment-page').addClass('visually-hidden');
                // $(form).closest('.modal').modal('hide');
                localStorage.setItem('appointment', 'updated');
                location.reload(); // or use AJAX to fetch updated info
            },
            error: function(xhr, status, error) {
                $('.appointment-page').addClass('visually-hidden');
                console.error('Error updating appointment:', error);
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong!'
                });
            }
        });
    });
    if(localStorage.getItem('appointment') === 'updated'){
        Swal.fire({
            icon: 'success',
            title: 'Appointment Updated!',
            text: 'appointment updated and a notification has been sent to the recipient',
            showConfirmButton: true
        });
        localStorage.removeItem('appointment');
    }
});
