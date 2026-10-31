
<?php

require_once "conexao.php";

// Receber os dados do formulário
$nome = trim($_POST["nome"] ?? "");

$carrinhoJson = $_POST["carrinho"] ?? "[]";
$carrinho = json_decode($carrinhoJson, true);

// Validar os dados
if (
    $nome === "" ||
    !is_array($carrinho) ||
    empty($carrinho)
) {
    die("Nome ou carrinho inválido.");
}

// Calcular o total usando os preços do banco
$total = 0;

foreach ($carrinho as $produto) {

    $id = filter_var(
        $produto["id"] ?? null,
        FILTER_VALIDATE_INT
    );

    $quantidade = filter_var(
        $produto["quantidade"] ?? null,
        FILTER_VALIDATE_INT
    );

    if (!$id || !$quantidade || $quantidade < 1) {
        die("Produto ou quantidade inválida.");
    }

    $sql = "SELECT preco FROM pizzas
            WHERE id = ? AND ativo = TRUE";

    $stmt = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $pizza = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);

    if (!$pizza) {
        die("Pizza não encontrada ou inativa.");
    }

    $total += (float) $pizza["preco"] * $quantidade;
}

// Inserir o pedido na tabela pedidos
$sql = "INSERT INTO pedidos (nome_cliente, total)
        VALUES (?, ?)";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($stmt, "sd", $nome, $total);

if (!mysqli_stmt_execute($stmt)) {
    die("Erro ao cadastrar pedido: " .
        mysqli_stmt_error($stmt));
}

// Recuperar o ID gerado
$pedidoId = mysqli_insert_id($conexao);

mysqli_stmt_close($stmt);

// Mostrar confirmação
echo "<h1>Pedido cadastrado com sucesso!</h1>";

echo "<p>Pedido número: " . (int) $pedidoId . "</p>";

echo "<p>Cliente: " .
    htmlspecialchars($nome, ENT_QUOTES, "UTF-8") .
    "</p>";

echo "<p>Total: R$ " .
    number_format($total, 2, ",", ".") .
    "</p>";

mysqli_close($conexao);

header("Location: index.php");
exit;
?>
