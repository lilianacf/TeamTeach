<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "mascota";
  
  $mysqli = new mysqli ($hostname, $username, $password, $database);

  if ($mysqli -> connect_errno)
  {
     die("fallo la conexion" . mysqli_connect_errno());
  }
  
?>