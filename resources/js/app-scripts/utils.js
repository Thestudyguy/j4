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
    
});