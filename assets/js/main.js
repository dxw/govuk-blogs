/* jshint asi: true */
/* global jQuery: false */
/* global cookie: false */

jQuery(function ($) {
    'use strict';

    // Categories dropdown

    $('.js-categories-dropdown').change(function (e) {
        var cat = parseInt(this.value, 10)
        if (cat === 0) {
            location.href = '/'
        } else {
            location.href = '/?cat=' + cat
        }
    })


    // Leave a comment

    var comment = $('#comment'),
        commentExtra = $('.js-comment-extra'),
        commentHeight = comment.height()

    commentExtra.hide()
    comment.height(commentHeight / 4)

    comment.focus(function () {
        comment.animate({
            height: commentHeight,
        })
        commentExtra.slideDown()
    })


    // Polyfills

    $('input, textarea').placeholder()


    // Transform category list into select box on mobile view

    var mobileMaxWidth = $(window).width();
    if (mobileMaxWidth < 768) {
        $('.widget_categories ul').each(function() {
            var list = $(this),
            select = $(document.createElement('select')).insertBefore($(this).hide()).change(function() {
                window.location.href = $(this).val();
            });
            $('>li a', this).each(function() {
                var option = $(document.createElement('option'))
                .appendTo(select)
                .val(this.href)
                .html($(this).html());
                if($(this).attr('class') === 'selected') {
                    option.attr('selected','selected');
                }
            });
            list.remove();
        });
    }

})
