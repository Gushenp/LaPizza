
<?php

require_once "conexao.php";

// Defina as credenciais iniciais
$usuario = "adminGush";
$senha = "123";

// Gerar o hash seguro da senha
$hash = password_hash($senha, PASSWORD_DEFAULT);

// Inserir o administrador no banco
$sql = "INSERT INTO administradores (usuario, senha)
        VALUES (?, ?)";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($stmt, "ss", $usuario, $hash);

if (mysqli_stmt_execute($stmt)) {
    echo "Administrador criado com sucesso!";
} else {
    echo "Erro ao criar administrador: "
        . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conexao);

?>
