/**
 * Created by tomas on 16.11.29.
 */
$(document).ready(function(){
    $('.category-list').on('toggle', function(){
        alert('sadsad');
        var button = $(this);
        $.ajax({
            'url': '/',
            'method': 'POST',
            'async': true,
            'headers': {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')},
            'data': {
                action: 'ajaxFilter',
                id_category: parseInt($(this).attr('id')),
                ajax: 1
            },
            'dataType': 'html',
            'success': function(response) {
                button.addClass('active');
            }
        });
    });
});
