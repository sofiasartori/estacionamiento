<?php
require"clases/vehiculo.php";
require"clases/facturados.php";
require"clases/uitablas.php";

$patente=$_POST['patente'];
$accion=$_POST['estacionar'];
$auto= new vehiculo($patente);


function console_log( $auto ) {
  $output  = "<script>console.log( 'PHP debugger: ";
  $output .= json_encode(print_r($auto, true));
  $output .= "' );</script>";
  echo $output;
}

if($accion=="ingreso")
{
	$auto->estacionar();
}
else
{
	$auto->sacar($patente);

		//var_dump($datos);
}

header("location:index.php");
?>
