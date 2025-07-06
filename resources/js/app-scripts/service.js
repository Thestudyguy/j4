$(document).ready(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });

    const toastData = JSON.parse(localStorage.getItem('postActionToast'));

    if (toastData) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: toastData.type || 'success',
            title: toastData.title || '',
            text: toastData.text || '',
            showConfirmButton: false,
            timer: 2000
        });

        localStorage.removeItem('postActionToast');
    }


    $('.save-new-service').on('click', function(e) {
        e.preventDefault();

        const $form = $('.new-service-form');
        const formData = $form.serializeArray();
        const serviceImageInput = $form.find('input[name="serviceimage"]')[0];

        let hasError = false;

        $.each(formData, (index, field) => {
            const $input = $(`[name="${field.name}"]`);
            if (field.value.trim() === '') {
                $input.addClass('is-invalid');
                hasError = true;
            } else {
                $input.removeClass('is-invalid');
            }
        });

        if (!serviceImageInput || serviceImageInput.files.length === 0) {
            $('[name="serviceimage"]').addClass('is-invalid');
            hasError = true;
        } else {
            $('[name="serviceimage"]').removeClass('is-invalid');
        }

        if (hasError) {
            Toast.fire({
                icon: 'error',
                title: 'Missing Fields',
                text: 'Please fill out all required fields.'
            });
        } else {
           
            const formElement = $form[0];
            const formData = new FormData(formElement);
            $.ajax({
                type: 'POST',
                url: '/new-service',
                data: formData,
                processData: false,
                contentType: false, 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                },
                success: function(response) {
                     Toast.fire({
                        icon: 'success',
                        title: 'Service Added Successfully!',
                        text: 'The new service has been added.'
                    });
                    $form[0].reset();
                                        
                    // $('#new-service').modal('hide');
                },
                error: function(xhr) {
                    console.error('Error adding service:', xhr);
                    Toast.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error adding the service. Please try again.'
                    });
                }
            });
        }
    });

        $('.remove-service').on('click', function(e){
        e.preventDefault();
        const id = $(this).data('id');
        $('.loader-container').removeClass('visually-hidden');
        $.ajax({
            type: 'POST',
            url: `/remove-service/${id}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response){
                localStorage.setItem('service-removal', true);
                console.log(response);
                setPostActionToast('success', 'Service Removed', 'The service was removed successfully.');
                location.reload();
            },
            error: function(xhr){
                $('.loader-container').addClass('visually-hidden');
                Toast.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error removing the service. Please try again.'
                });
            }
        });
    });


    $('#search-services').on('input', function () {
            let query = $(this).val().toLowerCase();

            $('.services-row-container').each(function () {
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
});
