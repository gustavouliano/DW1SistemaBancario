<!DOCTYPE html>
<?php
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contas</title>
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
        Consultar por: <br>
        <input type="radio" name="optionSearchUser" id="" value="id" required>Id<br>
        <input type="radio" name="optionSearchUser" id="" value="saldo" required>Saldo<br>
        <a href="contaLista.php">Listar todos</a><br>
        <input type="text" name="valorUser">
        <input type="submit" value="Consultar">
    </form>
    <?php

    try {

        $optionSearchUser = isset($_POST["optionSearchUser"]) ? $_POST["optionSearchUser"] : "";
        $valorUser = isset($_POST["valorUser"]) ? $_POST["valorUser"] : "";

        $sql = "";

        if ($optionSearchUser != "") {
            if ($valorUser == "") {

                $sql = ("SELECT * FROM conta;");
            } else if ($optionSearchUser == "id") {
                $sql = ("SELECT * FROM conta WHERE $optionSearchUser = $valorUser;");
            } else if ($optionSearchUser == "saldo") {
                $sql = ("SELECT * FROM conta WHERE $optionSearchUser <= $valorUser;");
            }
        } else {
            $sql = ("SELECT * FROM conta;");
        }
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
    ?>
        <br>
        <table>
            <tr>
                <th>Número Conta (id)</th>
                <th>Saldo</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
            <?php
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?php echo $linha['id']; ?></td>
                    <td><?php echo $linha['saldo']; ?></td>
                    <td><a href='cadConta.php?acao=editar&id=<?php echo $linha['id']; ?>'><img class="icon" src="img/edit.png" alt="Alterar"></a></td>
                    <td><a href="javascript:excluirRegistro('acaoConta.php?acao=excluir&id=<?php echo $linha['id']; ?>')"><img class="icon" src="img/delete.png" alt="Excluir"></a></td>
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