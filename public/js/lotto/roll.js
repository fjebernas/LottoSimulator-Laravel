$(document).ready(function($){
    
    // swal notification for starting the roll event
    Swal.fire(
        $('#notification-msg').attr('data-msg'),
        'Good luck!',
        'info'
    )
    
    var roll_event_id = $('#roll_event_id').attr('value');
    var seeResultsBtn = `<input type='hidden' name='roll_event_id' value='${roll_event_id}'>
                        <button class='btn btn-warning btn-lg' type='submit'>See results</button>`;

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

                $('#rolls-left-container').text('Rolls left: ' + data['rolls_left']);

                // change jumbotron button when rolls left is 0
                if (data['rolls_left'] <= 0) {
                    $('#btn-roll-container').replaceWith(seeResultsBtn);
                }
                
                // highlight the td of the matched digit in table
                $('.' + data['rolled_digit']).addClass('bg-success fw-bold text-warning');

                // swal notification msg
                Swal.fire(
                    String('Rolled digit: ' + data['rolled_digit']),
                    data['msg'],
                )
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});