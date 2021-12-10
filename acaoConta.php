<?php
header('Content-Type: text/html; charset=UTF-8');
include 'connect/connect.php';

$acao = '';
if (isset($_GET["acao"]))
	$acao = $_GET["acao"];

if ($acao == "excluirCliente") {
	$conta = $_GET['conta'];
	$cliente = $_GET['cliente'];
	excluirCliente($conta, $cliente);
} else if ($acao == "excluir") {
	$id = 0;
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		excluir($id);
	}
} else if (isset($_POST["acao"])) {
	$acao = $_POST["acao"];
	if ($acao == "salvar") {
		$id = 0;
		if (isset($_POST["id"])) {
			$id = $_POST["id"];
			if ($id == 0)
				inserir();
			else
				alterar($id);
		}
	} else if ($acao == "addCliente") {
		$cliente = $_POST['cliente'];
		$id = $_POST['id'];
		adicionarCliente($id, $cliente);
	}
}

function excluirCliente($conta, $cliente)
{
	$sql = 'DELETE FROM ' . $GLOBALS['tb_conta_has_cliente'] .
		' WHERE ' . $GLOBALS['tb_conta_has_cliente'] . '.conta_id =  ' . $conta .
		' AND ' . $GLOBALS['tb_conta_has_cliente'] . '.cliente_id =  ' . $cliente;
	$result = mysqli_query($GLOBALS['conexao'], $sql);
	if ($result == 1)
		header('location:cadConta.php?msg="se"&acao=editar&id=' . $conta);
	else
		header('location:cadConta.php?msg="er"&acao=editar&id=' . $conta);
}

function adicionarCliente($id, $cliente)
{
	$sql = 'INSERT INTO ' . $GLOBALS['tb_conta_has_cliente'] .
		' (conta_id, cliente_id)' .
		' VALUES (' . $id . ',' . $cliente . ')';
	$result = mysqli_query($GLOBALS['conexao'], $sql);
	if ($result == 1)
		header('location:cadConta.php?msg="si"&acao=editar&id=' . $id);
	else
		header('location:cadConta.php?msg="er"&acao=editar&id=' . $id);
}

function excluir($id)
{
	$sql = "DELETE FROM conta_has_cliente WHERE conta_id = $id;";
	$result = mysqli_query($GLOBALS['conexao'], $sql);
	$sql = "DELETE FROM conta WHERE id = $id";
	$result = mysqli_query($GLOBALS['conexao'], $sql);
	if ($result == 1)
		header('location:contaLista.php');
	else
		header('location:contaLista.php');
}

function alterar($id)
{
	$vet = carregarTelaParaVetor();
	$sql = 'UPDATE ' . $GLOBALS['tb_conta'] .
		' SET saldo = ' . $vet['saldo'] .
		' WHERE id = ' . $id;
	$result = mysqli_query($GLOBALS['conexao'], $sql);
	if ($result == 1)
		header('location:cadConta.php?msg="sa"&acao=editar&id=' . $id);
	else
		header('location:cadConta.php?msg="er"&acao=editar&id=' . $id);
}

function inserir()
{
	$vet = carregarTelaParaVetor();
	$sql = 'INSERT INTO ' . $GLOBALS['tb_conta'] .
		' (saldo)' .
		' VALUES ("' . $vet['saldo'] . '")';
	$result = mysqli_query($GLOBALS['conexao'], $sql);
	$id = mysqli_insert_id($GLOBALS['conexao']);
	if ($result == 1)
		header('location:cadConta.php?msg="si"&acao=editar&id=' . $id);
	else
		header('location:cadConta.php?msg="er"&acao=editar&id=' . $id);
}

function carregarTelaParaVetor()
{
	include 'util/util.php';
	$vet = array();
	$vet['saldo'] = ($_POST["saldo"]);
	return $vet;
}

function carregaBDParaVetor($id)
{
	$sql = 'SELECT * FROM ' . $GLOBALS['tb_conta'] .
		' WHERE id = ' . $id;
	$result = mysqli_query($GLOBALS['conexao'], $sql);
	$dados = array();
	while ($row = mysqli_fetch_array($result)) {
		$dados['id'] = $row['id'];
		$dados['saldo'] = $row['saldo'];
	}
	return $dados;
}
