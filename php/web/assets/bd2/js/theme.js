$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$('.pagination .disabled a, .pagination .active a').on('click', function (event) {
    event.preventDefault();
});

$('.disposable-alert').each(function () {
    var alertId = $(this).data('disposable-alert-id');
    if ($.cookie('disposableAlert' + alertId) == 'closed') {
        $(this).remove();
    } else {
        $(this).css('visibility', 'visible');
        $(this).slideDown(500);
    }
});

$('.disposable-alert .close').on('click', function (event) {
    event.preventDefault();
    var alertId = $(this).parent().data('disposable-alert-id');
    $.cookie('disposableAlert' + alertId, 'closed', {path: '/'});
});

function ajaxContent(event) {
    event.preventDefault();
    var contentElement = $(this).parents('.ajax-content');

    contentElement.block();

    $.ajax({
        url: $(this).attr('href')
    }).done(function (html) {

        contentElement.replaceWith(html);

        var ajaxLinks = $('.ajax-content a');
        ajaxLinks.off('click', ajaxContent);
        ajaxLinks.on('click', ajaxContent);
    });

    contentElement.unblock();
}

$('.ajax-content a').on('click', ajaxContent);
