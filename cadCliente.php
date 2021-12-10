<!DOCTYPE html>
<?php
include_once "acaoCliente.php";
$acaoCliente = isset($_GET['acaoCliente']) ? $_GET['acaoCliente'] : "";
$dados;
if ($acaoCliente == 'editar') {
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id);
}
#var_dump($dados);
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro Cliente</title>
</head>

<body>
    <?php include 'menu.php'; ?>
    <br><br>
    <form action="acaoCliente.php" method="post">
        <input readonly type="text" name="id" id="id" value="<?php if ($acaoCliente == "editar") echo $dados['id'];
                                                                else echo 0; ?>"><br>
        <input required=true placeholder="Nome" type="text" name="nome" id="nome" value="<?php if ($acaoCliente == "editar") echo $dados['nome']; ?>"><br>
        <input required=true placeholder="CPF" type="text" name="cpf" id="cpf" value="<?php if ($acaoCliente == "editar") echo $dados['cpf']; ?>"><br>
        <input required=true placeholder="Telefone" type="text" name="telefone" id="telefone" value="<?php if ($acaoCliente == "editar") echo $dados['telefone']; ?>"><br>
        <input required=true placeholder="E-mail" type="text" name="email" id="email" value="<?php if ($acaoCliente == "editar") echo $dados['email']; ?>"><br>
        <input required=true placeholder="Cidade" type="text" name="cidade" id="cidade" value="<?php if ($acaoCliente == "editar") echo $dados['cidade']; ?>"><br>
        <input required=true placeholder="Bairro" type="text" name="bairro" id="bairro" value="<?php if ($acaoCliente == "editar") echo $dados['bairro']; ?>"><br>
        <input required=true placeholder="Rua" type="text" name="rua" id="rua" value="<?php if ($acaoCliente == "editar") echo $dados['rua']; ?>"><br>
        <input required=true placeholder="Num" type="number" name="num" id="num" value="<?php if ($acaoCliente == "editar") echo $dados['num']; ?>"><br>
        <br><button type="submit" name="acaoCliente" id="acaoCliente" value="salvar">Salvar</button>
    </form>
</body>

</html>