if ($.cookie('alert-box-1') === 'closed') {
    $('.alert').hide();
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$('.pagination .disabled a, .pagination .active a').on('click', function (event) {
    event.preventDefault();
});

$('.alert .close').click(function (event) {
    event.preventDefault();

    var alertId = $(this).parent().data('alert-id');
    $.cookie('alert-box-' + alertId, 'closed', {path: '/'});
});
