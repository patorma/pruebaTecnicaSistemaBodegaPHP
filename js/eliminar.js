document.querySelectorAll('.eliminar').forEach(boton => {

    boton.addEventListener('click', function(e) {
        e.preventDefault();

        const id = this.getAttribute('data-id');

        if (!confirm('¿Está seguro de eliminar la bodega?')) {
            return;
        }

        fetch('eliminar_bodega.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id_bodega=' + id
        })
        .then(response => response.json())
        .then(data => {

            if (data.success) {
                // Eliminar fila visualmente sin recargar
                this.closest('tr').remove();
                alert(data.message);
            } else {
                alert(data.message);
            }

        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al eliminar');
        });

    });

});