$(document).ready(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });

    $('.save-new-inventory-item').on('click', function(e){
        e.preventDefault();
        let isInvalid = true;
        const formData = $('.new-inventory-item').serializeArray();
        // $('.new-inventory-item-modal').removeClass('visually-hidden');
        $.each(formData, (index, fields)=>{
            $(`[name='${fields.name}']`).removeClass('is-invalid');
            console.log(fields);
            
            if(fields.value === ''){
                isInvalid = false
                $(`[name='${fields.name}']`).addClass('is-invalid');
            }
        });
        if(!isInvalid){
                Toast.fire({
                    icon: 'info',
                    title: 'Missing Fields',
                    text: 'Please fill all fields'
                });
                return;
        }
        $('.new-inventory-item-modal').removeClass('visually-hidden');
        $.ajax({
            url: 'inventory/new-item',
            type: 'POST',
            data: formData,
            success: function(response){
                $('.new-inventory-item-modal').addClass('visually-hidden');
                localStorage.setItem('inventory', 'added');
                location.reload();
            },
            error: function(xhr, err, stat){
                $('.new-inventory-item-modal').addClass('visually-hidden');
                Toast.fire({
                    icon: 'error',
                    title: stat,
                    text: xhr.responseJSON?.error || 'Something went wrong'
                });
            }
        });
    });

    $('.update-inventory-item').on('click', function(e){
    e.preventDefault();
    let refID = $(this).data('refid');
    let $form = $(`.edit-inventory-form-${refID}`);
    let prepForm = $form.serializeArray();
    let today = new Date().toISOString().split('T')[0];
    let hasError = false;

    // Validation loop
    $.each(prepForm, (index, fields)=>{
        if(fields.value === ''){
            Toast.fire({
                icon: 'warning',
                title: 'Missing Fields',
                text: 'Please fill all fields'
            });
            $(`[name='${fields.name}']`).addClass('is-invalid');
            hasError = true;
            return false; // stop $.each
        } else {
            $(`[name='${fields.name}']`).removeClass('is-invalid');
        }

        if(fields.name === 'expiration_date'){
            let expDate = new Date(fields.value);
            let todayDate = new Date(today);

            if(expDate < todayDate){
                Toast.fire({
                    icon: 'error',
                    title: 'Invalid Date',
                    text: 'Expiration date cannot be in the past'
                });
                $(`[name='${fields.name}']`).addClass('is-invalid');
                hasError = true;
                return false;
            } else {
                $(`[name='${fields.name}']`).removeClass('is-invalid');
            }
        }

        if(fields.name === 'stock'){
            let qty = parseInt(fields.value);
            if(isNaN(qty) || qty <= 0){
                Toast.fire({
                    icon: 'error',
                    title: 'Invalid Quantity',
                    text: 'Stock must be a number greater than 0'
                });
                $(`[name='${fields.name}']`).addClass('is-invalid');
                hasError = true;
                return false;
            } else {
                $(`[name='${fields.name}']`).removeClass('is-invalid');
            }
        }
    });

    if(hasError) return; // stop if validation failed

    // Show loader
    $('.loader-container.inventory-page').removeClass('visually-hidden');
let updateUrl = `/inventory/update/${refID}`;
    // AJAX call
    $.ajax({
        url: updateUrl,
        method: 'POST',
        data: $form.serialize(),
        dataType: 'json',
          headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success: function(response){
            $('.loader-container.inventory-page').addClass('visually-hidden');

            if(response.success){
                // store message in localStorage
                localStorage.setItem('inventory', 'Updated');
                location.reload();
            } else {
                Toast.fire({
                    icon: 'error',
                    title: response.message
                });
            }
        },
        error: function(xhr){
            $('.loader-container.inventory-page').addClass('visually-hidden');
            let errMsg = 'Something went wrong';
            if(xhr.responseJSON && xhr.responseJSON.message){
                errMsg = xhr.responseJSON.message;
            }
            Toast.fire({
                icon: 'error',
                title: errMsg
            });
        }
    });
});


    $('.delete-inventory-item').on('click', function(e){
    e.preventDefault();
    let itemId = $(this).data('id');

    // Show loader
    $('.loader-container.inventory-page').removeClass('visually-hidden');

    $.ajax({
        url: `/inventory/delete/${itemId}`, // Route
        type: 'DELETE',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success: function(res){
            localStorage.setItem('inventory', 'removed');
            location.reload();
        },
        error: function(err){
            Toast.fire({
                icon: 'error',
                title: 'Error',
                text: err.responseJSON?.message || 'Failed to delete item.'
            });
            $('.loader-container.inventory-page').addClass('visually-hidden');
        }
    });
});

    const inventoryStat = localStorage.getItem('inventory');
    if(inventoryStat === 'added'){
        Toast.fire({
            icon: 'success',
            title: 'Inventory',
            text: 'Item has been successfully updated'
        });
        localStorage.removeItem('inventory');
    }
    if(inventoryStat === 'Updated'){
        Toast.fire({
            icon: 'success',
            title: 'Inventory',
            text: 'New item has been added to the inventory'
        });
        localStorage.removeItem('inventory');
    }
    if(inventoryStat === 'removed'){
        Toast.fire({
            icon: 'success',
            title: 'Inventory',
            text: 'Item has been deleted'
        });
        localStorage.removeItem('inventory');
    }
});
