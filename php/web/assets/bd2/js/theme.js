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

$('.panel-csv').each(function () {
    var row = $(this).parents('.row');
    var well = row.find('.well');
    $(this).height(well.outerHeight() - 2);
});

function ajaxContent(event) {
    event.preventDefault();
    var contentElement = $(this).parents('.ajax-content');
    var pagination = contentElement.find('.pagination');
    var table = contentElement.find('.table');

    var options = {message: null, baseZ: 10000, overlayCSS: {opacity: 0.2, cursor: 'progress'}};

    pagination.block(options);
    table.block(options);

    $.ajax({
        url: $(this).attr('href'),
        timeout: 10000
    }).done(function (html) {
        contentElement.replaceWith(html);

        var ajaxLinks = $('.ajax-content a');
        ajaxLinks.off('click', ajaxContent);
        ajaxLinks.on('click', ajaxContent);

        var ajaxForms = $('.ajax-content form');
        ajaxForms.off('submit', ajaxFiltration);
        ajaxForms.on('submit', ajaxFiltration);
    }).fail(function () {
        pagination.unblock();
        table.unblock();
    });
}

function ajaxFiltration(event) {
    event.preventDefault();
    var contentElement = $(this).parents('.ajax-content');
    var pagination = contentElement.find('.pagination');
    var table = contentElement.find('.table');

    var options = {message: null, baseZ: 10000, overlayCSS: {opacity: 0.2, cursor: 'progress'}};

    pagination.block(options);
    table.block(options);

    var url = '/table/' + $(this).attr('action').split('/')[2] + '/1';

    var sort = null;
    var direction = null;
    contentElement.find('.sortable').each(function () {
        var link = $(this);
        if (link.hasClass('asc') || link.hasClass('desc')) {
            sort = link.data('field').toUpperCase();
            direction = link.hasClass('asc') ? 'asc' : 'desc';
            return false;
        }
    });

    if (sort == null) {
        sort = 'ID';
    }
    if (direction == null) {
        direction = 'asc';
    }
    url += '/' + sort + '/' + direction;

    var filterField = $(this).find('[name="filterField"]').val();
    var filterValue = $(this).find('[name="filterValue"]').val();
    if (filterField != '' && filterValue != '') {
        url += '/' + filterField;
        if (filterValue != '') {
            url += '/' + filterValue;
        }
    }

    $.ajax({
        type: 'get',
        url: url,
        timeout: 10000
    }).done(function (html) {
        contentElement.replaceWith(html);

        var ajaxLinks = $('.ajax-content a');
        ajaxLinks.off('click', ajaxContent);
        ajaxLinks.on('click', ajaxContent);

        var ajaxForms = $('.ajax-content form');
        ajaxForms.off('submit', ajaxFiltration);
        ajaxForms.on('submit', ajaxFiltration);
    }).fail(function () {
        pagination.unblock();
        table.unblock();
    });
}

$('.ajax-content a').on('click', ajaxContent);
$('.ajax-content form').on('submit', ajaxFiltration);
