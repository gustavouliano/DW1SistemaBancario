<?php
header('Content-Type: text/html; charset=UTF-8');
include 'connect/connect.php';
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";

$acao = '';
if (isset($_GET["acao"]))
    $acao = $_GET["acao"];

if ($acao == "excluir") {
    $id = 0;
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        excluir($id);
    }
} else {
    if (isset($_POST["acao"])) {
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
        }
    }
}

function excluir($id)
{
    $sql = "DELETE FROM operacao WHERE id = $id;";
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    if ($result == 1)
        header('location:operacaoLista.php');
    else
        header('location:operacaoLista.php');
}

function alterar($id)
{
    $vet = carregarTelaParaVetor();
    $sql = 'UPDATE ' . $GLOBALS['tb_operacao'] .
        ' SET data = "' . $vet['data'] . '"' .
        ', conta_id = ' . $vet['conta'] .
        ', tipo_id = ' . $vet['tipo'] .
        ', valor = ' . $vet['valor'] .
        ', observacao = "' . $vet['observacao'] . '"' .
        ' WHERE id = ' . $id;

    /*$sql = "UPDATE operacao SET valor = ". $vet['valor'] . 
    ", data = ". $vet['data'] . ", observacao = ". $vet['operacao'] . 
    ", conta_id = " . $vet['conta'] . ", tipo_id = " . $vet['tipo'] . " WHERE id = $id;";*/
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    if ($result == 1)
        header('location:cadOperacao.php?msg="sa"&acao=editar&id=' . $id);
    else
        header('location:cadOperacao.php?msg="er"&acao=editar&id=' . $id);
}

