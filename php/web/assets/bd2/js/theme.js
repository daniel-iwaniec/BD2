$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$('.pagination .disabled a, .pagination .active a').on('click', function (event) {
    event.preventDefault();
});
