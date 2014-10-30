$(document).ready(function () {
    $('#register-button').on('click', function() {
        $('#login-form').slideUp();
        $('#register-form').slideDown();
        return false;
    });
});