function inserir()
{

    $vet = carregarTelaParaVetor();

    #Verificar se é depósito ou saque
    $sqlDepositoOuSaque = 'SELECT * FROM ' . $GLOBALS['tb_tipo'] . ' WHERE id = ' . $vet['tipo'];
    $resultDepositoOuSaque = mysqli_query($GLOBALS['conexao'], $sqlDepositoOuSaque);
    while ($row = mysqli_fetch_array($resultDepositoOuSaque)) {
        if ($row['descricao'] == "Saque") {
            $sqlConta = 'SELECT * FROM ' . $GLOBALS['tb_conta'] . ' WHERE id = ' . $vet['conta'];
            $resultConta = mysqli_query($GLOBALS['conexao'], $sqlConta);
            while ($rowConta = mysqli_fetch_array($resultConta)) {
                if ($vet['valor'] <= $rowConta['saldo']) {
                    $novoSaldo = $rowConta['saldo'] - $vet['valor'];
                    $sqlNovoSaldo = 'UPDATE ' . $GLOBALS['tb_conta'] . ' SET saldo = ' . $novoSaldo . ' WHERE id = ' . $vet['conta'];
                    mysqli_query($GLOBALS['conexao'], $sqlNovoSaldo);
                    $sql = 'INSERT INTO ' . $GLOBALS['tb_operacao'] .
                        ' (valor, data, observacao, conta_id, tipo_id)' .
                        ' VALUES (' . $vet['valor'] . ',"' . $vet['data'] .
                        '","' . $vet['observacao'] . '",' . $vet['conta'] . ', ' . $vet['tipo'] . ')';
                    $result = mysqli_query($GLOBALS['conexao'], $sql);
                    $id = mysqli_insert_id($GLOBALS['conexao']);

                    if ($result == 1)
                        header('location:cadOperacao.php?msg="si"&acao=editar&id=' . $id);
                    else
                        header('location:cadOperacao.php?msg="er"&acao=editar&id=' . $id);
                } else {
                    header('location:cadOperacao.php');
                }
            }
        } else {
            $sqlConta = 'SELECT * FROM ' . $GLOBALS['tb_conta'] . ' WHERE id = ' . $vet['conta'];
            $resultConta = mysqli_query($GLOBALS['conexao'], $sqlConta);
            $saltoAtual = 0;
            while ($rowConta = mysqli_fetch_array($resultConta)) {
                $saldoAtual = $rowConta['saldo'];
            }
            $novoSaldo = $saldoAtual + $vet['valor'];
            $sqlNovoSaldo = 'UPDATE ' . $GLOBALS['tb_conta'] . ' SET saldo = ' . $novoSaldo . ' WHERE id = ' . $vet['conta'];
            mysqli_query($GLOBALS['conexao'], $sqlNovoSaldo);

            $sql = 'INSERT INTO ' . $GLOBALS['tb_operacao'] .
                ' (valor, data, observacao, conta_id, tipo_id)' .
                ' VALUES (' . $vet['valor'] . ',"' . $vet['data'] .
                '","' . $vet['observacao'] . '",' . $vet['conta'] . ', ' . $vet['tipo'] . ')';
            $result = mysqli_query($GLOBALS['conexao'], $sql);
            $id = mysqli_insert_id($GLOBALS['conexao']);

            if ($result == 1)
                header('location:cadOperacao.php?msg="si"&acao=editar&id=' . $id);
            else
                header('location:cadOperacao.php?msg="er"&acao=editar&id=' . $id);
        }
    }

    /*$sql = 'SELECT * FROM ' . $GLOBALS['tb_conta'] . ' WHERE id = ' . $vet['conta'];
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    while ($row = mysqli_fetch_array($result)) {
        if ($vet['valor'] <= $row['saldo']) {
            $novoSaldo = $row['saldo'] - $vet['valor'];
            $sql = 'UPDATE ' . $GLOBALS['tb_conta'] . ' SET saldo = ' . $novoSaldo . ' WHERE id = ' . $vet['conta'];
            mysqli_query($GLOBALS['conexao'], $sql);
        } else {
            echo "Não foi";
            #header('location:cadOperacao.php?msg="er"&acao=editar&id=' . $id);
        }
    }
*/


    /*$sql = 'INSERT INTO ' . $GLOBALS['tb_operacao'] .
        ' (valor, data, observacao, conta_id, tipo_id)' .
        ' VALUES (' . $vet['valor'] . ',"' . $vet['data'] .
        '","' . $vet['observacao'] . '",' . $vet['conta'] . ', ' . $vet['tipo'] . ')';
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    $id = mysqli_insert_id($GLOBALS['conexao']);
    
    if ($result == 1)
        header('location:cadOperacao.php?msg="si"&acao=editar&id=' . $id);
    else
        header('location:cadOperacao.php?msg="er"&acao=editar&id=' . $id);
        */



    //var_dump($dados);
    /*$pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('INSERT INTO operacao (valor, data, observacao, conta_id, tipo_id) VALUES (:valor, :data, :observacao, :conta_id, :tipo_id)');
    $valor = $dados['valor'];
    $data = $dados['data'];
    $observacao = $dados['observacao'];
    $conta_id = $dados['conta'];
    $tipo_id = $dados['tipo'];
    $stmt->bindParam(':valor', $valor, PDO::PARAM_INT);
    $stmt->bindParam(':data', $data, PDO::PARAM_STR);
    $stmt->bindParam(':observacao', $observacao, PDO::PARAM_STR);
    $stmt->bindParam(':conta_id', $conta_id, PDO::PARAM_INT);
    $stmt->bindParam(':tipo_id', $tipo_id, PDO::PARAM_INT);
    $stmt->execute();

    header("location:cadOperacao.php");*/
}

function carregarTelaParaVetor()
{
    $vet = array();
    $vet['id'] = $_POST["id"];
    $vet['valor'] = $_POST["valor"];
    $vet['data'] = $_POST["data"];
    $vet['observacao'] = $_POST["observacao"];
    $vet['conta'] = $_POST["conta"];
    $vet['tipo'] = $_POST["tipo"];
    return $vet;
}

function carregaBDParaVetor($id)
{
    $sql = "SELECT * FROM operacao WHERE id = $id;";
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    $dados = array();
    while ($row = mysqli_fetch_array($result)) {
        $dados['id'] = $row['id'];
        $dados['valor'] = $row['valor'];
        $dados['data'] = $row['data'];
        $dados['observacao'] = $row['observacao'];
        $dados['conta'] = $row['conta_id'];
        $dados['tipo'] = $row['tipo_id'];
    }
    return $dados;
}
