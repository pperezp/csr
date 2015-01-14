<?php
    require('../clases/Conexion.php');
    require('../clases/Cliente.php');
    /*fecha_reserva date,Fecha que quiere la cancha
	hora int,
	cancha int,
	cliente varchar(12),
	fecha_pedido datetime,Fecha actual que realizo el pedido
	fallo boolean,*/
    
    $c = new Conexion();
    $c->conectar55();
    $c2 = new Conexion();
    $c2->conectar55();
    
    $diaActual = new DateTime();
    $diaActual->setTimezone(new DateTimeZone("Chile/Continental"));
    
    $fechaActual = $diaActual->format('Y-m-d H:i:s');
    
    session_start();
    
    if(isset($_SESSION['cliente'])){
        $res = $_SESSION['reservar'];
        $cliente = $_SESSION['cliente'];

        $rut = $cliente->rut;

        $select = "select id, fecha_pedido from reserva order by id desc limit 1;";
        $idReserva = "";
        foreach($res as $r){
            //el explode es como el split
            list($idHora, $hora, $fecha, $valor, $idCancha) = explode(',', $r);

            $insert = "insert into reserva "
                    . "values(null, '$fecha','$idHora','$idCancha','$rut','$fechaActual',false);";

    //        echo $insert;



            $c->query55($insert);
    //        header("location: index.php");
            $q = $c2->query55($select);

            if($r2 = mysqli_fetch_array($q, MYSQLI_ASSOC)){
                $idReserva = $idReserva ."c".$r2['id'] ;
                $fechaPedido = $r2['fecha_pedido'];
            }
        }

        $c->close55();
        $c2->close55();
    }else{
        header("location: index.php");
    }
    
    session_destroy();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/cssForm.css" rel="stylesheet" />
        <link href="../css/cssTabla.css" rel="stylesheet" />
    </head>
    <body>
        <div id='contenedor'>
        <?php
            include '../template/header.html';
        ?>
        <div id='voucher'>
                <h1 id='tituloVoucher'>Recibo de Pago</h1>
                <h2>Datos de reserva</h2>
                <?php
                    echo "Código: $idReserva";
                    echo "<br/>Fecha: $fechaPedido";
                ?>
                <h2>Cliente</h2>
                <?php
                    echo $cliente->nombre;
//                    echo "<br/>$cliente->mail";
//                    echo "<br/>$cliente->fono<hr>";
                ?>
                <h2 >Reserva</h2>
                <?php
                    $total = 0;
                    foreach($res as $r){
                        //el explode es como el split
                        list($idHora, $hora, $fecha, $valor, $idCancha, $fbonita) = explode(',', $r);


                        echo "<b>Fecha:</b> $fbonita";
                        echo "<br/><b>Hora:</b> $hora";
                        echo "<br/><b>Valor: $$valor</b>";
                        echo "<br/><hr>";

                        $total += $valor;
                    }
                    

                    echo "<div id='totalPagar'>Total pagado: $$total</div><hr>";


                ?>
                
                </div>
        <?php
        include '../template/footer.html';
        ?>
        </div>
    </body>
</html>