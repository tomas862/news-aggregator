$(document).ready(function(){
    var elements = [];
    $(document).on('click', '.category-list', function(event){
        $(this).button('loading');
        elements.push(parseInt($(this).attr('id')));
        event.preventDefault();
        processFilter($(this), elements);

    });

    $(document).on('click', '.category-filtered', function(event){
        $(this).button('loading');
        var index = elements.indexOf(parseInt($(this).attr('id')));
        if (index > -1) {
            elements.splice(index, 1);
            event.preventDefault();
            processDeleteFilter($(this));
        }
    });
});

function processFilter(btn, elements)
{
    $.ajax({
        'url': '/',
        'method': 'POST',
        'async': true,
        'headers': {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')},
        'data': {
            action: 'processFilter',
            filters: JSON.stringify(elements),
            ajax: 1
        },
        'dataType': 'html',
        'success': function(response) {
            if (response) {
                btn.removeClass('category-list')
                        .addClass('category-filtered')
                        .addClass('list-group-item-info');

                var container = $('.feeds-container');
                container.find('.feed-content').replaceWith(response);
            }
            btn.button('reset');
        }
    });
}

function processDeleteFilter(btn)
{
    btn.removeClass('category-filtered')
            .removeClass('list-group-item-info')
            .addClass('category-list');

    var filter_elements = [];

    $('.category-filtered').each(function(){
        filter_elements.push(parseInt($(this).attr('id')));
    });

    $.ajax({
        'url': '/',
        'method': 'POST',
        'async': true,
        'headers': {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')},
        'data': {
            action: 'processFilter',
            filters: JSON.stringify(filter_elements),
            ajax: 1
        },
        'dataType': 'html',
        'success': function(response) {
            if (response) {
                var container = $('.feeds-container');
                container.find('.feed-content').replaceWith(response);
            }
            btn.button('reset');
        }
    });
}