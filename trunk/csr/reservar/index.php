<!DOCTYPE html>
<?php
    if(!isset($_REQUEST['cDias'])){
        $cDias = 0;
    }else{
        $cDias =  $_REQUEST['cDias'];
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reservar de cancha</title>
        <link href="../css/cssForm.css" rel="stylesheet" />
        <link href="../css/cssTabla.css" rel="stylesheet" />
    </head>
    <body>
        <div id='contenedor'>
        <?php
            include("../template/header.html");
            require('../clases/Control.php');
        
            $diaActual = new DateTime();
            $diaActual->setTimezone(new DateTimeZone("Chile/Continental"));

            if(isset($_REQUEST['adelante']) || isset($_REQUEST['atras'])){
//                echo "CDIAS: $cDias -- ";
                if($cDias > 0){
                    //Validacion para que el usuario no pueda ver mas de dos meses
                    if($cDias > Control::$diasPermitidos){
                        $cDias -= 7;
                    }
                    $diaActual->add(new DateInterval("P".$cDias."D"));
//                    echo $diaActual->format('d-m-Y');
                }else{
                    $cDias = 0;
                }
//                 echo "<br/>CDIAS: $cDias -- ";
            }
        ?>
        <div id='cont2'>
        <table id='tabla' border="0">
            <tr>
                
                
                <td colspan='6' align='right'>
                    <form action="index.php" method='post'>
                        <input class='btn' type='submit' name='atras' value='<<<<< Semana atrás'/>
                        <input type='hidden' name='cDias' value='<?php echo $cDias - 7;?>'/>
                    </form>
                </td>
                <td colspan='4'>
                    <form action="index.php" method='post'>
                        <input class='btn' type='submit' name='adelante' value='Semana siguiente >>>>>'/>
                        <input type='hidden' name='cDias' value='<?php echo $cDias + 7;?>'/>
                    </form> 
                </td>
                
                
            </tr>
            
            <tr>
                <td class='horario' rowspan='2'>Precios</td>
                <td colspan='2' class='horario'>Horario</td>
                <?php
                    $dias = array("Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
                    foreach($dias as $x){
                        echo "<td class='diaSemana'>$x</td>";
                    }
                ?>
            </tr>
            <?php
                require('../clases/Conexion.php');

                //Conexion para el select de las horas
                $con = new Conexion();
                $con->conectar55();
                
                //conexion para los selects de las reservas
                $c2 = new Conexion();
                $c2->conectar55();
                
                $select = "select * from hora";
                
                $q = $con->query55($select);
                
                
                
                
                
                
                
                /*El tema de las semanas se ve aca*/
                $diaDeLaSemana = $diaActual->format("N");
                
                $c = $diaDeLaSemana-1;
                echo "<tr>";
                echo "<td class='horario'>Desde</td>";
                echo "<td class='horario'>Hasta</td>";
                
                $lunes = $diaActual->sub(new DateInterval("P".$c."D"));
                
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                
                foreach($dias as $x){
                    echo "<td class='fechaAbajoDia'>".$diaActual->format('d')." / ".$meses[$diaActual->format('m')-1]."</td>";
                    $lunes->add(new DateInterval("P1D"));
                }
                echo "</tr>";
                
                
                
                
                
                
//                echo "Dia actual: ".$diaActual->format('d-m-Y');
                
                 /*El tema de las semanas se ve aca*/
                
                
                
                
//                ciclo para las horas
                echo "<form action='reservarHora.php' method='post'>";
                
                //contador para poner el precio al lado
                $contPrecios = 0;
                $intercalado = 0;
                while ($res = mysqli_fetch_array($q, MYSQLI_ASSOC)) {
                    // aca dejo el dia actual com el lunes de esta semana
                    $diaActual->sub(new DateInterval("P7D"));
                    $idHora = $res['id'];
                    $hora = $res['descripcion'];
                    $valor = $res['valor'];
                    $idCancha = 1;
                    
                    if($intercalado % 2 == 0){
                        $claseIntercalado = "class='intercalado'";
                    }else{
                        $claseIntercalado = "";
                    }
                    
                    echo "<tr>";
                    
                        if($contPrecios == 0){
                            echo "<td class='horario' rowspan='4'>$$valor</td>";
                        }else if($contPrecios == 4){
                            echo "<td class='horario' rowspan='5'>$$valor</td>";
                        }else if($contPrecios == 9){
                            echo "<td class='horario' rowspan='5'>$$valor</td>";
                        }
                        
                        $contPrecios++;
                        
                        echo "<td ".$claseIntercalado." colspan='2' ><span class='hora'>$hora</span></td>";
                        
//                        $contDias = 0;
                        $cont = 1;
                        
//                        $lunes = $diaActual->sub(new DateInterval("P".$c."D"));
                        //ciclo para los dias de cada hora (de lunes a viernes)
                        while($cont <= 7){
                            
                            $fecha = $diaActual->format("Y-m-d");
                            $fbonita = $diaActual->format('d')." de ".$meses[$diaActual->format('m')-1] ." de ".$diaActual->format('Y');
                            $select = "select * from reserva
                                        where fecha_reserva = '".$fecha."' and
                                        hora = '$idHora' and fallo = false and
                                        cancha = '$idCancha';";
//                                echo "<td>$select</td>";

                            $q2 = $c2->query55($select);

                            if($r = mysqli_fetch_array($q2, MYSQLI_ASSOC)){
                                echo "<td ".$claseIntercalado." align='center'><span class='reservado'>Reservado</span></td>";
                            }else{
                                // disponible
                                echo "<td ".$claseIntercalado." align='center'>";
//                                        echo "<form method='post' action='reservarHora.php'>";
//                                            echo "<input type='submit' value='Reservar'>";
//                                            echo "<input name='idHora' type='hidden' value='$idHora'>";
//                                            echo "<input name='hora' type='hidden' value='$hora'>";
//                                            echo "<input name='fecha' type='hidden' value='$fecha'>";
//                                            echo "<input name='cancha' type='hidden' value='1'>";
//                                        echo "</form>";

                                    echo "<input name='reservar[]' type='checkbox' value='$idHora,$hora,$fecha,$valor,$idCancha,$fbonita'/>";
                                echo "</td>";

                            }
//
//                            $contDias++;
                            $cont++;
                             // aca dejo el dia actual +1, voy avanzando
                            $diaActual->add(new DateInterval("P1D"));
                        }
                        
                    echo "</tr>";
                    $intercalado++;
                }
                
                $con->close55();
            ?>
        </table>
        <?php
            echo "<input type='text' placeholder='Su rut aquí [16776321-2] para reservar' name='rut' id='rut'/>";
            echo "<input type='submit' value='Reservar' class='btn'/>";
            echo "<div>";
                if(isset($_GET['m'])){
                    switch($_GET['m']){
                        case 1:{
                            /*Rut no encontrado en la BD*/
                            echo "Cliente NO registrado. <a href='../crearCliente/'>Registrarse</a>";
                            break;
                        }
                    }
                }else{
                    echo "Si aún no se ha registrado, click <a href='../crearCliente/'>aquí</a>";
                }
            echo "</div>";
            echo "</form>";
        ?>
            </div><!-- cierre cont2-->
            <?php
                include '../template/footer.html';
            ?>
            </div> <!-- cierre contenedor-->
    </body>
</html>
