<?php
    include 'application/connection/connection.php';

    $sql = "SELECT * FROM contacto";
    
    if(!$resultado = $db->query($sql)){
        die('Ocurrio un error ejecutando el query ['. $db->error .']');
    }
    $db->close();
?>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"/>

<script src="https://code.jquery.com/jquery.js"/>
<script src="assets/js/bootstrap.min.js"/>

<script type="text/javascript"> 
    $( "#formulario" ).submit(function( event ){
        event.preventDefault();
        $.post('application/functions/agregar.php',
        $('#formulario').serialize(),
        function(data){
            if (data.exito != true){
                alert('error');
            }else{
                $('#tabla tr:last').after(
                    '<tr id="fila_'+data.idContacto+'">'+
                        '<td>'+data.nombre+'</td>'+
                        '<td>'+data.apellido+'</td>'+
                        '<td><button onclick="eliminar('+data.idContacto+')">Eliminar</button></td>'+
                    '<tr>'
                );
            }
        });
    });

    function eliminar(idContacto){
        $.get('application/functions/eliminar.php?idContacto='+idContacto,
        function(data){
           if(data.exito != true){
               alert('error');
           }else{
               $('#fila_'+idContacto).remove();
           }
        });
    }
</script>

<div class="container">
    <div class="jumbotron">
        <h1>Lista de contactos</h1>
    </div>
    <table class="table" id="tabla">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($fila = $resultado->fetch_assoc()){     
                    echo'<tr id"fila_'.$fila['idContacto'].'">
                        <td>'.$fila['nombre'].'</td>
                        <td>'.$fila['apellido'].'</td>
                        <td><button onclick="eliminar('.$fila['idContacto'].')">Eliminar</button></td>
                    </tr>';
                }
            ?>
        </tbody>
    </table>
    <form id="formulario">
        <input id="nombre" type="text" name="nombre">
        <input id="apellido" type="text" name="apellido">
        <input type="submit" value="Agregar">
    </form>
</div>


