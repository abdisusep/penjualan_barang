$(document).ready(function () {

    $('.loading').click(function () {
        loading();
    });



    function loading() {
        let timerInterval
        Swal.fire({
            html: 'Antosan nuju loading...',
            width: 300,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
            }
        })
    }

    $('#berhasil').click(function () {
        Swal.fire({
            icon: 'success',
            text: "Berhasil",
            showConfirmButton: false,
            timer: 2500,
            showClass: {
                popup: 'animate__animated animate__fadeIn'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOut'
            }
        })
    });

    $('#gagal').click(function () {
        Swal.fire({
            icon: 'error',
            text: "Gagal",
            showConfirmButton: false,
            timer: 2500,
            showClass: {
                popup: 'animate__animated animate__fadeIn'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOut'
            }
        })
    });

});