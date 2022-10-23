$(document).on('click', '#btn-proceed', function(){

    bootbox.confirm({
        message: "<h6>This will register your tickets to the roll event. Continue?</h6>",
        buttons: {
            confirm: {
                label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                className: 'btn-warning'
            },
            cancel: {
                label: '<span class="glyphicon glyphicon-remove"></span> No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {

            if(result==true){
                window.location.href = "/lotto/rolling";
            }
        }
    });

    // bootbox.alert("This is the default alert!");

    return false;
});