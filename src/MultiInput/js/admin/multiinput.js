(function(){
    function copyValues() {
        $('.multiinput td').each(function (index, element) {
            element = $(element);
            var data = element.data('value');
            var attribute = element.data('attribute');
            if (data && attribute) {
                var lang, currentAttribute, value;
                if (typeof(data) == 'object') {
                    for (lang in data) {
                        value = data[lang];
                        currentAttribute = attribute+'['+lang+']';
                        copyElementValue(element, currentAttribute, value);
                    }
                } else {
                    copyElementValue(element, attribute, data);
                }
            }
        });
    }
    function copyElementValue(element, attribute, value) {
        element.find('input[name="' + attribute + '"]:not([type="checkbox"])').val(value);
        element.find('textarea[name="' + attribute + '"]').html(value);
        element.find('select[name="' + attribute + '"]').val(value);
        element.find('input[type="checkbox"][name="'+ attribute + '"]').prop('checked', value);
    }

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
        if ($(tbody).find('tr').length > 1) {
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
    function clearRowValues(row)
    {
        $(row).find('input').val('');
        $(row).find('select').val('');
        $(row).find('textarea').html('');
        $(row).find('.multiinput tbody tr:not(:first)').remove();
    }

    copyValues();

})();