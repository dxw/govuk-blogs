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
            select = $(document.createElement('select')).insertBefore($(this).hide()).addClass('category-list').change(function() {
                window.location.href = $(this).val();
            });
            $('<option selected="selected">Select Category</option>').appendTo(select);
            $('>li a', this).each(function() {
                var option = $(document.createElement('option'))
                .appendTo(select)
                .val(this.href)
                .html($(this).html());
            });
            list.remove();
        });
    }


    // Transform category list into select and back on screen resize

    $(window).resize(function() {
        if ($(window).width() < 768){
           $('.widget_categories ul').not('hidden-mobile').each(function() {
                var list = $(this),
                select = $(document.createElement('select')).insertBefore($(this).hide()).addClass('category-list').change(function() {
                   window.location.href = $(this).val();
                });
                $('<option selected="selected">Select Category</option>').appendTo(select);
                $('>li a', this).each(function() {
                   var option = $(document.createElement('option'))
                   .appendTo(select)
                   .val(this.href)
                   .html($(this).html());
                });
                list.remove();
           });
        } else {
            $('select.category-list').parent().append('<ul class="categories"></ul>');
            $('select.category-list option:first-child').remove();
            $('select.category-list option').each(function(){
              $('ul.categories').append('<li class="cat-item"><a href="' + $(this).val() + '">'+$(this).text()+'</a></li>');
            });
            $('select.category-list').remove();
        }
    });


    // Roots theme meta data height

    var highestMeta = 0;
    $('.featured-posts .meta').each(function(){
        if($(this).height() > highestMeta){
            highestMeta = $(this).height();
        }   
    });
    $('.featured-posts .meta').height(highestMeta);
    $(window).resize(function() {
        if ($(window).width() > 979){
            var highestMeta = 0;
            $('.featured-posts .meta').each(function(){
                if($(this).height() > highestMeta){
                    highestMeta = $(this).height();
                }   
            });
            $('.featured-posts .meta').height(highestMeta);
        } if ($(window).width() > 768){
            var highestMeta = 0;
            $('.featured-posts .meta').each(function(){
                if($(this).height() > highestMeta){
                    highestMeta = $(this).height();
                }   
            });
            $('.featured-posts .meta').height(highestMeta);
        } else {
            $('.featured-posts .meta').css('height', 'auto');
        }
    });

})
