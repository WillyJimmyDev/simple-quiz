$(document).ready(function () {
    $('#questionBox').on('submit',function() {
        return checkForm();
    });
    $('#username').on('focus', function() {
        if ( $('#helper').text() !== '' ) {
            $('#helper').text('');
        }
    });
});

function checkForm() {
    var username = $('#username').val();
    if ((username === '') || (username === 'Username') || (username.length < 3) || (username.length > 10)) {
        $('#helper').text('To register, please enter a username between 3 and 10 characters in length');
        return false;
    }
    return true;
}
