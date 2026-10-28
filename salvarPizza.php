
<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: painel.php");
    exit;
}

require_once "conexao.php";

$nome = trim($_POST["nome"] ?? "");
$descricao = trim($_POST["descricao"] ?? "");
$imagem = trim($_POST["imagem"] ?? "");
$precoTexto = str_replace(",", ".", trim($_POST["preco"] ?? ""));

if (
    $nome === "" ||
    !is_numeric($precoTexto) ||
    (float) $precoTexto <= 0 ||
    strlen($nome) > 100 ||
    strlen($imagem) > 255
) {
    die("Dados inválidos. Verifique o formulário.");
}

$preco = (float) $precoTexto;

$sql = "INSERT INTO pizzas (nome, descricao, preco, imagem, ativo)
        VALUES (?, ?, ?, ?, TRUE)";

$stmt = mysqli_prepare($conexao, $sql);

if (!$stmt) {
    die("Erro ao preparar cadastro: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param(
    $stmt,
    "ssds",
    $nome,
    $descricao,
    $preco,
    $imagem
);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);

    header("Location: painel.php?mensagem=cadastrada");
    exit;
}

mysqli_stmt_close($stmt);
mysqli_close($conexao);

die("Não foi possível cadastrar a pizza.");
?>
