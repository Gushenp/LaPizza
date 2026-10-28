
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

if (!$id) {
    header("Location: painel.php?mensagem=erro_id");
    exit;
}

$sql = "DELETE FROM pizzas WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);

if (!$stmt) {
    die("Erro ao preparar exclusão: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, "i", $id);
$sucesso = mysqli_stmt_execute($stmt);
$erro = mysqli_stmt_errno($stmt);
$excluida = mysqli_stmt_affected_rows($stmt) > 0;

mysqli_stmt_close($stmt);
mysqli_close($conexao);

if (!$sucesso) {
    if ($erro === 1451) {
        header("Location: painel.php?mensagem=pizza_em_pedido");
        exit;
    }

    die("Erro ao excluir a pizza. Código: " . $erro);
}

if ($excluida) {
    header("Location: painel.php?mensagem=excluida");
} else {
    header("Location: painel.php?mensagem=nao_encontrada");
}

exit;
?>
