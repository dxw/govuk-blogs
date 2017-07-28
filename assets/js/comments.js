function scrollToId(id) {
    var idTag = $(id);
    $('html,body').animate({scrollTop: idTag.offset().top},'slow');
}

function inputEmpty(input) {
    if(input.hasClass("required") && input.val()=='') {
        return true;
    }
    return false;
}

function validEmail(address) {
    var pattern = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i;
    return pattern.test(address);
}

function invalidEmailInput(input) {
    if(input.hasClass("required") && !validEmail(input.val())) {
        return true;
    }
    return false;
}

function addErrorPanel(errors) {
    $("#comment-validation").remove();
    var html = '<div id="comment-validation" class="error-summary alert" role="alert">';
    html += '<h3>Please complete the required fields</h3>';
    errors.forEach(function(error) {
        html += '<p>' + error + '</p>';
    });
    html += '</div>';
    $("#respond header").after(html);
}

function addErrorMarker(field, errorText) {
    field.parent("div.form-group").addClass("error");
    field.siblings("label").append("<span class='error'>" + errorText + "</span>");
}

function removeErrorMarker(field) {
    field.siblings("label").find("span.error").remove();
    field.parent("div.form-group").removeClass("error");
}

jQuery(function ($) {
    'use strict';

    $("#commentform input#submit").click(function () {
        var errors = [];
        var commentField = $("#commentform #comment");
        var nameField = $("#commentform #author");
        var emailField = $("#commentform #email");
        removeErrorMarker(commentField);
        removeErrorMarker(nameField);
        removeErrorMarker(emailField);
        if(inputEmpty(commentField)) {
            var errorText = "Please enter comment text"
            errors.push("<a href='#comment_field'>" + errorText + "</a>");
            addErrorMarker(commentField, errorText);
        }
        if(inputEmpty(nameField)) {
            var errorText = "Please enter a name"
            errors.push("<a href='#name_field'>" + errorText + "</a>");
            addErrorMarker(nameField, errorText);
        }
        if(invalidEmailInput(emailField)) {
            var errorText = "Please enter a valid email address"
            errors.push("<a href='#email_field'>" + errorText + "</a>");
            addErrorMarker(emailField, errorText);
        }
        if(errors.length>0) {
            addErrorPanel(errors);
            scrollToId('#comment-validation');
            return false;
        }
    });

})
