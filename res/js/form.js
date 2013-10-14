$(document).ready(function () {
    $('#submit').prop('disabled',true);
    var inputs = $('#questionBox input');
    $.each(inputs, function() {
        $(this).on('click', function() {
            $('#submit').prop('disabled',false);
        });
    });
});