<?php
	header('Content-Type: text/html; charset=UTF-8');
	include 'conf/conf.incDiferente.php';	
	$conexao = mysqli_connect($url,$usuario,$password,$dbname);
	if (mysqli_connect_errno())
		echo mysqli_connect_error();
?>