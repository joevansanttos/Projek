<?php

	function buscaSociosContrato($conexao, $id_contrato){
	  $clientes = array();
	    $query = "select  * from socios where id_contrato = {$id_contrato}";
	    $resultado = mysqli_query($conexao, $query);
	    while ($cliente= mysqli_fetch_assoc($resultado)) {
	      array_push($clientes, $cliente);
	    }
	    
	    return $clientes;
	}