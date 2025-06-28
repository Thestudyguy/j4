$(document).ready(function() {
    var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000
});
    $('#signatureUpload').on('change', function (e) {
      const file = e.target.files[0];
      const $preview = $('#signaturePreview');

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


    //multistep form navigation
    let currentStep = 1;
    const totalSteps = $('.multi-step').length;

    showStep(currentStep);

    $('.next-form-btn').click(function() {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    });

    $('.button-container .btn:contains("Back")').on('click', function () {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    function showStep(step) {
    $('.multi-step').addClass('visually-hidden');
    $('.multi-step.step-' + step).removeClass('visually-hidden');
    $('.client-step').removeClass('active');
    $('.client-form-indicator-line').removeClass('active');
    for (let i = 1; i <= step; i++) {
        $('.client-step.step' + i).addClass('active');
        if (i < step) {
            $('.client-form-indicator-line').eq(i - 1).addClass('active');
        }
    }
    const $nextBtn = $('.next-form-btn');
    const $backBtn = $('.button-container .btn:contains("Back")');
    const $finishBtn = $('.button-container .btn:contains("Finish")');

    if (step === 1) {
        $backBtn.addClass('visually-hidden');
        let clientInfoForm = $('.client-info-form').serializeArray();
        console.log(clientInfoForm);
        
    } else {
        $backBtn.removeClass('visually-hidden');
    }

    if (step === totalSteps) {
        $nextBtn.addClass('visually-hidden');
        $finishBtn.removeClass('visually-hidden');
    } else {
        $nextBtn.removeClass('visually-hidden');
        $finishBtn.addClass('visually-hidden');
    }
}
    $('.button-container .btn:contains("Finish")').on('click', function () {
        // $('.loader-overlay').removeClass('visually-hidden');
        Toast.fire({
            icon: 'success',
            title: 'Form submission',
            text: 'Your appointment form has been successfully submitted!'
        });
    });
    
});

