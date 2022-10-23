
var roll_event_id = $('#roll_event_id').attr('value');
var seeResultsBtn = "<input type='hidden' name='roll_event_id' value='" + roll_event_id + "'>\
                    <button class='btn btn-warning btn-lg' type='submit'>See results</button>";

$(document).ready(function($){
    
    $("#btn-roll").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();

        var formData = {
            roll_event_id: roll_event_id
        };

        $.ajax({
            type: "POST",
            url: "/lotto/rolling",
            data: formData,
            dataType: 'json',
            success: function (data) {
                // display rolled digit in jumbotron
                $('#rolled-digit-container').text(data['rolled_digit']);

                // change jumbotron button when rolls left is 0
                if (data['rolls_left'] == 0) {
                    $('#btn-roll-container').replaceWith(seeResultsBtn);
                }

                // set notification msg
                $('#notification-msg').text(data['msg']);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});