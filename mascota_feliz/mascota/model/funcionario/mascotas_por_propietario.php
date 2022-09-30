<?php
    session_start();
    require_once("../../db/connection.php");
    include("../../controller/validarSesion.php");
    $sql = "SELECT * FROM mascotas_clientes WHERE id_usuario = '".$_GET['id']."'";
    $petsQuery = mysqli_query($mysqli, $sql);
    $pets = mysqli_fetch_all($petsQuery);
    print_r(json_encode($pets));
?>
