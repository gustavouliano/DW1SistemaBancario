<?php

include_once "conf/default.inc.php";
require_once "conf/Conexao.php";

// Se foi enviado via GET para acaoTipo entra aqui
$acaoTipo = isset($_GET['acaoTipo']) ? $_GET['acaoTipo'] : "";
if ($acaoTipo == "excluir") {
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    excluir($id);
}

// Se foi enviado via POST para acaoTipo entra aqui
$acaoTipo = isset($_POST['acaoTipo']) ? $_POST['acaoTipo'] : "";
if ($acaoTipo == "salvar") {
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    if ($id == 0)
        inserir($id);
    else
        editar($id);
}

// Métodos para cada operação
function inserir($id)
{
    $dados = dadosForm();
    //var_dump($dados);

    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('INSERT INTO tipo (descricao) VALUES (:descricao);');
    $descricao = $dados['descricao'];
    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);

    $stmt->execute();

    header("location:cadTipo.php");
}

function editar($id)
{
    $dados = dadosForm();
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('UPDATE tipo SET descricao = :descricao WHERE id = :id;');

    $descricao = $dados['descricao'];

    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $id = $dados['id'];

    $stmt->execute();

    header("location:tipoLista.php");
}

function excluir($id)
{
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('DELETE FROM tipo WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $id = $id;
    $stmt->execute();
    header("location:tipoLista.php");

    //echo "Excluir".$id;

}


// Busca um item pelo código no BD
function buscarDados($id)
{
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT * FROM tipo WHERE id = $id;");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['id'] = $linha['id'];
        $dados['descricao'] = $linha['descricao'];
    }
    //var_dump($dados);
    return $dados;
}

// Busca as informações digitadas no form
function dadosForm()
{
    $dados = array();
    $dados['id'] = $_POST['id'];
    $dados['descricao'] = $_POST['descricao'];
    return $dados;
}
