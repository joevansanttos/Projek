<?php 
	require_once "../bancos/conecta.php";
	$id_lead = $_POST["id"];
	$nome = $_POST["nome"];
	$email = $_POST["email"];
	$tel = $_POST["tel"];
	$cargo = $_POST["cargo"];
	$today = date("d.m.y");
 	$query = "update  leads  set nome ='{$nome}', email = '{$email}', tel ='{$tel}', cargo = '{$cargo}' where id_lead = {$id_lead}";
	if(mysqli_query($conexao, $query)){   
  	mysqli_close($conexao);
  	header("Location: ../empresas/leads.php");  
	}else{
    echo "nao foi adicionado";
	}
?>