<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pizza - LaPizza</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="card shadow-sm mx-auto" style="max-width: 650px;">
            <div class="card-body p-4">

                <h1 class="mb-4">Cadastrar nova pizza</h1>

                <form action="salvarPizza.php" method="POST">

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da pizza</label>
                        <input type="text" id="nome" name="nome"
                            class="form-control" maxlength="100" required>
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea id="descricao" name="descricao"
                            class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço (R$)</label>
                        <input type="number" id="preco" name="preco"
                            class="form-control" min="0.01" step="0.01"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="imagem" class="form-label">
                            Caminho da imagem
                        </label>
                        <input type="text" id="imagem" name="imagem"
                            class="form-control" maxlength="255"
                            placeholder="assets/pizzaGenerica.jpg">
                    </div>

                    <button type="submit" class="btn btn-success">
                        Cadastrar pizza
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