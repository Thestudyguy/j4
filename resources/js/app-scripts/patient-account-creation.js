$(document).ready(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });
    console.log('patient account-creation js loaded');
    

    $('.new-patient').on('submit', function(e){
        e.preventDefault();
        let userData = {};
        let callFlag = false;
        console.log($(this).serializeArray());
        
        $.each($(this).serializeArray(), (index, fields)=>{
                $(`[name='${fields.name}']`).removeClass('is-invalid');
            if(fields.value === ''){
                Toast.fire({
                    icon: 'warning',
                    title: 'Missing Fields',
                    text: 'Please fill out all fields'
                });
                $(`[name='${fields.name}']`).addClass('is-invalid');
                callFlag = true;
                return;
            }
            userData[fields.name] = fields.value;
        });
            $('.register-page').removeClass('visually-hidden');
            if(!callFlag){
                $.ajax({
                    type: 'POST',
                    url: `user-registration`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                    },
                    data: userData,
                    success: function (response) {
            $('.register-page').addClass('visually-hidden');
                        console.log(response);
                        window.location.href = response.redirect;
                    },
                    error: function(xhr) {
            $('.register-page').addClass('visually-hidden');

    // Check if errors object exists
    let errorMessage = 'An error occurred';
    if (xhr.responseJSON && xhr.responseJSON.errors) {
        errorMessage = Object.values(xhr.responseJSON.errors)
            .flat() // flatten arrays
            .join('\n'); // join multiple messages with a newline
    }

    Toast.fire({
        icon: 'error',
        title: 'Error',
        text: errorMessage
    });
}

                });
            }else{
                // setPostActionToast('error', 'Fatal Error', 'Something went wrong!');
            }

        
    });


    $('.patient-profile-nav-btn').on('click', function(e){
        $(this).removeClass('bg-white p-2 text-dark border');
        $(this).addClass('bg-white p-2 text-dark border');
    });
});