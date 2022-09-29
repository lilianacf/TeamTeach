<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");

//CONSULTA PARA TRAER LA INFORMACION DE LA MASCOTA SELECCIONADA
$sql = "SELECT * FROM mascotas_clientes,usuarios, tipo_mascotas WHERE mascotas_clientes.id_usuario = usuarios.id_usuario and mascotas_clientes.id_masc=tipo_mascotas.id_masc and mascotas_clientes.cod_masc='" . $_GET['id'] . "'";
$query = mysqli_query($mysqli, $sql);
$result = mysqli_fetch_assoc($query);

//CONSULTA TABLA TIPO USUARIO PROPIETARIO
$sql_tusu = "Select * from usuarios where tipo_usuario=3";
$query_tusu = mysqli_query($mysqli, $sql_tusu);
$fila = mysqli_fetch_assoc($query_tusu);

//CONSULTA TIPO MASCOTA
$sql_est = "SELECT * from tipo_mascotas WHERE ID_MASC > 2 ";
$query_est = mysqli_query($mysqli, $sql_est);
$fila_est = mysqli_fetch_assoc($query_est);

?>
<?php
if (isset($_POST["update"])) {                  
    $codi_masc = $_POST["cod"];
    $nomb_masc = $_POST["nom"];
    $id_usua = $_POST["usu"];
    $color = $_POST["col"];
    $tip_masc = $_POST["tmasc"];
    $raza = $_POST["raz"];


    $sql_update = "UPDATE mascotas_clientes SET cod_masc= '$codi_masc', nom_masc ='$nomb_masc',color = '$color',raza = '$raza' WHERE cod_masc= '" . $_GET['id'] . "'";
    $cs = mysqli_query($mysqli, $sql_update);
    echo '<script>alert (" Actualización Exitosa ");</script>';
} elseif (isset($_POST["delete"])) {
    $sql_delete = "DELETE FROM mascotas_clientes WHERE cod_masc = '" . $_GET['id'] . "'";
    $cs = mysqli_query($mysqli, $sql_delete);
    echo '<script>alert (" Registro Eliminado Exitosamente ");</script>';
}

?>



<!DOCTYPE html>
<html lang="en">
<script>
    function centrar() {
        iz = (screen.width - document.body.clientWidth) / 2;
        de = (screen.height - document.body.clientHeight) / 2;
        moveTo(iz, de);
    }
</script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body onload="centrar();">
    <table border="1" class="center">
        <form name="frm_consulta" method="POST" autocomplete="off">
            <tr>
                <td>Codigo</td>
                <td><input readonly name="cod" type="text" value="<?php echo $result['cod_masc']  ?>"></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input name="nom" type="text" value="<?php echo $result['nom_masc']  ?>"></td>
            </tr>
            <tr>
                <td>Propietario</td>
                <td><input readonly name="usu" type="text" value="<?php echo $fila['nombres'] ?>"></td>
                
            <tr>
                <td>Color</td>
                <td><input name="col" type="text" value="<?php echo $result['color']  ?>"></td>
            </tr>
            <tr>
                <td>Raza</td>
                <td><input name="raz" type="text" value="<?php echo $result['raza']  ?>"></td>
            </tr>
            <tr>
                <td>Tipo mascota</td>
                <td><input readonly name="tmasc" type="text" value="<?php echo $result['tip_masc']?>"></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <td><input type="submit" name="update" value="Update"></td>


            <td><input type="submit" name="delete" value="Delete"></td>


            </tr>
        </form>
    </table>
</body>

</html>