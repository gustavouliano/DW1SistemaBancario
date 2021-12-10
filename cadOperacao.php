<!DOCTYPE html>
<?php
$title = "Cadastro de Produtos";
include 'connect/connect.php';
include 'acaoOperacao.php';
$acao = '';
$id = '';
$dados;
if (isset($_GET["acao"]))
    $acao = $_GET["acao"];
if ($acao == "editar") {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $dados = carregaBDParaVetor($id);
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>

<body>
    <?php include 'menu.php'; ?>
    <form action="acaoOperacao.php" id="form" method="post">
        <input readonly type="hidden" name="id" id="id" value="<?php if ($acao == "editar") echo $dados['id'];
                                                                else echo 0; ?>"><br>
        <label for="">Número da Conta</label>
        <select name="conta" id="conta">
            <?php

            $sql = "SELECT * FROM conta;";
            #$pdo = Conexao::getInstance();
            #$consulta = $pdo->query($sql);
            $result = mysqli_query($conexao, $sql);
            #while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['id'] . '"';
                if ($acao == "editar" && $dados['conta'] == $row['id'])
                    echo ' selected';
                echo '>' . $row['id'] . '</option>';
            }
            ?>
        </select>
        <br>
        <label for="">Tipo de Operação</label>
        <select name="tipo" id="tipo">
            <?php
            $sql = "SELECT * FROM tipo;";
            $result = mysqli_query($conexao, $sql);
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['id'] . '"';
                if ($acao == "editar" && $dados['tipo'] == $row['id'])
                    echo ' selected';
                echo '>' . $row['descricao'] . '</option>';
            }
            ?>
        </select>
        <br>
        <label for="">Valor R$</label>
        <input required=true placeholder="Valor" type="number" name="valor" id="valor" value="<?php if ($acao == "editar") echo $dados['valor']; ?>"><br>
        <label for="">Data</label>
        <input required=true type="date" name="data" id="data" value="<?php if ($acao == "editar") echo $dados['data']; ?>"><br>
        <label for="">Observação</label>
        <input required=true placeholder="Observação" type="text" name="observacao" id="observacao" value="<?php if ($acao == "editar") echo $dados['observacao']; ?>"><br>
        <br>
        <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
    </form>
    <?php include 'msg.php'; ?>
</body>

</html>