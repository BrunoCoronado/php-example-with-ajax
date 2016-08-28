<?php
    require '../connection/connection.php';
    
    $id = $_GET['idContacto'];

    $sql = "DELETE FROM contacto WHERE idContacto = '$id' ";

    if(!$db->query($sql)){
        die('Ocurrio un error ejecutando el query ['. $db->error . ']');
    }ele{
        header('Content-type: application/json');
        echo json_encode(array('exito'=>true));
    }
    
    $db->close();
?>