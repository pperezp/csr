<?php
    if(!$_REQUEST['rut']){
        header("location: index.php?m=1");
    }else{
        $rut = $_REQUEST['rut'];
        $pass = $_REQUEST['pass'];
        
        require("../clases/Conexion.php");
        
        $select = "select c.nombre ".
                    "from cliente c, usuario u ".
                    "where c.rut = u.rut and ".
                    "c.rut = '$rut' and u.pass = '$pass'";
        
        $c = new Conexion();
        
        $c->conectar55();
        
        $q = $c->query55($select);
        
        $existe = false;
        if ($res = mysqli_fetch_array($q, MYSQLI_ASSOC)) {
            $existe = true;
            
            session_start();
            $_SESSION["nombre"] = $res['nombre'];
	}
        
        $c->close55();
        
        if($existe){
            header("location: menu.php");
        }else{
            header("location: index.php?m=1");
        }
    }
?>