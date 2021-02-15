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
    var html = '<div id="comment-validation" class="govuk-error-summary" aria-labelledby="error-summary-title" role="alert" tabindex="-1" data-module="govuk-error-summary">';
    html += '<h3 id="error-summary-title" class="govuk-error-summary__title">Please complete the required fields</h3><div class="govuk-error-summary__body"><ul class="govuk-list govuk-error-summary__list">';
    errors.forEach(function(error) {
        html += '<li>' + error + '</li>';
    });
    html += '</ul></div></div>';
    $("#respond header").after(html);
}

function addErrorMarker(field, errorText) {
    field.parent("div.govuk-form-group").addClass("govuk-form-group--error");
    field.siblings("label").append("<span class='govuk-error-message'>" + errorText + "</span>");
}

function removeErrorMarker(field) {
    field.siblings("label").find("span.govuk-error-message").remove();
    field.parent("div.govuk-form-group").removeClass("govuk-form-group--error");
}

jQuery(function ($) {
    'use strict';

    $("#commentform .govuk-button").click(function () {

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
