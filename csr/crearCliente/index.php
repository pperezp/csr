<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head runat="server">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de clientes</title>
        <link href="../css/cssForm.css" rel="stylesheet" />
        <script src="../js/validarRut.js">

        </script>
    </head>
    <body>
        <div id='contenedor'>
            <?php
            include("../template/header.html");
            ?>
            <div id='center'>
                <form name="form" method="post" onsubmit="return validarRut(rut.value, digito.value)" class="contact_form" action="crearCliente.php" id="contact_form">
                    <div>
                        <ul>
                            <li>
                                <h2>Registro de clientes</h2>
                                <span class="required_notification">* Datos requeridos</span>
                            </li>

                            <li>
                                <label for="rut">Rut:</label>
                                <input id="rut" type="text" name="rut" placeholder="11222333" required/>
                                - <input id="digito" type="text" name="digito" placeholder="k" required/>
        <!--                        <span id="menRut">asd</span>-->
                            </li>
                            <li>
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" placeholder="Su nombre acá" required />
                            </li>
                            <li>
                                <label for="email">Email:</label>
                                <input type="email" name="email" placeholder="email@mail.com" required />
                                <span class="form_hint">Formato correcto: "nombre@algo.com"</span>
                            </li>
                            <li>
                                <label for="telefono">Telefono:</label>
                                <input type="number" name="telefono" placeholder="Su telefono acá" required pattern="(http|https)://.+" />

                            </li>

                            <li>
                                <button class="submit" type="submit">Registrarse</button>
                                <span>
                                    <?php
                                    if (isset($_GET['m'])) {
                                        switch ($_GET['m']) {
                                            case 1: {
                                                    /* OK */
                                                    echo "Cliente registrado. <a href='../reservar/index.php'>Reservar Cancha</a>";
                                                    break;
                                                }
                                            case 2: {
                                                    /* El usuario ya esta en la base de datos */
                                                    echo "El usuario ya esta registrado. <a href='../reservar/'>Reservar Cancha</a>";
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