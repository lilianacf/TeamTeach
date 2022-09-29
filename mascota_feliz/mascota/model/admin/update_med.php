<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");


//CONSULTA PARA TRAER LA INFORMACION DEL MEDICAMENTO  SELECCIONADO
$sql = "SELECT * FROM medicamentos WHERE id_med='$id_med' AND desc_med='$desc_med'". $_GET['id'] . "'";
$query = mysqli_query($mysqli, $sql);
$result = mysqli_fetch_assoc($query);


?>
<?php
if (isset($_POST["update"])) {                  
    $id_med = $_POST["id_med"];
    $desc_med = $_POST["desc_med"];


    $sql_update = "UPDATE medicamentos SET id_med= '$id_med', desc_med ='$desc_med' WHERE id_med= '" . $_GET['id'] . "'";
    $cs = mysqli_query($mysqli, $sql_update);
    echo '<script>alert (" Actualización Exitosa ");</script>';
} elseif (isset($_POST["delete"])) {
    $sql_delete = "DELETE FROM medicamentos WHERE id_med = '" . $_GET['id'] . "'";
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
                <td>Código Medicamento</td>
                <td><input readonly name="id_med" type="text" value="<?php echo $result['id_med']  ?>"></td>
            </tr>
            <tr>
                <td>Descripción</td>
                <td><input name="desc_med" type="text" value="<?php echo $result['desc_med']  ?>"></td>
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