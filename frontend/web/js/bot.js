/**
 * Created by user on 29.05.2017.
 */

$(document).ready(function () {
    $('#w0').on('click', 'tbody tr', function (e) {
        //e.preventDefault();

        var request = $.ajax({
            type: 'GET',
            url: '',
            dataType: 'text',
            data: {
                'page': 3,
                'per-page': 10
            },
        });

        request.done(function (result) {

        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });

    });
});
