document.addEventListener('DOMContentLoaded', function() {
    loadReservas();

    document.getElementById('reservaForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('php/create.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            loadReservas();
        })
        .catch(error => console.error('Error:', error));
    });
});

function loadReservas() {
    fetch('php/read.php')
        .then(response => response.json())
        .then(data => {
            const reservasDiv = document.getElementById('reservas');
            reservasDiv.innerHTML = '';
            data.forEach(reserva => {
                const reservaElement = document.createElement('div');
                reservaElement.innerHTML = `
                    <p>Fecha: ${reserva.fecha}</p>
                    <p>Hora de Inicio: ${reserva.hora_inicio}</p>
                    <p>Hora de Fin: ${reserva.hora_fin}</p>
                    <p>Comentarios: ${reserva.comentarios}</p>
                    <button onclick="editReserva(${reserva.id}, '${reserva.fecha}', '${reserva.hora_inicio}', '${reserva.hora_fin}', '${reserva.comentarios}')">Editar</button>
                    <button onclick="deleteReserva(${reserva.id})">Eliminar</button>
                    <hr>
                `;
                reservasDiv.appendChild(reservaElement);
            });
        })
        .catch(error => console.error('Error:', error));
}

function editReserva(id, fecha, horaInicio, horaFin, comentarios) {
    document.getElementById('fecha').value = fecha;
    document.getElementById('horaInicio').value = horaInicio;
    document.getElementById('horaFin').value = horaFin;
    document.getElementById('comentarios').value = comentarios;

    const submitButton = document.querySelector('button[type="submit"]');
    submitButton.textContent = 'Actualizar';
    submitButton.onclick = function(event) {
        event.preventDefault();
        const formData = new FormData(document.getElementById('reservaForm'));
        formData.append('id', id);

        fetch('php/update.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            loadReservas();
            submitButton.textContent = 'Reservar';
            submitButton.onclick = null;  // Reset submit handler
        })
        .catch(error => console.error('Error:', error));
    };
}

function deleteReserva(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta reserva?')) {
        fetch('php/delete.php?id=' + id, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            loadReservas();
        })
        .catch(error => console.error('Error:', error));
    }
}
