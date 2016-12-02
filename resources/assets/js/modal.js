$(document).ready(function(){
    $(document).on('click', '.feed-title', function(){
        ajaxOpenModal($(this));
    });
});

function ajaxOpenModal(feed)
{
    $.ajax({
        'url': '/',
        'method': 'POST',
        'async': true,
        'headers': {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')},
        'data': {
            action: 'processModal',
            id_feed: parseInt(feed.attr('id')),
            ajax: 1
        },
        'dataType': 'html',
        'success': function(response) {
            var object = JSON.parse(response);
            if (object.body) {
                $('.heading-container').replaceWith(
                    '<div class="heading-container"><h4 class="modal-title">'+feed.text()+'</h4></div>'
                );

                $('.modal-body').replaceWith(
                    '<div class="modal-body">'+object.body+'</div>'
                );

                $('.modal-href-item').attr('href', object.link);
            } else {
                $('.modal-body').replaceWith(
                    '<div class="modal-body"><div class="alert alert-info">Failed to receive texts. Click go to page</div></div>'
                );
            }
            $('#feed-modal').modal('show');
        }
    });
}
