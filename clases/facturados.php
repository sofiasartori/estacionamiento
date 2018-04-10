<?php

/*atributos privados: vehiculo, hora salida, importe. constructor que recibe un vehiculo y una hora de salida, un metodo traertodos que devuelve los facturados y guardarTodos retorna true y recibe un listado de facturados*/

class facturados{

	private $vehiculo;
	private $horaSalida;
	private $importe;

	function __construct($vehiculo, $horaSalida){
		$this->vehiculo=$vehiculo;
		$this->horaSalida=$horaSalida;
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

	function guardarTodos ($facturados){
		$archivo=fopen("archivos/estacionados.txt", "w"); 	

		foreach ($facturados as $auto) 
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