
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
    header("Location: painel.php?mensagem=pedido_erro");
    exit;
}

mysqli_begin_transaction($conexao);

try {
    // Confirmar que o pedido existe e está pendente
    $sql = "SELECT id FROM pedidos WHERE id = ? AND status = 'Pendente' FOR UPDATE";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $pedido = mysqli_fetch_assoc($resultado);
    mysqli_stmt_close($stmt);

    if (!$pedido) {
        throw new Exception("Pedido não encontrado.");
    }

    // Excluir os itens do pedido
    $sql = "DELETE FROM pedido_itens WHERE pedido_id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        throw new Exception("Erro ao excluir itens.");
    }

    mysqli_stmt_close($stmt);

    // Excluir o pedido
    $sql = "DELETE FROM pedidos WHERE id = ? AND status = 'Pendente'";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (!mysqli_stmt_execute($stmt) ||
        mysqli_stmt_affected_rows($stmt) !== 1) {
        mysqli_stmt_close($stmt);
        throw new Exception("Erro ao excluir pedido.");
    }

    mysqli_stmt_close($stmt);

    mysqli_commit($conexao);
    mysqli_close($conexao);

    header("Location: painel.php?mensagem=pedido_excluido");
    exit;

} catch (Exception $e) {
    mysqli_rollback($conexao);
    mysqli_close($conexao);

    header("Location: painel.php?mensagem=pedido_erro");
    exit;
}
?>
