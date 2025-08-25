$(document).ready(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });

    $('.save-new-inventory-item').on('click', function(e){
        e.preventDefault();
        const formData = $('.new-inventory-item').serializeArray();
        console.log(formData);
        $('.new-inventory-item-modal').removeClass('visually-hidden');
        $.each(formData, (index, fields)=>{
            $(`[name='${fields.name}']`).removeClass('is-invalid');
            if(fields.value === ''){
                Toast.fire({
                    icon: 'info',
                    title: 'Missing Fields',
                    text: 'Please fill all fields'
                });
                $(`[name='${fields.name}']`).addClass('is-invalid');
                return;
            }
        });
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
    const inventoryStat = localStorage.getItem('inventory');
    if(inventoryStat === 'added'){
        Toast.fire({
            icon: 'success',
            title: 'Inventory',
            text: 'New item has been added to the inventory'
        });
        localStorage.removeItem('inventory');
    }
});
