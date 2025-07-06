$(document).ready(function() {
    console.log('hey im loaded');
    $('[name="illnesses[]"]').on('change', function() {
        const $this = $(this);
        const $extraField = $this.siblings('.medical-history-extra-field');

        if ($this.is(':checked') && $this.val() === 'Other') {
            $extraField.removeClass('d-none').prop('required', true);
        } else {
            $extraField.addClass('d-none').prop('required', false);
        }
    const selectedValues = $('[name="illnesses[]"]:checked').map(function() {
            return $(this).val();
        }).get();
        console.log(selectedValues);
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

});