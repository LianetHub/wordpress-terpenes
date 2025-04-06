"use strict";

$(function () {


    $('body').on('updated_wc_div', function () {
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'update_cart'
            },
            success: function (response) {
                if (response.success) {

                    $('.cart-count').attr('data-count', response.data.count);
                    $('.cart-total').html(response.data.total);
                }
            }
        });
    });



})




