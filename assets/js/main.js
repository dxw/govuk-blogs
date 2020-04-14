/* jshint asi: true */
/* global jQuery: false */
/* global cookie: false */

window.GOVUKFrontend.initAll()

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

    $(function(){
        $('input.search-query').data('holder',$('input.search-query').attr('placeholder'));
        $('input.search-query').focusin(function(){
            $(this).attr('placeholder','');
        });
        $('input.search-query').focusout(function(){
            $(this).attr('placeholder',$(this).data('holder'));
        });
    })


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


   /// Fix audioboo embed height. Needs to be done with jQuery because of shared class names
    $('.embedly-embed').css({'position':'relative'}).parent().css({'padding-top':'0' , 'padding-bottom':'0' ,  'height':'auto'});

    //Get survey cookie, show banner if not set to true
    $(document).ready(function() {
        var surveyTaken = GOVUK.cookie('no-more-survey');
        if(surveyTaken != 'true') {
            $('#user-satisfaction-survey').show();
        }
    })

    ///Set survey cookie
    $('#survey-no-thanks').click(function() {
        GOVUK.cookie('no-more-survey', 'true', { days: 365 });
        $('#user-satisfaction-survey').hide();
    });
    $('#take-survey').click(function() {
        GOVUK.cookie('no-more-survey', 'true', { days: 365 });
    });

    // From git@git.dxw.net:libs/lte-ie
    if (bowser.msie) {
      var h = $('html')

      for (var v = 0; v <= 15; v++) {
        if (bowser.version <= v) {
          h.addClass('lte-ie'+v)
        }
        if (bowser.version < v) {
          h.addClass('lt-ie'+v)
        }
      }
    }

    // Analytics for external links
    $('a').click(function (e) {
      var href = $(e.currentTarget).attr('href')
      var u = new URL(href, document.location.href)

      var isHttps = u.protocol === 'https:'
      var hostnameMatches = (u.hostname === 'blog.gov.uk' || u.hostname.endsWith('.blog.gov.uk'))

      //Ignore if https://blog.gov.uk or https://*.blog.gov.uk
      if (isHttps && hostnameMatches) {
        return
      }

      if (typeof ga !== 'function') {
        return
      }

      // Create a promise which either returns once ga has fired an event, or
      // after 500ms, whichever comes first
      var p = new Promise(function (resolve, reject) {
        setTimeout(reject, 500);
        ga('send', 'event', 'outbound', 'click', u.href, {
          'transport': 'beacon',
          'hitCallback': resolve,
        })
      })

      // Execute the promise
      p.finally(function () {
        console.log('hi')
        // do nothing
      })

      // Return without calling preventDefault() thus allowing the navigation
      // to occur
    })
})
