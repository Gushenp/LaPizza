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

                                        <h2 class="fw-bold mb-2 text-uppercase">Administração</h2>
                                        <p class="text-white-50 mb-5">Por favor, entre com seu usuário e senha!</p>

                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="text" id="typeEmailX" class="form-control form-control-lg" />
                                            <label class="form-label" for="typeEmailX">Usuario</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline form-white mb-4">
                                            <input type="password" id="typePasswordX"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="typePasswordX">Senha</label>
                                        </div>

                                        <button data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-outline-light btn-lg px-5" type="submit">Entrar</button>

                                        <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                            <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                            <a href="#!" class="text-white"><i
                                                    class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                            <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                        </div>

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
    <!-- Corpo da págnia -->

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
            <h2>Nossas Pizzas em Destaque</h1>
                <p>Escolha as suas favoritas e aproveite o melhor da nossa culinária!</h3>
        </div>
        <div class="d-flex flex-row justify-content-center gap-3 flex-wrap pt-10">

            <!-- Pizza 1 -->
            <div class="card" style="width: 18rem;">
                <img src="assets/pizzaGenerica.jpg" class="card-img-top fotoPizza" alt="Pizza">

                <div class="card-body">
                    <h5 class="card-title">Pizza Calabresa</h5>
                    <p class="card-text">Uma deliciosa pizza de calabresa.</p>
                    <button href="#" class="btn btn-primary" data-id="1" data-nome="Pizza de Calabresa"
                        data-preco="39.90" data-imagem="assets/pizzaGenerica.jpg"
                        onclick="adicionarCarrinho(1, 'Pizza de Calabresa', 39.90)">
                        Adicionar ao carrinho
                    </button>
                </div>
            </div>
        </div>
    </section>



    <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL" crossorigin="anonymous">
        </script>

    <script src="carrinho.js"></script>
</body>

</html>