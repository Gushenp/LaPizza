<?php
require_once "conexao.php";

$sql = "SELECT id, nome, descricao, preco, imagem
        FROM pizzas
        WHERE ativo = 1
        ORDER BY id DESC";

$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die("Erro ao carregar as pizzas: " . mysqli_error($conexao));
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<!DOCTYPE html>
<html lang="pr-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.2/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>LaPizza</title>
</head>

<body class="width-auto ">
    <!-- Barra de navegação -->
    <nav class="navbar sm:navbar-expand bg-1 fg-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/NavLogo.png" alt="Logo" width="90" class="d-inline-block align-text-top">
            </a>

            <!-- Menu para navegação -->
            <div class="drawer-body">
                <div class="nav nav-pills navbar-nav  d-flex justify-content-center">
                    <a class="nav-link" aria-current="page" href="#">Início</a>
                    <a class="nav-link" href="#">Cardápio</a>
                    <a class="nav-link" href="#">Sobre</a>
                    <a class="nav-link" href="#">Contato</a>
                </div>
            </div>

            <!-- Página de acesso ao carrinho e compras e ADM -->
            <div class="d-flex gap-8">
                <!-- Carrinho -->
                <a href="carrinho.html">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-cart-fill" viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg>
                </a>

                <a href="" data-bs-toggle="dialog" data-bs-target="#exampleDialog">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-key-fill" viewBox="0 0 16 16">
                        <path
                            d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2M2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                    </svg>
                </a>

            </div>
        </div>

    </nav>

    <!-- Modal do ADM -->
    <dialog class="dialog" id="exampleDialog">
        <div class="dialog-header">
        </div>

        <div class="dialog-body">
            <section class="vh-100 gradient-custom">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">

                                    <div class="mb-md-5 mt-md-4 pb-5">


                                        <form action="login.php" method="POST">

                                            <div class="mb-md-5 mt-md-4 pb-5">

                                                <h2 class="fw-bold mb-2 text-uppercase">
                                                    Administração
                                                </h2>

                                                <p class="text-white-50 mb-5">
                                                    Por favor, entre com seu usuário e senha!
                                                </p>

                                                <div data-mdb-input-init class="form-outline form-white mb-4">

                                                    <input
                                                        type="text"
                                                        id="usuario"
                                                        name="usuario"
                                                        class="form-control form-control-lg"
                                                        required
                                                        autocomplete="username" />

                                                    <label class="form-label" for="usuario">
                                                        Usuário
                                                    </label>

                                                </div>

                                                <div data-mdb-input-init class="form-outline form-white mb-4">

                                                    <input
                                                        type="password"
                                                        id="senha"
                                                        name="senha"
                                                        class="form-control form-control-lg"
                                                        required
                                                        autocomplete="current-password" />

                                                    <label class="form-label" for="senha">
                                                        Senha
                                                    </label>

                                                </div>

                                                <button
                                                    class="btn btn-outline-light btn-lg px-5"
                                                    type="submit">
                                                    Entrar
                                                </button>

                                            </div>

                                        </form>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="dialog-footer">
            <button type="button" class="btn-solid theme-secondary" data-bs-dismiss="dialog">Close</button>
        </div>
    </dialog>

    <!-- Secção de apresentação -->
    <section class="position-relative banner-bg">

        <div class="banner position-relative mx-auto ">
            <!-- Foto do banner -->
            <img src="assets/NavImagem.png" class="w-100 d-block imagemBanner" alt="Pizza da LaPizza">

            <!-- Texto e botão sobre a imagem -->
            <div class="position-absolute top-50 translate-middle-y end-0">

                <div class="d-flex flex-column align-items-center gap-8 bannerText text-end">

                    <!-- Texto de introdução -->
                    <p class="mb-0">
                        Pizzas feitas com ingredientes selecionados
                    </p>

                    <div class="">
                        <h1 class="mb-0">O VERDADEIRO</h1>
                        <h2 class="mb-0">SABOR DA PIZZA.</h2>
                    </div>

                    <p class="mb-0 d-flex w-50">
                        Aqui na LaPizza cada pedaço é preparado com muito
                        carinho, ingredientes de qualidade.
                    </p>

                    <a href="cardapio.php" class="btn btn-warning">
                        Ver Cardápio
                    </a>

                </div>

            </div>
        </div>

    </section>

    <!-- Cardápio -->
    <section class="cardapio">
        <div class="text-center pt-10">
            <h2>Nossas Pizzas em Destaque</h2>
            <p>Escolha as suas favoritas e aproveite o melhor da nossa culinária!</p>
        </div>

        <div class="d-flex flex-row justify-content-center gap-3 flex-wrap pt-10">

            <?php while ($pizza = mysqli_fetch_assoc($resultado)): ?>

                <div class="card" style="width: 18rem;">

                    <img
                        src="<?= htmlspecialchars($pizza['imagem'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        class="card-img-top fotoPizza"
                        alt="<?= htmlspecialchars($pizza['nome'], ENT_QUOTES, 'UTF-8') ?>">

                    <div class="card-body">
                        <h5 class="card-title">
                            <?= htmlspecialchars($pizza['nome'], ENT_QUOTES, 'UTF-8') ?>
                        </h5>

                        <p class="card-text">
                            <?= htmlspecialchars($pizza['descricao'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <p class="fw-bold">
                            R$ <?= number_format((float) $pizza['preco'], 2, ',', '.') ?>
                        </p>

                        <button
                            type="button"
                            class="btn btn-primary"
                            onclick="adicionarCarrinho(
                            <?= (int) $pizza['id'] ?>,
                            <?= htmlspecialchars(json_encode($pizza['nome'], JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP), ENT_QUOTES, 'UTF-8') ?>,
                            <?= (float) $pizza['preco'] ?>
                        )">
                            Adicionar ao carrinho
                        </button>
                    </div>

                </div>

            <?php endwhile; ?>

        </div>
    </section>

    <!-- Sobre a pizzaria -->
    <section class="sobrePizzaria pt-10">
        <h1>Sobre a Bella Pizza</h1>
        <p>Somos uma pizzaria familiar, apaixonada por pizzas e por bons momentos. Nosso objetivo é levar até você o melhor da culinária italiana, com receitas tradicionais e ingredientes selecionados.</p>
        <div>
            <div>
                <h1>ICONE</h1>
                <p>Descrição</p>
            </div>
            <div>
                <h1>ICONE</h1>
                <p>Descrição</p>
            </div>
            <div>
                <h1>ICONE</h1>
                <p>Descrição</p>
            </div>
        </div>
        <div>
            <h2>Mais que uma pizza,</h2>
            <h1>uma experiência</h1>
        </div>
    </section>

    <?php mysqli_free_result($resultado); ?>




    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL" crossorigin="anonymous">
    </script>

    <script src="carrinho.js"></script>
</body>

</html>