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
    <title>Lista de Clientes</title>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>

</head>

<body>
    <?php include 'menu.php'; ?>

    <form method="POST">
        Consultar por: <br>
        <input type="radio" name="opcaoUserPesquisa" id="opcaoUserPesquisa" value="id" required>Id<br>
        <input type="radio" name="opcaoUserPesquisa" id="opcaoUserPesquisa" value="nome" required>Nome<br>
        <input type="radio" name="opcaoUserPesquisa" id="opcaoUserPesquisa" value="cpf" required>CPF<br>
        <input type="radio" name="opcaoUserPesquisa" id="opcaoUserPesquisa" value="cidade" required>Cidade<br>
        Ordenar por: <br>
        <input type="radio" name="opcaoUserOrder" id="opcaoUserOrder" value=id required>Id
        <input type="radio" name="opcaoUserOrder" id="opcaoUserOrder" value=nome required>Nome
        <br>
        <a href="clienteLista.php">Listar todos</a><br>
        <input type="text" name="valorUser">
        <input type="submit" value="Consultar">
    </form>
    <?php

    try {
        $pdo = Conexao::getInstance();

        $opcaoUserPesquisa = isset($_POST["opcaoUserPesquisa"]) ? $_POST["opcaoUserPesquisa"] : "";
        $opcaoUserOrder = isset($_POST["opcaoUserOrder"]) ? $_POST["opcaoUserOrder"] : "";
        $valorUser = isset($_POST["valorUser"]) ? $_POST["valorUser"] : "";
        
        $sql = "";

        if ($opcaoUserPesquisa != "") {
            if ($valorUser == "") {
                $sql = ("SELECT id, nome, cpf, telefone, email, cidade, bairro, rua, num FROM cliente, endereco WHERE cliente.id = endereco.cliente_id ORDER BY $opcaoUserOrder;");
            } elseif ($opcaoUserPesquisa == "id") {
                $sql = ("SELECT id, nome, cpf, telefone, email, cidade, bairro, rua, num FROM cliente, endereco WHERE cliente.id = endereco.cliente_id AND $opcaoUserPesquisa = $valorUser ORDER BY $opcaoUserOrder;");
            } else {
                $sql = ("SELECT id, nome, cpf, telefone, email, cidade, bairro, rua, num FROM cliente JOIN endereco ON id = cliente_id WHERE $opcaoUserPesquisa LIKE '$valorUser%' ORDER BY $opcaoUserOrder;");
            }
        } else {
            $sql = ("SELECT id, nome, cpf, telefone, email, cidade, bairro, rua, num FROM cliente, endereco WHERE cliente.id = endereco.cliente_id;");
        }

        $consulta = $pdo->query($sql);

    ?>
        <br>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Rua</th>
                    <th scope="col">Núm</th>
                    <th scope="col">Alterar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>


                <!-- <table>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>Rua</th>
                <th>Núm</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>-->
                <?php
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $linha['id']; ?></td>
                        <td><?php echo $linha['nome']; ?></td>
                        <td><?php echo $linha['cpf']; ?></td>
                        <td><?php echo $linha['telefone']; ?></td>
                        <td><?php echo $linha['email']; ?></td>
                        <td><?php echo $linha['cidade']; ?></td>
                        <td><?php echo $linha['bairro']; ?></td>
                        <td><?php echo $linha['rua']; ?></td>
                        <td><?php echo $linha['num']; ?></td>
                        <td><a href='cadCliente.php?acaoCliente=editar&id=<?php echo $linha['id']; ?>'><img class="icon" src="img/edit.png" alt=""></a></td>
                        <td><a href="javascript:excluirRegistro('acaoCliente.php?acaoCliente=excluir&id=<?php echo $linha['id']; ?>')"><img class="icon" src="img/delete.png" alt=""></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    ?>

</body>

</html>