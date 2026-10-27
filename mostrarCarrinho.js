console.log("mostrarCarrinho.js foi carregado!");

function exibirCarrinho() {
    const carrinho = JSON.parse(
        localStorage.getItem("carrinho")
    ) || [];

    const lista = document.getElementById("lista-carrinho");
    const totalElemento = document.getElementById("total-carrinho");

    lista.innerHTML = "";

    let total = 0;

    if (carrinho.length === 0) {
        lista.innerHTML = "<p>Seu carrinho está vazio.</p>";
        totalElemento.textContent = "Total: R$ 0,00";
        return;
    }

    carrinho.forEach((produto, indice) => {
        const subtotal = produto.preco * produto.quantidade;
        total += subtotal;

        const card = document.createElement("div");
        card.className = "card mb-3";

        card.innerHTML = `
            <div class="row g-0 align-items-center">
                <div class="col-3 col-md-2">
                    <img
                        src="${produto.imagem || 'assets/pizzaGenerica.jpg'}"
                        class="img-fluid rounded-start"
                        alt="${produto.nome}"
                    >
                </div>

                <div class="col-9 col-md-10">
                    <div class="card-body">
                        <h5 class="card-title">${produto.nome}</h5>

                        <p class="card-text">
                            Preço: ${produto.preco.toLocaleString("pt-BR", {
                                style: "currency",
                                currency: "BRL"
                            })}
                        </p>

                        <p class="card-text">
                            Quantidade: ${produto.quantidade}
                        </p>

                        <p class="card-text">
                            Subtotal: ${subtotal.toLocaleString("pt-BR", {
                                style: "currency",
                                currency: "BRL"
                            })}
                        </p>

                        <button
                            class="btn btn-outline-danger btn-sm"
                            data-indice="${indice}"
                        >
                            Remover
                        </button>
                    </div>
                </div>
            </div>
        `;

        card.querySelector("button").addEventListener("click", () => {
            removerProduto(indice);
        });

        lista.appendChild(card);
    });

    totalElemento.textContent =
        "Total: " + total.toLocaleString("pt-BR", {
            style: "currency",
            currency: "BRL"
        });
}

function removerProduto(indice) {
    const carrinho = JSON.parse(
        localStorage.getItem("carrinho")
    ) || [];

    carrinho.splice(indice, 1);

    localStorage.setItem("carrinho", JSON.stringify(carrinho));

    exibirCarrinho();
}

function limparCarrinho() {
    localStorage.removeItem("carrinho");
    exibirCarrinho();
}

exibirCarrinho();
