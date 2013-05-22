'use strict'
jQuery(function ($) {

    // Categories dropdown

    $('.js-categories-dropdown').change(function (e) {
        var cat = parseInt(this.value)
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


    // Cookies banner

    if (cookie.get('gds_seen_cookie_message') === undefined) {
        cookie.set('gds_seen_cookie_message', 'true')

        $('.js-cookies-banner').each(function () {
            $(this).html(
                '<div class="cookie-message full-width">' +
                '  <div class="container">' +
                '    <div class="row">' +
                '      <div class="span12">' +
                '        <p>' +
                '          GOV.UK blogs use cookies to make the site simpler. <a href="https://blog.gov.uk/cookies/">Find out more about cookies</a>' +
                '        </p>' +
                '      </div>' +
                '    </div>' +
                '  </div>' +
                '</div>'
            )
        })
    }


    // Polyfills

    $('input, textarea').placeholder()
})
