$(document).ready(function () {

    $('.product-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

});