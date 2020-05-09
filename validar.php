<?php

include "config/conection.php";

if (isset($_POST['btn_gister'])) {

    $usuario = mysqli_real_escape_string($conn, $_POST['user']);
    $contrasena = mysqli_real_escape_string($conn, $_POST['password']);
    $modulo= mysqli_real_escape_string($conn,$_POST['module']);
  
    $sql = "SELECT * FROM usuario WHERE usuario='" . $usuario . "'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if (isset($row)) {

        if ($row['contrasena'] == $contrasena) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['usuario'] = $usuario;
            $_SESSION['start'] = time();
            $_SESSION['expira'] = $_SESSION['start'] + (1 * 60);
            $_SESSION["ultimoAcceso"] = date("Y-n-j H:i:s");
            mysqli_close($conn);
            header("Location: menu.php");
        } else {
            echo "usuario o password equivocado";
            session_start();
            $_SESSION = array();
            session_destroy();
        }
    } else {
        echo "usuario no existe";
    }
}
