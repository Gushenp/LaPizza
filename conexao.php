
<?php

$conexao = mysqli_connect(
    "localhost",
    "root",
    "",
    "LaPizza",
    3307
);

if (!$conexao) {
    die(
        "Não foi possível conectar ao banco de dados: "
        . mysqli_connect_error()
    );
}

mysqli_set_charset($conexao, "utf8mb4");

echo "Conexão estabelecida com sucesso!";

?>
