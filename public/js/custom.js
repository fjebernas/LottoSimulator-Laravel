$(document).on('click', '#btn-proceed', function(){

    bootbox.confirm({
        message: "<h6>This will register your tickets to the roll event. Continue?</h6>",
        buttons: {
            confirm: {
                label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                className: 'btn-danger'
            },
            cancel: {
                label: '<span class="glyphicon glyphicon-remove"></span> No',
                className: 'btn-primary'
            }
        },
        callback: function (result) {

            if(result==true){
                window.location.href = "/lotto/start";
            }
        }
    });

    return false;
});