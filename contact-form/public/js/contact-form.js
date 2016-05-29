/*
--------------------------------
Simple PHP Contact Form
--------------------------------
+ https://github.com/pinceladasdaweb/Simple-PHP-Contact-Form
+ A Simple Contact Form developed in PHP with HTML5 Form validation.
+ Has a fallback in jQuery for browsers that do not support HTML5 form validation.
+ version 1.1
+ Copyright 2015 Pedro Rogerio
+ Licensed under the MIT license

+ https://github.com/pinceladasdaweb/Simple-PHP-Contact-Form
*/

(function ($, window, document, undefined) {
    'use strict';

    function hasFormValidation () {
        return (typeof document.createElement('input').checkValidity === 'function');
    };

    function addError (el) {
        return el.parent().addClass('has-error');
    };

    if (!hasFormValidation()) {
        $('#contact-form').submit(function () {
            var hasError = false,
                name     = $('#form-name'),
                mail     = $('#form-email'),
                subject  = $('#form-assunto'),
                message = $('#form-mensagem'),
                testmail = /^[^0-9][A-z0-9._%+-]+([.][A-z0-9_]+)*[@][A-z0-9_-]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/,
                $this    = $(this);

            $this.find('div').removeClass('has-error');

            if (name.val() === '') {
                hasError = true;
                addError(name);
            }

            if (!testmail.test(mail.val())) {
                hasError = true;
                addError(mail);
            }

            if (subject.val() === '') {
                hasError = true;
                addError(subject);
            }

            if (message.val() === '') {
                hasError = true;
                addError(message);
            }

            if (hasError === false) {
                return true;
            }

            return false;
        });
    }
}(jQuery, window, document));