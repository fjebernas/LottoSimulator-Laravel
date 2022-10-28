$(document).ready(function () {
    let notifMsg = $('#toast-data-holder').attr('data-msg').trim();
    let notifType = $('#toast-data-holder').attr('data-type').trim();

    if (notifMsg.length != "") {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: notifType,
            title: notifMsg,
            showConfirmButton: false,
            timer: 2500
        })
    }
});