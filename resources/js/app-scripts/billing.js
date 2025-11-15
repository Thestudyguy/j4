$(document).ready(function () {
    $(function () {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
        // ensure jQuery is loaded
        if (typeof $ === 'undefined') {
            console.error("jQuery not loaded.");
            return;
        }
        let billingObj = [];
        let selectedAppointmentID = null;
        $('#appointment').on('change', function (e) {
            selectedAppointmentID = $(this).val();

        });


        $('.item-btn').on('click', function (e) {
            e.preventDefault();
            if (!selectedAppointmentID) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please select an appointment first'
                });
                return;
            }
            let qty = $(this).closest('tr').find('input[name="quantity"]').val();
            let itemName = $(this).data('itemname');
            let id = $(this).data('id');
            let price = $(this).data('price');

            let exists = billingObj.find(item => item.itemID == id);
            if (exists) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Item already selected'
                });
                return;
            }

            billingObj.push({
                appointmentID: selectedAppointmentID,
                quantity: qty,
                item: itemName,
                itemID: id,
                itemprice: price,
            });
            renderBillingTable();
            console.log(billingObj);

        });

        $('input[name="quantity"]').on('input', function () {
            const max = parseInt($(this).attr('max'));
            let val = parseInt($(this).val());

            if (val > max) {
                $(this).val(max);
            }
            if (val < 1 || isNaN(val)) {
                $(this).val(1);
            }
        });


        function renderBillingTable() {
            let tbody = $('#billing-table tbody');
            tbody.empty();

            billingObj.forEach(row => {
                let total = row.quantity * row.itemprice;

                tbody.append(`
            <tr>
                <td>${row.quantity}</td>
                <td>${row.item}</td>
                <td>${row.itemprice}</td>
                <td>${total}</td>
                <td>
                    <span style="cursor: pointer;" class="badge bg-danger text-white fw-bold sm">remove</span>
                </td>
            </tr>
        `);
            });
        }
        $('#billing-table').on('click', '.badge.bg-danger', function () {
            let row = $(this).closest('tr');
            let itemName = row.find('td:eq(1)').text();
            billingObj = billingObj.filter(item => item.item !== itemName);
            row.remove();
            console.log("Updated billingList:", billingObj);
        });
        $('#search-items').on('keyup', function () {
            let searchText = $(this).val().toLowerCase();

            $('table tbody tr').each(function () {
                let itemName = $(this).find('td select option:selected').text().toLowerCase();

                if (itemName.indexOf(searchText) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $('.save-new-billing').on('click', function(e) {
    e.preventDefault();

    // Make sure there is at least one item
    if (billingObj.length === 0) {
        Toast.fire({
            icon: 'warning',
            title: 'No items selected'
        });
        return;
    }

    // Optional: disable button to prevent double click
    $(this).prop('disabled', true);
    console.log(billingObj);
    $('.billings-page').removeClass('visually-hidden');
    $.ajax({
        url: 'store-billing', // Your route to save billing
        method: 'POST',
        data: {
            appointmentID: $('#appointment').val(), // Selected appointment
            items: billingObj // The array of items
        },
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            },
        success: function(response) {
    $('.billings-page').addClass('visually-hidden');
            // Toast.fire({
            //     icon: 'success',
            //     title: 'Billing saved successfully'
            // });

            // Clear billing object and table
            billingObj = [];
            renderBillingTable();
            localStorage.setItem('billing', 'save');
            location.reload();
            // Enable button again
            $('.save-new-billing').prop('disabled', false);
        },
        error: function(xhr) {
    $('.billings-page').addClass('visually-hidden');
    console.error(xhr.responseText);

    let message = 'Failed to save billing';
    if(xhr.status === 409) { // Duplicate billing
        message = xhr.responseJSON.message;
    }

    Toast.fire({
        icon: 'error',
        title: message
    });

    $('.save-new-billing').prop('disabled', false);
}
    });
});

    if(localStorage.getItem('billing') === 'save'){
         Toast.fire({
                icon: 'success',
                title: 'Billing saved successfully'
            });
            localStorage.removeItem('billing');
    }
    })
});