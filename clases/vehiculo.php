<?php
 /*atributos privados: patente, hora ingreso. constructor que recibe los dos parametros, metodo estacionar que devuelve true o false, get patente devuelve la patente, sacar que recibe patente y devuelve importe, traer todos que trae el listado de vehiculos estacionados, guardar todos (recibe el listado de vehiculos), retorna true o false*/
class vehiculo{
	private $patente;
	private $horaIngreso;

	function __construct($patente, $horaIngreso){
		$this->patente=$patente;
		$this->horaIngreso=$horaIngreso;
	}

	function estacionar(){
		$archivo=fopen("archivos/estacionados.txt", "a");//escribe y mantiene la informacion existente		
		$ahora=date("Y-m-d H:i:s"); 
		$patente=$this->getPatente();
		console_log($patente);
		$renglon=$patente."=>".$ahora."\n";
		fwrite($archivo, $renglon); 		 
		fclose($archivo);	
		return true;
		/*else
			return false;*/
	}

	function console_log( $auto ) {
 		$output  = "<script>console.log( 'PHP debugger: ";
  		$output .= json_encode(print_r($auto, true));
  		$output .= "' );</script>";
  		echo $output;
	}

	function getPatente(){
		return $this->patente;

	}

	function sacar($patente){
		$listado=vehiculo::traerTodos();
		$ListadoAdentro=array();
		$estaElVehiculo=false;
		foreach ($listado as $auto) 
		{
			if($auto[0]==$patente)
			{
				$estaElVehiculo=true;
				$inicio=$auto[1];	
				$ahora=date("Y-m-d H:i:s"); 			 
 				$diferencia = strtotime($ahora)- strtotime($inicio) ;
 				//http://www.w3schools.com/php/func_date_strtotime.asp
 				$importe=$diferencia*15;
				$mensaje= "tiempo transcurrido:".$diferencia." segundos <br> costo $importe ";
				
				$archivo=fopen("archivos/facturacion.txt", "a"); 		  
		 		$dato=$patente ."=> $".$importe."\n" ;
		 		fwrite($archivo, $dato);
		 		fclose($archivo);


			}
			else
			{
				$ListadoAdentro[]=$auto;				
			}
		}// fin del foreach

		if(!$estaElVehiculo)
		{
			$mensaje= "no esta esa patente!!!";
		}


		vehiculo::guardarTodos($ListadoAdentro);


		echo $mensaje;
		return $importe;
	}

	function traerTodos(){
		$ListaDeAutosLeida=array();
		$archivo=fopen("archivos/estacionados.txt", "r");//escribe y mantiene la informacion existente

			
		while(!feof($archivo))
		{
			$renglon=fgets($archivo);
			//http://www.w3schools.com/php/func_filesystem_fgets.asp
			$auto=explode("=>", $renglon);
			//http://www.w3schools.com/php/func_string_explode.asp
			$auto[0]=trim($auto[0]);
			if($auto[0]!="")
				$ListaDeAutosLeida[]=$auto;
		}

		fclose($archivo);
		return $ListaDeAutosLeida;
	}

	function guardarTodos($listado){
		
		$archivo=fopen("archivos/estacionados.txt", "w"); 	

		foreach ($listado as $auto) 
		{
	 		  if($auto[0]!=""){
	 		  		$dato=$auto[0] ."=>".$auto[1]."\n" ;
					fwrite($archivo, $dato);
	 		  }	 	
	 		  return true;
		}
		fclose($archivo);

		return false;
	}

}
?>