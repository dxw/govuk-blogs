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

    // iPhone viewport fix

    (function(doc) {

        var addEvent = 'addEventListener',
            type = 'gesturestart',
            qsa = 'querySelectorAll',
            scales = [1, 1],
            meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

        function fix() {
            meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
            doc.removeEventListener(type, fix, true);
        }

        if ((meta = meta[meta.length - 1]) && addEvent in doc) {
            fix();
            scales = [.25, 1.6];
            doc[addEvent](type, fix, true);
        }

    }(document));
})
