import './bootstrap';
import './app-scripts/utils';
import './app-scripts/client-appointment-form';
import './app-scripts/service';
import './app-scripts/doctors';
import './app-scripts/patient-account-creation';
import './app-scripts/patient-setup';
import './app-scripts/patient-appointment';
import './app-scripts/update-patient-appointment';
import './app-scripts/shceduled-patient-appointment';
import './app-scripts/inventory';
import './app-scripts/edit-patient-medical-history';
import './app-scripts/patient-appointment-note';
import './app-scripts/appointment-notes';
import './app-scripts/chatbot';
import './app-scripts/dentist-offsched';
import './app-scripts/billing';
$(document).on('input', 'input[name="serviceprice"]', function() {
    var value = $(this).val().replace(/[^0-9\.]/g, '');
    var parts = value.split('.');
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if (parts.length > 1) {
        $(this).val(parts[0] + '.' + parts[1]);
    } else {
        $(this).val(parts[0]);
    }

    

});
window.formatValueInput = function(input) {
        var value = input.value.replace(/[^0-9\.]/g, '');
        var parts = value.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        if (parts.length > 1) {
            input.value = parts[0] + '.' + parts[1];
        } else {
            input.value = parts[0];
        }
    };
$(document).ready(function () {

    $('#notifBtn').on('click', function (e) {
        e.stopPropagation();
        $('#notifDropdown').toggle();
    });

    // Close when clicking outside
    $(document).on('click', function () {
        $('#notifDropdown').hide();
    });

});
