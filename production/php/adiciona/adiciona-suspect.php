<?php include "../bancos/conecta.php";?>
<?php include ("../bancos/banco-market.php");?>
<?php include ("../bancos/banco-suspect.php");?>


<?php
$id = $_POST["id"];
$contato = $_POST["contato"];
$data = $_POST["data"];
$status = $_POST["status"];
$hora = $_POST["hora"];
$id_consultor = $_POST["consultor"];
$comentario = $_POST["comentario"];
$tel = $_POST["tel"];
$email = $_POST["email"];
$data = date("d.m.y");
$today = date("d.m.y");

$query = "insert into suspects (id_clientes, contato, data, status, hora, comentario, id_consultor, tel, email) values ('$id','{$contato}' ,'{$data}' ,'{$status}' ,'{$hora}' ,'{$comentario}', {$id_consultor} , '{$tel}', '{$email}')";

if(mysqli_query($conexao, $query)){
	$suspect = buscaSuspect($conexao, $id, $contato, $data, $tel, $email);
	$query = "insert into consultores_suspect (id_consultor, id_suspect, data) values ({$id_consultor}, {$suspect['id_suspect']},'{$today}')";
	mysqli_query($conexao, $query);
    mysqli_close($conexao);
    header("Location: ../empresas/suspects.php");
}else{
    echo "nao foi adicionado";
}
?>

