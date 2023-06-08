<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/png">

    <script src="loja.js" async></script>

    <title>Carrinho de Compras</title>

    <?php
session_start();

// Verifica se o carrinho de compras já existe na sessão
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

// Adiciona um produto ao carrinho
function adicionarProdutoAoCarrinho($produto) {
    $_SESSION['carrinho'][] = $produto;
}

// Remove um produto do carrinho
function removerProdutoDoCarrinho($indice) {
    unset($_SESSION['carrinho'][$indice]);
    $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
}

// Exibe o carrinho de compras
function exibirCarrinho() {
    if (count($_SESSION['carrinho']) > 0) {
        echo "<table>";
        echo "<tr><th>Produto</th><th>Preço</th><th>Ação</th></tr>";
        foreach ($_SESSION['carrinho'] as $indice => $produto) {
            echo "<tr>";
            echo "<td>".$produto['nome']."</td>";
            echo "<td>R$ ".$produto['preco']."</td>";
            echo "<td><a href='carrinho.php?remover=".$indice."'>Remover</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Seu carrinho está vazio.";
    }
}
?>
</head>
<body>
    <h1>Carrinho de Compras</h1>
    <h2>Produtos Disponíveis</h2>
    <ul>
        <li>Produto 1 - R$ 10.00 <a href="carrinho.php?adicionar=1">Adicionar</a></li>
        <li>Produto 2 - R$ 20.00 <a href="carrinho.php?adicionar=2">Adicionar</a></li>
        <li>Produto 3 - R$ 30.00 <a href="carrinho.php?adicionar=3">Adicionar</a></li>
    </ul>
    <h2>Seu Carrinho</h2>
    <?php
    if (isset($_GET['adicionar'])) {
        $produto = array(
            'nome' => 'Produto '.$_GET['adicionar'],
            'preco' => $_GET['adicionar'] * 10
        );
        adicionarProdutoAoCarrinho($produto);
    }
    
    if (isset($_GET['remover'])) {
        removerProdutoDoCarrinho($_GET['remover']);
    }
    
    exibirCarrinho();
    ?>
</body>

</html>