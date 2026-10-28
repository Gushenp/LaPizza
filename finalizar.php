<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Finalizar Pedido - LaPizza</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <h1>Finalizar Pedido</h1>

        <form id="form-pedido" action="processarPedidos.php" method="POST">

            <div class="mb-3">

                <label for="nome" class="form-label">
                    Seu nome
                </label>

                <input
                    type="text"
                    class="form-control"
                    id="nome"
                    name="nome"
                    required>

            </div>

            <input
                type="hidden"
                name="carrinho"
                id="carrinho">

            <button
                type="submit"
                class="btn btn-success">
                Finalizar pedido
            </button>

        </form>

        <script>
            document
                .getElementById("form-pedido")
                .addEventListener("submit", function() {

                    const carrinho = JSON.parse(
                        localStorage.getItem("carrinho")
                    ) || [];

                    document.getElementById("carrinho").value =
                        JSON.stringify(carrinho);

                });
        </script>

    </div>

</body>

</html>