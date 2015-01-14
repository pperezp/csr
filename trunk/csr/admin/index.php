<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head runat="server">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Iniciar Sesión</title>
        <link href="../css/cssForm.css" rel="stylesheet" />
<!--        <script src="../js/validarRut.js">

        </script>-->
    </head>
    <body>
        <div id='contenedor'>
            <?php
            include("../template/header.html");
            ?>
            <div id='center'>
                <form name="form" method="post" class="contact_form" action="validar.php" id="contact_form">
                    <div>
                        <ul>
                            <li>
                                <h2>Iniciar Sesión</h2>
                            </li>

                            <li>
                                <label for="rut">Rut:</label>
                                <input id="rut" type="text" name="rut" placeholder="11222333-4" required/>
                                
                            </li>
                            <li>
                                <label for="pass">Contraseña: </label>
                                <input id='pass' type="password" name="pass" placeholder="Su contraseña acá" required />
                            </li>
                            
                            <li>
                                <button class="submit" type="submit" name='btnIniciar'>Iniciar</button>
                                <span>
                                    <?php
                                    if (isset($_GET['m'])) {
                                        switch ($_GET['m']) {
                                            case 1: {
                                                /* OK */
                                                echo "Error al iniciar sesión. Verifique sus datos.";
                                                break;
                                            }
                                        }
                                    }
                                    ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </form>

            </div>
            <?php
            include '../template/footer.html';
            ?>
        </div>
    </body>
</html>