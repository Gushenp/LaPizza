
function adicionarCarrinho(id, nome, preco) {

    let carrinho = JSON.parse(
        localStorage.getItem("carrinho")
    ) || [];

    let produto = {
        id: id,
        nome: nome,
        preco: preco,
        quantidade: 1
    };

    let existente = carrinho.find(item => item.id === id);

    if (existente) {
        existente.quantidade++;
    } else {
        carrinho.push(produto);
    }

    localStorage.setItem(
        "carrinho",
        JSON.stringify(carrinho)
    );

    alert("Produto adicionado ao carrinho!");
}
