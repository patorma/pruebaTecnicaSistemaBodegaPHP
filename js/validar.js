$('#formBodega').on('submit',function(e){
    e.preventDefault();

    let hasError = false;

     //trim() para eliminar espacios en blanco al inicio y al final
     const codigo = $('#codigo').val().trim();
     const nombre_bodega = $('#nombre_bodega').val().trim();
     const direccion_bodega = $('#direccion_bodega').val().trim();
     const dotacion = $('#dotacion').val().trim();
     const encargados = $('#encargado_id').val();


     if(codigo === ''|| nombre_bodega === '' || dotacion === '' || direccion_bodega === ''){
        alert('Todos los campos son obligatorios.');
        hasError = true;
     }else if (codigo.length < 2 || codigo.length  >5){
         alert('El código debe tener 5 caracteres como máximo y dos como minimo.');
        hasError = true;
     }   else if (parseInt(dotacion) <= 0){
        alert('La dotación debe ser mayor a 0.');
        hasError = true;
    } 
     if (hasError) return; // si hay error se detiene

     $.ajax({
        url:'verCodigoBodega.php',
        method:'POST',
        data:{codigo: $('#codigo').val()},
        dataType: 'html',
        success: function (response){
           $('#resultado').html(response);
             if (response.includes('existe')) {
                alert('El código de la bodega ya existe. Por favor, elija otro código.');
            }else {
                $.ajax({
                    url: 'insertarBodega.php',
                    method: 'POST',
                    data:$('#formBodega').serialize(),
                    dataType: 'json',
                    success: function (response) {
                    $('#resultado').html(response);
                    $('#formBodega')[0].reset();
                    alert('Bodega creada correctamente');
                    window.location.href = "http://localhost:8000/index.php";
                    },
                    error: function (xhr, status, error) {
                        console.log('Error AJAX:', error);
                        $('#resultado').html('<span style="color:red">Error en la petición AJAX</span>');
                    }
                });
            }
        },
          error: function () {
            alert('Error al verificar el código de la boega.');
        }
     })

})