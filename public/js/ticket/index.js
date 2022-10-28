$(document).on('click', '#btn-proceed', function(){
    Swal.fire({
        title: 'This will register your tickets to the roll event.',
        text: "Continue?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/lotto/rolling";
        }
    })
});