<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.html");
    exit;
}

require_once "conexao.php";

$sql = "SELECT id, nome, descricao, preco, ativo FROM pizzas ORDER BY id ASC";
$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die("Erro ao consultar pizzas: " . mysqli_error($conexao));
}

$sqlPedidos = "SELECT id, nome_cliente, total, status, data_pedido
               FROM pedidos
               WHERE status = 'Pendente'
               ORDER BY data_pedido DESC";

$resultadoPedidos = mysqli_query($conexao, $sqlPedidos);

if (!$resultadoPedidos) {
    die("Erro ao consultar pedidos: " . mysqli_error($conexao));
}
?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - LaPizza</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1>Painel Administrativo</h1>
                <p class="text-muted mb-0">
                    Bem-vindo,
                    <strong><?= htmlspecialchars($_SESSION["admin_usuario"], ENT_QUOTES, "UTF-8") ?></strong>!
                </p>
            </div>



            <?php if (($_GET["mensagem"] ?? "") === "excluida"): ?>
                <div class="alert alert-success">
                    Pizza excluída com sucesso!
                </div>

            <?php elseif (($_GET["mensagem"] ?? "") === "nao_encontrada"): ?>
                <div class="alert alert-warning">
                    A pizza não foi encontrada.
                </div>

            <?php elseif (($_GET["mensagem"] ?? "") === "pedido_excluido"): ?>
                <div class="alert alert-success">
                    Pedido excluído com sucesso!
                </div>

            <?php elseif (($_GET["mensagem"] ?? "") === "pedido_erro"): ?>
                <div class="alert alert-danger">
                    Não foi possível excluir o pedido.
                </div>

            <?php endif; ?>


            <a href="index.php" class="btn btn-danger">Sair</a>
        </div>

        <h2 class="mb-3">Pizzas cadastradas</h2>


        <a href="cadastrarPizza.php" class="btn btn-success mb-3">
            + Cadastrar nova pizza
        </a>


        <div class="table-responsive">
            <table class="table table-striped table-bordered bg-white align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (mysqli_num_rows($resultado) > 0): ?>
                        <?php while ($pizza = mysqli_fetch_assoc($resultado)): ?>
                            <tr>
                                <td><?= (int) $pizza["id"] ?></td>

                                <td>
                                    <?= htmlspecialchars($pizza["nome"], ENT_QUOTES, "UTF-8") ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($pizza["descricao"] ?? "", ENT_QUOTES, "UTF-8") ?>
                                </td>

                                <td>
                                    R$ <?= number_format((float) $pizza["preco"], 2, ",", ".") ?>
                                </td>

                                <td>
                                    <?php if ($pizza["ativo"]): ?>
                                        <span class="badge bg-success">Ativa</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inativa</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <a href="editarPizza.php?id=<?= (int) $pizza['id'] ?>"
                                        class="btn btn-primary btn-sm">
                                        Editar
                                    </a>


                                    <form action="excluirPizza.php" method="POST"
                                        onsubmit="return confirm('Tem certeza de que deseja excluir esta pizza?');"
                                        style="display: inline;">

                                        <input type="hidden" name="id"
                                            value="<?= (int) $pizza['id'] ?>">

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Excluir
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                Nenhuma pizza cadastrada.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>


    <h2 class="mt-5 mb-3">Pedidos ativos</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered bg-white align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nº Pedido</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>
                <?php if (mysqli_num_rows($resultadoPedidos) > 0): ?>
                    <?php while ($pedido = mysqli_fetch_assoc($resultadoPedidos)): ?>
                        <tr>
                            <td><?= (int) $pedido["id"] ?></td>

                            <td>
                                <?= htmlspecialchars($pedido["nome_cliente"], ENT_QUOTES, "UTF-8") ?>
                            </td>

                            <td>
                                R$ <?= number_format((float) $pedido["total"], 2, ",", ".") ?>
                            </td>

                            <td>
                                <span class="badge bg-warning text-dark">
                                    <?= htmlspecialchars($pedido["status"], ENT_QUOTES, "UTF-8") ?>
                                </span>
                            </td>

                            <td>
                                <?= htmlspecialchars($pedido["data_pedido"], ENT_QUOTES, "UTF-8") ?>
                            </td>

                            <td>
                                <form action="excluirPedido.php" method="POST"
                                    onsubmit="return confirm('Tem certeza de que deseja excluir este pedido?');">

                                    <input type="hidden" name="id"
                                        value="<?= (int) $pedido["id"] ?>">

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Nenhum pedido ativo no momento.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


</body>

</html>

<?php
mysqli_free_result($resultado);
mysqli_close($conexao);
?>