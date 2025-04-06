"use strict";

$(function () {

    $('#load-more').on('click', function (e) {
        e.preventDefault();
        loadMorePosts();
    });

    function loadMorePosts() {
        var page = 1;

        var data = {
            action: 'load_more',
            page: page,
            nonce: blog_load_more.nonce
        };

        $.post(blog_load_more.ajax_url, data, function (response) {
            if (response) {
                $('.blog .row').append(response);
                page++;
            }
        });
    }
})




