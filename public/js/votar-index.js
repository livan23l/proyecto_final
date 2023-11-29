$(document).ready(function () {
    setTimeout(function () {
        $('#alert_votar').alert('close');
    }, 2500);
});

document.addEventListener('DOMContentLoaded', function () {
    var alert = document.getElementById('alert-confirmacion-voto');

    // Al dar click en el votón de enviar se mostrará la alerta:
    document.getElementById('btn-votar-1').addEventListener('click', function () {
        alert.classList.remove("d-none");
    });

    // Cuando el modal se cierre se volverá a agregar la clase "d-none" a la alerta:
    document.getElementById('modal-votar').addEventListener('hidden.bs.modal', function () {
        alert.classList.add("d-none");
    });
});