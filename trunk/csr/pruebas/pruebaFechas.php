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
        <title></title>
    </head>
    <body>
        <?php
        
//            $dias = array("Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
//        
//            $d = new DateTime();
//            $d->setTimezone(new DateTimeZone("Chile/Continental"));
//            
//            //Fecha actual
//            echo "Fecha Actual: ". $d->format( 'Y-m-d H:i:s' );
            
//            //agregar 7 dias
//            echo "<br/>";
//            $d->add(new DateInterval("P7D"));
//            echo "+7 días: ".$d->format( 'Y-m-d H:i:s' );
//            
//            echo "<br/>";
//            //restar 7 dias
//            $d->sub(new DateInterval("P7D"));
//            echo "7 dias atrás: ". $d->format( 'l Y-m-d H:i:s' );
            
//            $diaDeLaSemana =$d->format("N");
//            echo "<br/>Dia de la semana: ".$diaDeLaSemana;
//             echo "<br/>Dia de la semana palabras: ". $dias[$diaDeLaSemana-1];
            
             //recorrer un array
//            
//            foreach($dias as $d){
//                echo "<br/>$d";
//            }
            
             
        ?>
        
         
        <?php
            $diaActual = new DateTime();
            $diaActual->setTimezone(new DateTimeZone("Chile/Continental"));

            if(isset($_REQUEST['adelante']) || isset($_REQUEST['atras'])){
                echo "CDIAS: $cDias -- ";
                if($cDias > 0){
                   $diaActual->add(new DateInterval("P".$cDias."D"));
                    echo $diaActual->format('d-m-Y'); 
                }else{
                    $cDias = 0;
                }
            }
        ?>
        <table border='1'>
            <tr>
                <td colspan='4'>
                    <form action="pruebaFechas.php" method='post'>
                        <input type='submit' name='atras' value='Atras'/>
                        <input type='hidden' name='cDias' value='<?php echo $cDias - 7;?>'/>
                    </form>
                </td>
                <td colspan='3'>
                    <form action="pruebaFechas.php" method='post'>
                        <input type='submit' name='adelante' value='Adelante'/>
                        <input type='hidden' name='cDias' value='<?php echo $cDias + 7;?>'/>
                    </form> 
                </td>
            </tr>
            <tr>
                <?php
                    $dias = array("Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
                    foreach($dias as $x){
                        echo "<td>$x</td>";
                    }
                ?>
            </tr>
            
            <?php
                $diaDeLaSemana = $diaActual->format("N");
                
                $c = $diaDeLaSemana-1;
                echo "<tr>";
                
                $lunes = $diaActual->sub(new DateInterval("P".$c."D"));
                
                foreach($dias as $x){
                   
                    echo "<td>".$diaActual->format('d-m-Y')."</td>";
                    $lunes->add(new DateInterval("P1D"));
                }
                echo "</tr>";
            ?>
        </table>
    </body>
</html>
