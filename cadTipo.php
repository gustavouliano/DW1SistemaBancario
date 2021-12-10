<!DOCTYPE html>
<?php
include_once "acaoTipo.php";
$acaoTipo = isset($_GET['acaoTipo']) ? $_GET['acaoTipo'] : "";
$dados;
if ($acaoTipo == 'editar') {
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
    <title>Cadastro Tipo</title>
</head>

<body>
    <?php include 'menu.php'; ?>
    <br><br>
    <form action="acaoTipo.php" method="post">
        <input readonly type="text" name="id" id="id" value="<?php if ($acaoTipo == "editar") echo $dados['id'];
                                                                else echo 0; ?>"><br>
        <input required=true placeholder="Descrição" type="text" name="descricao" id="descricao" value="<?php if ($acaoTipo == "editar") echo $dados['descricao']; ?>"><br>
        <br><button type="submit" name="acaoTipo" id="acaoTipo" value="salvar">Salvar</button>
    </form>
</body>

</html>