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
            if(fields.value === '' && fields.name !== 'email'){
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
            if(!callFlag){
                $.ajax({
                    type: 'POST',
                    url: `new-user`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
                    },
                    data: userData,
                    success: function (response) {
                        localStorage.setItem('service-removal', true);
                        console.log(response);
                           window.location.href = response.redirect;
                    },
                    error: function (xhr) {
                        $('.loader-container').addClass('visually-hidden');
                        Toast.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message
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