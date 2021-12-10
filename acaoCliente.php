<?php

include_once "conf/default.inc.php";
require_once "conf/Conexao.php";

// Se foi enviado via GET para acaoCliente entra aqui
$acaoCliente = isset($_GET['acaoCliente']) ? $_GET['acaoCliente'] : "";
if ($acaoCliente == "excluir") {
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    excluir($id);
}

// Se foi enviado via POST para acaoCliente entra aqui
$acaoCliente = isset($_POST['acaoCliente']) ? $_POST['acaoCliente'] : "";
if ($acaoCliente == "salvar") {
    
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
    $stmt = $pdo->prepare('INSERT INTO cliente (nome, cpf, telefone, email) VALUES(:nome, :cpf, :telefone, :email)');
    $nome = $dados['nome'];
    $cpf = $dados['cpf'];
    $telefone = $dados['telefone'];
    $email = $dados['email'];
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
    $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    $stmt->execute();

    $stmt2 = $pdo->prepare('INSERT INTO endereco (cidade, bairro, rua, num, cliente_id) VALUES(:cidade, :bairro, :rua, :num, :cliente_id)');

    $ultimo_id_inserido = $pdo->lastInsertId();
    $cidade = $dados['cidade'];
    $bairro = $dados['bairro'];
    $rua = $dados['rua'];
    $num = $dados['num'];

    $stmt2->bindParam(':cidade', $cidade, PDO::PARAM_STR);
    $stmt2->bindParam(':bairro', $bairro, PDO::PARAM_STR);
    $stmt2->bindParam(':rua', $rua, PDO::PARAM_STR);
    $stmt2->bindParam(':num', $num, PDO::PARAM_INT);
    $stmt2->bindParam(':cliente_id', $ultimo_id_inserido, PDO::PARAM_INT);
    $stmt2->execute();
    header("location:cadCliente.php");
}

function editar($id)
{
    $dados = dadosForm();
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('UPDATE cliente SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email WHERE id = :id;');
    $stmt2 = $pdo->prepare('UPDATE endereco SET cidade = :cidade, bairro = :bairro, rua = :rua, num = :num WHERE cliente_id = :id');
    $nome = $dados['nome'];
    $cpf = $dados['cpf'];
    $telefone = $dados['telefone'];
    $email = $dados['email'];

    $cidade = $dados['cidade'];
    $bairro = $dados['bairro'];
    $rua = $dados['rua'];
    $num = $dados['num'];

    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
    $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    $stmt2->bindParam(':cidade', $cidade, PDO::PARAM_STR);
    $stmt2->bindParam(':bairro', $bairro, PDO::PARAM_STR);
    $stmt2->bindParam(':rua', $rua, PDO::PARAM_STR);
    $stmt2->bindParam(':num', $num, PDO::PARAM_INT);

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
    $id = $dados['id'];

    $stmt->execute();
    $stmt2->execute();

    header("location:clienteLista.php");
}

function excluir($id)
{
    $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('DELETE FROM cliente WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    header("location:clienteLista.php");

    //echo "Excluir".$id;

}


// Busca um item pelo código no BD
function buscarDados($id)
{
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query("SELECT id, nome, cpf, telefone, email, cidade, bairro, rua, num FROM cliente, endereco WHERE id = $id AND cliente_id = $id;");
    $dados = array();
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $dados['id'] = $linha['id'];
        $dados['nome'] = $linha['nome'];
        $dados['cpf'] = $linha['cpf'];
        $dados['telefone'] = $linha['telefone'];
        $dados['email'] = $linha['email'];
        $dados['cidade'] = $linha['cidade'];
        $dados['bairro'] = $linha['bairro'];
        $dados['rua'] = $linha['rua'];
        $dados['num'] = $linha['num'];
    }
    //var_dump($dados);
    return $dados;
}

// Busca as informações digitadas no form
function dadosForm()
{
    $dados = array();
    $dados['id'] = $_POST['id'];
    $dados['nome'] = $_POST['nome'];
    $dados['cpf'] = $_POST['cpf'];
    $dados['telefone'] = $_POST['telefone'];
    $dados['email'] = $_POST['email'];
    $dados['cidade'] = $_POST['cidade'];
    $dados['bairro'] = $_POST['bairro'];
    $dados['rua'] = $_POST['rua'];
    $dados['num'] = $_POST['num'];
    return $dados;
}
