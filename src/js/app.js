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



    function updateURL() {
        var selectedCategories = [];
        var selectedMainProfiles = [];
        var selectedBrands = [];

        $('input[name="category[]"]:checked').each(function () {
            selectedCategories.push($(this).val());
        });

        $('.products__filter-item.active').each(function () {
            selectedMainProfiles.push($(this).data('value'));
        });

        $('input[name="brand[]"]:checked').each(function () {
            selectedBrands.push($(this).val());
        });

        var url = new URL(window.location.href);

        if (selectedCategories.length > 0) {
            url.searchParams.set('filter_product_cat', selectedCategories.join(','));
        } else {
            url.searchParams.delete('filter_product_cat');
        }

        if (selectedMainProfiles.length > 0) {
            url.searchParams.set('filter_main_profile', selectedMainProfiles.join(','));
        } else {
            url.searchParams.delete('filter_main_profile');
        }

        if (selectedBrands.length > 0) {
            url.searchParams.set('filter_brand', selectedBrands.join(','));
        } else {
            url.searchParams.delete('filter_brand');
        }

        window.location.href = url.toString();
    }

    $('.products__filter-item').on('click', function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        updateURL();
    });

    $('input[name="category[]"]').on('change', function () {
        updateURL();
    });

    $('input[name="brand[]"]').on('change', function () {
        updateURL();
    });

    $('.products__filter-btn').on('click', function () {
        updateURL();
    });

    function setCheckedFilters() {
        var urlParams = new URLSearchParams(window.location.search);
        var selectedCategories = urlParams.get('filter_product_cat');
        var selectedMainProfiles = urlParams.get('filter_main_profile');
        var selectedBrands = urlParams.get('filter_brand');

        if (selectedCategories) {
            selectedCategories.split(',').forEach(function (category) {
                $('input[name="category[]"][value="' + category + '"]').prop('checked', true);
            });
        }

        if (selectedMainProfiles) {
            selectedMainProfiles.split(',').forEach(function (profile) {
                $('.products__filter-item[data-value="' + profile + '"]').addClass('active');
            });
        }

        if (selectedBrands) {
            selectedBrands.split(',').forEach(function (brand) {
                $('input[name="brand[]"][value="' + brand + '"]').prop('checked', true);
            });
        }
    }

    setCheckedFilters();










});






