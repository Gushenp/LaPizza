
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

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$nome = trim($_POST["nome"] ?? "");
$descricao = trim($_POST["descricao"] ?? "");
$precoTexto = str_replace(",", ".", trim($_POST["preco"] ?? ""));
$ativoTexto = $_POST["ativo"] ?? "";

if (
    !$id ||
    $nome === "" ||
    !is_numeric($precoTexto) ||
    (float) $precoTexto <= 0 ||
    !in_array($ativoTexto, ["0", "1"], true)
) {
    die("Dados inválidos. Verifique o formulário.");
}

$preco = (float) $precoTexto;
$ativo = (int) $ativoTexto;

$sql = "UPDATE pizzas
        SET nome = ?, descricao = ?, preco = ?, ativo = ?
        WHERE id = ?";

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "ssdii",
    $nome,
    $descricao,
    $preco,
    $ativo,
    $id
);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);

    header("Location: painel.php?mensagem=atualizada");
    exit;
}

mysqli_stmt_close($stmt);
mysqli_close($conexao);

die("Não foi possível atualizar a pizza.");
?>
