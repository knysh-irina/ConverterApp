$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function ($) {
    $('#upload_form').on('submit', function (submitEvent) {
        var filename = $("#file").val();
        var extension = filename.replace(/^.*\./, '');
        extension = extension.toLowerCase();
        switch (extension) {
            case 'json':
            case 'yaml':
            case 'csv':
            case 'xml':
            break;

            default:

               $('#error_message').html("Sorry, just json, xml, csv, yml allowed!");
                // Cancel the form submission
                submitEvent.preventDefault();
        }
    })
});