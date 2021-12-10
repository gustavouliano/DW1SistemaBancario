<?php
	header('Content-Type: text/html; charset=UTF-8');
	date_default_timezone_set('America/Sao_Paulo');
	
	// Banco de Dados para configuração
	$url = "127.0.0.1";     // IP do host
	$dbname="sistemabancario";          // Nome do database
	$usuario="root";        // Usuário do database
	$password="";           // Senha do database
	
	// Tabelas do Banco de Dados
	$tb_operacao = "operacao";
	$tb_marca = "marca";
	$tb_cliente= "tb_cliente";
	$tb_conta = "conta";
	$tb_tipo = "tipo";
	$tb_conta_has_cliente = "conta_has_cliente";
?>