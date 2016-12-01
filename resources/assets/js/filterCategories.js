$(document).ready(function(){
    var elements = [];
    $('.category-list').one('click', function(event){
        elements.push(parseInt($(this).attr('id')));
        processFilter($(this), elements);
    });
});

function processFilter(button, elements)
{
    $.ajax({
        'url': '/',
        'method': 'POST',
        'async': true,
        'headers': {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')},
        'data': {
            action: 'ajaxFilter',
            filters: JSON.stringify(elements),
            ajax: 1
        },
        'dataType': 'html',
        'success': function(response) {
            button.removeClass('category-list').addClass('category-filtered').off('category-list');
            button.append('<span class="badge"><i class="glyphicon glyphicon-remove"></i></span>');
        }
    });
}