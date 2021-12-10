<!DOCTYPE html>
<?php
$title = "Cadastro de Contas";
include 'connect/connect.php';
include 'acaoConta.php';
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
    <!--     <link rel=stylesheet href='css/jquery-calendario.css' />
    <link rel=stylesheet href='css/calendario.css' />
    <link rel=stylesheet href='css/estilo.css' />
    <script src="js/jquery.maskedinput.js"></script>
    <script src='js/calendario.js'></script>
    <script src="js/jquery-2.1.4.min.js"></script>
    <script>
        jQuery(function($) {
            $("#dataVencimento").mask("99/99/9999");
            $("#dataPagamento").mask("99/99/9999");
        });
    </script> -->
</head>

<body>
    <?php include 'menu.php'; ?>
    <form style="margin-left: 0.5%" action="acaoConta.php" id="form" method="post">
        <div class="mb-23 row">
            <label for="staticEmail" class="col-sm-2 col-form-label" readonl>Número da Conta</label>
            <div class="col-sm-1">
                <input type="text" readonly class="form-control-plaintext" type="text" name="id" id="id" size="3" value="<?php if ($acao == "editar") echo $dados['id'];
                                                                                                                            else echo "0"; ?>">
            </div>
        </div>
        <div class="mb-2 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Saldo R$</label>
            <div class="col-sm-1">
                <input type='number' class="form-control" id="inputPassword" step="0.01" min="0" size='4' name='saldo' id='saldo' value="<?php if ($acao == "editar") echo $dados['saldo']; ?>">
            </div>
        </div>
        <button class="btn btn-primary mb-3" name="acao" value="salvar" id="acao" type="submit">Salvar</button>
        <!--         <fieldset>
            <legend class="legendConta"><?php echo $title; ?></legend>
            Código
            <input type="text" name="id" id="id" size="3" value="<?php if ($acao == "editar") echo $dados['id'];
                                                                    else echo "0"; ?>" readonly>
            Saldo
            <input type='number' size='4' name='saldo' id='saldo' value="<?php if ($acao == "editar") echo $dados['saldo']; ?>" />

            <br><br>
            <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
            <a href="contaLista.php">Consultar</a> -->

        <br><br>
        <?php if ($acao == "editar") { ?>

            <table width="100%" border="1" align="left" id='painel'>
                <tr>
                <tr>
                    <td width="90" align="center"><b>Nome|CPF</b></td>
                    <td width="120" align="right"><b></b></td>
                </tr>
                <tr>
                    <td width="90" align="center">
                        <select name="cliente" id="cliente">
                            <?php
                            $sql = "SELECT * FROM cliente;";
                            $result = mysqli_query($conexao, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value="' . $row['id'] . '"';
                                echo '>' . $row['nome'] . ' | ' . $row['cpf'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td width="120" align="right">
                        <button name="acao" id="acao" value="addCliente" type="submit" onclick="return validaAddProd();">
                            <img src="img/form/add.png" alt="Adicionar">Adicionar cliente
                        </button><br><br>
                    </td>
                </tr>
            </table>


            <br><br>

            <table width="100%" border="1" align="left" id='painel'>
                <tr>
                    <td width="90" align="center"><b>ID</b></td>
                    <td width="400"><b>Nome</b></td>
                    <td width="400"><b>CPF</b></td>
                    <td width="20"></td>
                </tr>



                <?php
                $sql = "SELECT cliente.id, conta.id, cliente.nome, cliente.cpf, conta.saldo FROM conta, cliente, conta_has_cliente 
                    WHERE conta.id = $id
                    AND conta_has_cliente.conta_id = conta.id AND cliente.id = conta_has_cliente.cliente_id;";
                $result = mysqli_query($conexao, $sql);
                while ($row = mysqli_fetch_array($result)) {

                ?>
                    <tr>
                        <td align="center"><?php echo $row[0]; ?></td>
                        <td width="400"><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['cpf']; ?></td>
                        <td><a href="javascript:excluirRegistro('acaoConta.php?acao=excluirCliente&cliente=<?php echo $row[0]; ?>&conta=<?php echo $id; ?>')"><img border="0" src="img/form/delete.png" alt="Excluir"></a></td>
                    </tr>
                <?php }
                ?>
            </table>
        <?php } ?>
        <!-- </fieldset> -->
    </form>
    <?php include 'msg.php'; ?>
</body>

</html>