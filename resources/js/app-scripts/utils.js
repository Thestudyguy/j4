$(document).ready(function() {
    console.log('hey im loaded');
   
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

});