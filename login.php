
<?php

session_start();

require_once "conexao.php";

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit;
}

// Receber os dados do formulário
$usuario = trim($_POST["usuario"] ?? "");
$senha = $_POST["senha"] ?? "";

if ($usuario === "" || $senha === "") {
    die("Preencha o usuário e a senha.");
}

// Buscar o administrador pelo usuário
$sql = "SELECT id, usuario, senha
        FROM administradores
        WHERE usuario = ?
        LIMIT 1";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($stmt, "s", $usuario);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);
$admin = mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);
mysqli_close($conexao);

// Verificar a senha usando o hash armazenado
if ($admin && password_verify($senha, $admin["senha"])) {

    session_regenerate_id(true);

    $_SESSION["admin_id"] = $admin["id"];
    $_SESSION["admin_usuario"] = $admin["usuario"];

    header("Location: painel.php");
    exit;

} else {
    echo "Usuário ou senha incorretos.";
}

?>
