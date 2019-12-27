function animationDelete() {
    let timerInterval;
    Swal.fire({
        title: 'Eliminando',
        timer: 200,
        timerProgressBar: true,
        onBeforeOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {
                Swal.getContent().querySelector('b')
                // .textContent = Swal.getTimerLeft()
            }, 100)
        },
        onClose: () => {
            clearInterval(timerInterval)
        }
    })
    .then((result) => {
        if (result.dismiss === Swal.DismissReason.timer){}
    })
}