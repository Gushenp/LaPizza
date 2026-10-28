<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.html");
    exit;
}

require_once "conexao.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("ID da pizza inválido.");
}

$sql = "SELECT id, nome, descricao, preco, ativo FROM pizzas WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);
$pizza = mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);

if (!$pizza) {
    mysqli_close($conexao);
    die("Pizza não encontrada.");
}

mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pizza - LaPizza</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="card shadow-sm mx-auto" style="max-width: 650px;">
            <div class="card-body p-4">
                <h1 class="mb-4">Editar Pizza</h1>

                <form action="atualizarPizza.php" method="POST">
                    <input type="hidden" name="id"
                        value="<?= (int) $pizza["id"] ?>">

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" id="nome" name="nome"
                            class="form-control" maxlength="100" required
                            value="<?= htmlspecialchars($pizza["nome"], ENT_QUOTES, "UTF-8") ?>">
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea id="descricao" name="descricao"
                            class="form-control" rows="3"><?= htmlspecialchars($pizza["descricao"] ?? "", ENT_QUOTES, "UTF-8") ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço (R$)</label>
                        <input type="number" id="preco" name="preco"
                            class="form-control" min="0.01" step="0.01"
                            required
                            value="<?= htmlspecialchars((string) $pizza["preco"], ENT_QUOTES, "UTF-8") ?>">
                    </div>

                    <div class="mb-4">
                        <label for="ativo" class="form-label">Situação</label>
                        <select id="ativo" name="ativo" class="form-select">
                            <option value="1" <?= $pizza["ativo"] ? "selected" : "" ?>>
                                Ativa
                            </option>
                            <option value="0" <?= !$pizza["ativo"] ? "selected" : "" ?>>
                                Inativa
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">
                        Salvar alterações
                    </button>

                    <a href="painel.php" class="btn btn-secondary">
                        Cancelar
                    </a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>