$(document).ready(function() {
    var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000
});
    const patientPersonalInfo = {};
    
        
    
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


    // multi step nav

    let currentStep = 1;
    const totalSteps = $('.multi-step').length
    FormNav(currentStep);
    //navigate through the form
    $('.form-nav-btn-next').on('click', function(e){
        if(currentStep === 1){
            const personalInfoForm = $('.client-personal-info-form').serializeArray();
            const optionalFields = ['guardian', 'referal', 'guardianoccupation', 'faxno', 'nickname', 'officeno']
            let isFormEmpty = false;

            $.each(personalInfoForm, (index, field) => {
                $(`[name='${field.name}']`).removeClass('is-invalid');
            });
            $.each(personalInfoForm, (index, field) => {
                if (optionalFields.includes(field.name)) return;
                const value = field.value.trim();
                if (value === '') {
                    $(`[name='${field.name}']`).addClass('is-invalid');
                    isFormEmpty = true;
                }
            });
            if(isFormEmpty){
                $.each(personalInfoForm, (index, fields)=>{
                    console.log(fields.value);
                    // $(`[name='${fields.name}']`).addClass('is-invalid');
                    return;
                });
                Toast.fire({
                    icon: 'warning',
                    title: 'Missing Fields!',
                    text: 'Please fill out all the required fields'
                });     
                return;
            }      
        }

        if(currentStep < totalSteps){
            currentStep++;
            FormNav(currentStep);
        }
    });

    $('.form-nav-btn-back').on('click', function(){
        if(currentStep > 1){
            currentStep--;
            FormNav(currentStep);
        }
    });

    function FormNav(steps){
        $('.multi-step').addClass('visually-hidden');
        $('.multi-step.step-' + steps).removeClass('visually-hidden');
        $('.form-step-indicator').each(function(index){
            
            if(index < steps){
                $(this).
                removeClass('bg-secondary')
                .addClass('bg-info')
            }else{
                $(this)
                 .removeClass('bg-info fw-bold')
                .addClass('bg-secondary');
            }
        });
    }

    //multistep form navigation
    // let currentStep = 1;
    // const totalSteps = $('.multi-step').length;

    // showStep(currentStep);

    // $('.form-nav-btn-next').click(function() {
    //     if(currentStep === 1){
    //     }


    //     if (currentStep < totalSteps) {
    //         currentStep++;
    //         showStep(currentStep);
    //     }
    // });

    // $('.form-nav-btn-back').on('click', function () {
    //     if (currentStep > 1) {
    //         currentStep--;
    //         showStep(currentStep);
    //     }
    // });

    // function showStep(step) {
    // $('.multi-step').addClass('visually-hidden');
    // $('.multi-step.step-' + step).removeClass('visually-hidden');
    // $('.client-step').removeClass('active');
    // $('.client-form-indicator-line').removeClass('active');
    // for (let i = 1; i <= step; i++) {
    //     $('.client-step.step' + i).addClass('active');
    //     if (i < step) {
    //         $('.client-form-indicator-line').eq(i - 1).addClass('active');
    //     }
    // }
    // const $nextBtn = $('.next-form-btn');
    // const $backBtn = $('.button-container .btn:contains("Back")');
    // const $finishBtn = $('.button-container .btn:contains("Finish")');

    // if (step === 1) {
    //     $backBtn.addClass('visually-hidden');
        
        
    // } else {
    //     $backBtn.removeClass('visually-hidden');
    // }

    // if (step === totalSteps) {
    //     $nextBtn.addClass('visually-hidden');
    //     $finishBtn.removeClass('visually-hidden');
    // } else {
    //     $nextBtn.removeClass('visually-hidden');
    //     $finishBtn.addClass('visually-hidden');
    // }
// }
    $('.button-container .btn:contains("Finish")').on('click', function () {
        // $('.loader-overlay').removeClass('visually-hidden');
        Toast.fire({
            icon: 'success',
            title: 'Form submission',
            text: 'Your appointment form has been successfully submitted!'
        });
    });
    
});

