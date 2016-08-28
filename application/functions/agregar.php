<?php
    require 'connection.php';

    extract($_POST);
    
    $sql = "INSERT INTO contacto VALUES (NULL, '$nombre', '$apellido')";

    if(!$db->query($sql)){
        die('Ocurrio un error ejecutando el query ['.$db->error.']');        
    }else{
        header('Content-Type: application/json');
        echo json_encode(array('exito'=>true, 'idContacto'=>$db->insert_id, 'nombre'=>$nombre, 'apellido'=>$apellido));
    }
    
    $db->close();
?>