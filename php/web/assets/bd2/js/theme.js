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

function refreshBindings() {
    var ajaxLinks = $('.ajax-content a');
    ajaxLinks.off('click', ajaxContent);
    ajaxLinks.on('click', ajaxContent);

    var ajaxForms = $('.ajax-content form');
    ajaxForms.off('submit', ajaxFiltration);
    ajaxForms.on('submit', ajaxFiltration);

    var translateFK = $('.ajax-content .translate-fk-ico');
    translateFK.off('click', translateForeignKeys);
    translateFK.on('click', translateForeignKeys);
}

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

        refreshBindings();
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

        refreshBindings();
    }).fail(function () {
        pagination.unblock();
        table.unblock();
    });
}

function translateForeignKeys(event) {
    event.preventDefault();
    var icon = $(this);
    var row = $(this).parents('tr');
    var contentElement = $(this).parents('.ajax-content');
    var pagination = contentElement.find('.pagination');
    var table = contentElement.find('.table');

    var options = {message: null, baseZ: 10000, overlayCSS: {opacity: 0.2, cursor: 'progress'}};

    pagination.block(options);
    table.block(options);

    if (icon.hasClass('glyphicon-eye-close')) {
        row.find('.foreign-key').each(function () {
            var id = parseInt($(this).data('foreign-key-value'));
            $(this).text(id);
        });

        icon.removeClass('glyphicon-eye-close');
        icon.addClass('glyphicon-eye-open');

        refreshBindings();
        pagination.unblock();
        table.unblock();

        return false;
    }

    var data = {};

    row.find('.foreign-key').each(function () {
        var tableName = $(this).data('foreign-key-table');
        data[tableName] = parseInt($(this).text());
    });

    $.ajax({
        type: "POST",
        url: '/translatefk',
        data: data,
        timeout: 10000
    }).done(function (response) {
        row.find('.foreign-key').each(function () {
            var tableName = $(this).data('foreign-key-table');
            $(this).text(response[tableName]);
        });

        icon.removeClass('glyphicon-eye-open');
        icon.addClass('glyphicon-eye-close');

        pagination.unblock();
        table.unblock();
        refreshBindings();
    }).fail(function () {
        pagination.unblock();
        table.unblock();
    });
}

$('.ajax-content a').on('click', ajaxContent);
$('.ajax-content form').on('submit', ajaxFiltration);
$('.ajax-content .translate-fk-ico').on('click', translateForeignKeys);
