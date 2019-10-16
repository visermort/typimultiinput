(function(){
    var validators = {
        'required': {'function':validateRequired, 'message': ':title is required'},
        'max': {'function': validateMax, 'message': ':title may not be greater than :value'},
        'min': {'function': validateMin, 'message': ':title must be at least :value'}
    };

    $('body').on('click', '.btn-lang-js', function() {

        var locale = $(this).data('locale');
        if (locale == 'all') {
            $('.multiinput .form-group').show();
        } else {
            $('.multiinput .form-group')
                .has('[data-translatable="1"]')
                .hide()
                .has('[data-language="' + locale + '"]')
                .show();
        }
    });


    $('body').on('click', '.multiinput-elem-add', function(){
        var tbody = $(this).closest('.multiinput').find('table tbody');
        if (tbody.length) {
            tbody = tbody[0];
            var rows = $(tbody).children('tr');
            if (rows.length) {
                var newRow = $(rows[0]).clone();
                $(tbody).append(newRow);
                clearRowValues(newRow);
                orderRowNumbers(tbody)
            }

        }
    });

    $('body').on('click', '.multiinput-elem-remove', function() {
        var tbody = $(this).closest('tbody');
        if ($(tbody).children('tr').length > 1) {
            $(this).closest('tr').remove();
            orderRowNumbers(tbody);
        }
    });

    function orderRowNumbers(tbody) {
        var rows = $(tbody).children('tr');
        var attribute = $(tbody).closest('.multiinput').attr('data-attribute');

        attribute = attribute.replace(new RegExp('\\[', 'g'), '\\[').replace(new RegExp('\\]', 'g'), '\\]');
        $(rows).each(function(index, row) {
            var pattern = '^'+attribute+'\\[\\d+\\]';
            var replacement = attribute+'['+index+']';

            $(row).find('input,select,textarea').each(function(i, input) {
                var name = $(input).attr('name');
                var newName = name.replace(new RegExp(pattern), replacement).replace(new RegExp('\\\\', 'g'), '');

                $(input).attr('name', newName);
                $(input).attr('id', newName);
                $(input).siblings('label').attr('for', newName);
            });
            $(row).find('td').each(function(i, td) {
                var dataAttr = $(td).attr('data-attribute');
                if (dataAttr) {
                    var newAttr = dataAttr.replace(new RegExp(pattern), replacement).replace(new RegExp('\\\\', 'g'), '');
                    $(td).attr('data-attribute', newAttr);
                }
                $(td).children('.multiinput').each(function(i, mi) {
                    dataAttr= $(mi).attr('data-attribute');
                    if (dataAttr) {
                        var newAttr = dataAttr.replace(new RegExp(pattern), replacement).replace(new RegExp('\\\\', 'g'), '');
                        $(mi).attr('data-attribute', newAttr);
                    }
                });
            });
        });
    }
    function clearRowValues(row){
        $(row).find('input').val('');
        $(row).find('select').val('');
        $(row).find('textarea').html('');
        $(row).find('.multiinput tbody tr:not(:first)').remove();
        $(row).find('.filemanager-item-trans').addClass('new-item').closest('td').attr('data-rules', null);
    }

    function validateRequired(value){
        return value && value !== "undefined" && value !== ""
    }
    function validateMax(value, max){
        return !value || value === "undefined" || value.length <= max;
    }
    function validateMin(value, min){
        return value && value !== "undefined" && value.length >= min;
    }
    function renderValidationMessage(template, params){
        for (var param in params) {
            template = template.replace(':'+param, params[param]);
        }
        return template;
    }

    function errorHandle(element, add, message) {
        var formGroup = element.closest('.form-group');
        if (add) {
            element.addClass('is-invalid');
            var feedback = formGroup.find('.multiinput-invalid-feedback');
            if (!feedback.length) {
                feedback = $('<div class="multiinput-invalid-feedback"></div>');
                feedback.appendTo(formGroup);
            }
            $(feedback).html(message);
        } else {
            element.removeClass('is-invalid');
            formGroup.find('.multiinput-invalid-feedback').remove();
        }
    }

    function validateForm(form){
        var success = true;
        $(form).find('.multiinput').find('input,textarea,select').each(function(i, element) {
            element = $(element);
            errorHandle(element, false);
            var rules = element.closest('td').data('rules');
            if (typeof rules !== "undefined") {
                if (rules) {
                    var messages = [];
                    var messageParams = {'title': element.siblings('label').html()};
                    for (var rule in rules) {
                        if (typeof validators[rule] !== "undefined" && typeof validators[rule]['function'] !== "undefined") {
                            var result = validators[rule]['function'](element.val(), rules[rule]);
                            if (!result) {
                                if (typeof rules[rule] != 'object') {
                                    messageParams['value'] = rules[rule];
                                }
                                messages.push(renderValidationMessage(validators[rule]['message'], messageParams));
                            }
                        }
                    }
                    if (messages.length) {
                        success = false;
                        errorHandle(element, true, messages.join(', '));
                    }
                }
            }
        });
        return success;
    }

    $(document).ready(function(){
        $('.multiinput').closest('form').on('submit', function() {
            if (validateForm(this)) {
                return true;
            }
            return false;
        });
    });

})();