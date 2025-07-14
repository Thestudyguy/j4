$(document).ready(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
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
        $('.loader-container').removeClass('visually-hidden');
        const $form = $('.new-service-form');
        const formData = $form.serializeArray();
        // const serviceImageInput = $form.find('input[name="serviceimage"]')[0];
        console.log(formData);
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
                    //  Toast.fire({
                    //     icon: 'success',
                    //     title: 'Service Added Successfully!',
                    //     text: 'The new service has been added.'
                    // });
                    setPostActionToast('success', 'Service Added', 'The service was added successfully.');
                    $form[0].reset();
                    location.reload();
                    // $('#new-service').modal('hide');
                },
                error: function(xhr) {
                console.error('Error adding service:', xhr);
                $('.loader-container').addClass('visually-hidden');
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    let firstField = Object.keys(errors)[0];
                    let firstErrorMsg = errors[firstField][0];

                    Toast.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: firstErrorMsg
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error adding the service. Please try again.'
                    });
                }
            }

            });
        }
    });
    //process form starts here...
    $('.new-sub-service-form').on('submit', function (e) {
    e.preventDefault();
    
    const $form = $(this); // `this` is the form element
    const serializedForm = $form.serializeArray();
    const subServiceImage = $('#subserviceimage')[0];
    let hasError = false;

    $.each(serializedForm, (index, fields) => {
        // console.log(fields);
        if(fields.value.trim() === ''){
            $(`[name=${fields.name}]`).addClass('is-invalid');
            hasError = true;
        }else{
            $(`[name=${fields.name}]`).removeClass('is-invalid');
        }

    });
    if(!subServiceImage || subServiceImage.files.length === 0){
        $('#subserviceimage').addClass('is-invalid');
        hasError = true;
    }else{
        $('#subserviceimage').removeClass('is-invalid');
    }

    if(hasError){
        Toast.fire({
            icon: 'error',
            title: 'Missing Fields',
            text: 'Please fill all fields'
        });
        return;
    }else{
        // console.log(serializedForm);
        const prepForm = $form[0];
        const toPartForm = new FormData(prepForm);
        console.log(toPartForm);
        $.ajax({
            type: 'POST',
                url: 'new-sub-service',
                data: toPartForm,
                processData: false,
                contentType: false, 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                },
                success: function(response) {
                    setPostActionToast('success', 'Service Added', 'The service was added successfully.');
                    $form[0].reset();
                    location.reload();
                    $('#new-service').modal('hide');
                },
                error: function(xhr) {
                console.error('Error adding service:', xhr);
                $('.loader-container').addClass('visually-hidden');
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    let firstField = Object.keys(errors)[0];
                    let firstErrorMsg = errors[firstField][0];

                    Toast.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: firstErrorMsg
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error adding the service. Please try again.'
                    });
                }
            }
        });
    }

});


    //image preview of the service
    $('#subserviceimage').on('change', function (e) {
      const file = e.target.files[0];
      const $preview = $('.image-preview');

      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
          $preview.attr('src', e.target.result).removeClass('d-none');
        };
        reader.readAsDataURL(file);
      } else {
        $preview.attr('src', '#').addClass('d-none');
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

    $('.services-list').on('click', function(e){
        console.log($(this).attr('id'));
        let val = $(this).find(".col-sm-4:eq(0)").text();
        console.log(val);
        
            $('.service-loader-container').removeClass('visually-hidden');
            $('.service-info-container').addClass('visually-hidden');
            $('.do-this').html(`<p class='do-this fw-semibold lead'>${val}</p>`);
        setTimeout(() => {
            $('.service-loader-container').addClass('visually-hidden');
            $('.service-info-container').removeClass('visually-hidden');
        }, 2000);
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
