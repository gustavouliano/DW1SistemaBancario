<!DOCTYPE html>
<?php
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
include 'util/util.php';
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Operações</title>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
    <style>
        table {
            text-align: center;
            margin: 0 auto;
            border-collapse: collapse;
            width: 100%;
            border-radius: 5px;
            border-style: hidden;
            box-shadow: 0 0 0 1px black;
        }

        tr,
        th,
        td {
            border: 1px solid black;
        }

        th {
            width: 5%;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php include 'menu.php'; ?>

    <form method="POST">
        <a href="operacaoLista.php">Listar todos</a><br>
        <input type="text" name="valorUser">
        <input type="submit" value="Consultar">
    </form>
    <?php

    try {
        $valorUser = isset($_POST["valorUser"]) ? $_POST["valorUser"] : "";

        $sql = "";

        if ($valorUser == "") {
            $sql = ("SELECT operacao.id, valor, data, observacao, descricao, saldo, conta_id FROM operacao, conta, tipo WHERE operacao.conta_id = conta.id AND operacao.tipo_id = tipo.id ORDER BY operacao.id;");
        } else {
            $sql = ("SELECT operacao.id, valor, data, observacao, descricao, saldo, conta_id FROM operacao, conta, tipo WHERE operacao.conta_id = conta.id AND operacao.tipo_id = tipo.id ORDER BY operacao.id; ");
        }

        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
    ?>
        <br>
        <table>
            <tr>
                <th>Id</th>
                <th>Número da conta</th>
                <th>Tipo de Operação</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Observação</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
            <?php
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?php echo $linha['id']; ?></td>
                    <td><?php echo $linha['conta_id']; ?></td>
                    <td><?php echo $linha['descricao']; ?></td>
                    <td><?php echo $linha['valor']; ?></td>
                    <td><?php echo dataTracoToPadrao($linha['data']); ?></td>
                    <td><?php echo $linha['observacao']; ?></td>
                    <td><a href='cadOperacao.php?acao=editar&id=<?php echo $linha['id']; ?>'><img class="icon" src="img/edit.png" alt=""></a></td>
                    <td><a href="javascript:excluirRegistro('acaoOperacao.php?acao=excluir&id=<?php echo $linha['id']; ?>')"><img class="icon" src="img/delete.png" alt=""></a></td>
                </tr>
            <?php } ?>
        </table>
    <?php
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    ?>

</body>

</html>