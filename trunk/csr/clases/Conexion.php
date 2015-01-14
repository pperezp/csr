<?php

define("BD", "csr");
define("HOST", "localhost");
define("PASS", "123456");
define("USER", "root");
define("MANDAR_MAIL", "false"); //poner true si quiere mandar mail

class Conexion {

    var $con;
    var $bd;

    function conectar54() {
        $this->con = mysql_connect(HOST, USER, PASS);
        $this->bd = mysql_select_db(BD, $this->con);
    }
    
    function conectar55() {
        $this->con = new mysqli(HOST, USER, PASS, BD);
    }


    function close54() {
        mysql_close($this->con);
    }
    
    function close55() {
        mysqli_close($this->con);
    }

    function query54($query) {
        return mysql_query($query, $this->con);
    }

    function query55($query) {
        return $this->con->query($query);
        
        /*
        while ($res = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		print "<p>$res[nombre]</p>";
	} */
    }
}

?>