<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../css/cssForm.css" rel="stylesheet" />
        <link href="../css/cssTabla.css" rel="stylesheet" />
        <?php
            $r = $_REQUEST['rut'];
            require('../clases/Conexion.php');
            require('../clases/Cliente.php');
                
            $select = "select * from cliente where rut = '$r'";
            
            $c = new Conexion();
            $c->conectar55();
            
            $q = $c->query55($select);
            
            $existe = false;
            if($r = mysqli_fetch_array($q, MYSQLI_ASSOC)){
                $existe = true;
                list($rut, $nombre, $mail, $telefono) = 
                        array($r["rut"], $r["nombre"], $r["mail"], $r["telefono"]);
            }
            
            $cliente = new Cliente();
            $cliente->rut = $rut;
            $cliente->nombre = $nombre;
            $cliente->mail = $mail;
            $cliente->fono = $telefono;
            
            
            
            
            $c->close55();
            
            if(!$existe){
                header("location: index.php?m=1");
            }
        ?>
    </head>
    <body>
        <div id='contenedor'>
            <?php
                include '../template/header.html';
            ?>
            <div id='voucher'>
                <h1 id='tituloVoucher'>Resumen reserva</h1>
                <h2>Cliente</h2>
                <?php
                    echo $nombre;
                    echo "<br/>$mail";
                    echo "<br/>$telefono<hr>";
                ?>
                <h2 >Reserva</h2>
                <?php
                    $total = 0;
                    if(isset($_REQUEST['reservar'])){
                        foreach($_REQUEST['reservar'] as $r){
                            //el explode es como el split
                            list($idHora, $hora, $fecha, $valor, $idCancha, $fbonita) = explode(',', $r);

                            
                            echo "<b>Fecha:</b> $fbonita";
                            echo "<br/><b>Hora:</b> $hora";
                            echo "<br/><b>Valor: $$valor</b>";
                            echo "<br/><hr>";

                            $total += $valor;
                        }
                    }

                    echo "<div id='totalPagar'>Total a pagar: $$total</div><hr>";


                ?>
                
                
                <form action="pagoOk.php" method="post">
                    <?php
                        if(isset($_REQUEST['reservar'])){
                            session_start();
                            $_SESSION['reservar'] = $_REQUEST['reservar'];
                            $_SESSION["cliente"] = $cliente;
                        }
                    ?>
                    <input id='btnPagar' class='btn' type="submit" value="Confirmar Reserva"/>
                </form>
                </div>
                
                <div id='footVoucher'>
                 <a class='btn' href='menu.php'>Cancelar</a>
                </div>
           
        <?php
        include '../template/footer.html';
        ?>
        </div>
    </body>
</html>
