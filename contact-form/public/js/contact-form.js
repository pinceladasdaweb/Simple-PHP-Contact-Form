(function ($, window, document, undefined) {
    'use strict';

    function isSafari() {
        return /^((?!chrome).)*safari/i.test(navigator.userAgent);
    }

    function addError (el) {
        return el.parent().addClass('has-error');
    };

    var inputElem = document.createElement('input');

    if (!('required' in inputElem) || isSafari()) {
        $('#contact-form').submit(function () {
            var hasError = false,
                name     = $('#form-name'),
                mail     = $('#form-email'),
                subject  = $('#form-subject'),
                message  = $('#form-message'),
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