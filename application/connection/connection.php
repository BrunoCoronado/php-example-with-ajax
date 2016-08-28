<?php
    $db = new mysqli('localhost', 'root','','db_contactos');
    if($db->connect_errno > 0){
        die('Imposible conectar ['.$db->connect_error .']');
    }
?>