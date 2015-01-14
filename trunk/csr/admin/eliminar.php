<?php
    if(!$_REQUEST['id']){
        header("location: menu.php");
    }else{
        require("../clases/Conexion.php");
        $idReserva = $_REQUEST['id'];
        $update = "update reserva set fallo = true where id = '$idReserva'";
        
        $c = new Conexion();
        $c->conectar55();
        
        $c->query55($update);
        $c->close55();
        header("location: menu.php");
    }
?>