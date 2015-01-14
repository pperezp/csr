<?php
    require '../clases/Conexion.php';
    echo "<meta charset='utf-8'/>";
    $c = new Conexion();
    $c->conectar55();
    
    $rut = $_REQUEST["rut"] . "-" . $_REQUEST["digito"];
    $nombre = $_REQUEST["nombre"];
    $email = $_REQUEST["email"];
    $telefono = $_REQUEST["telefono"];
    
//    echo $rut;echo "<br>";
//    echo $nombre;echo "<br>";
//    echo $email;echo "<br>";
//    echo $telefono;
    
    $insert = "insert into cliente values('$rut','$nombre','$email','$telefono');";
    
    if($c->query55($insert)){
        header("location: index.php?m=1");
    }else{
        header("location: index.php?m=2");
    }
?>