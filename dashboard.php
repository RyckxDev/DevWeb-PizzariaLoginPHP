<?php

session_start();

if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}

$produtos = [
    [
        'id' => 1,
        'nome' => 'Pizza Margherita',
        'preco' => 39.90,
        'imagem' => 'https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?auto=format&fit=crop&w=600&q=80'
    ],
    [
        'id' => 2,
        'nome' => 'Pizza Calabresa',
        'preco' => 44.90,
        'imagem' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=600&q=80'
    ],
    [
        'id' => 3,
        'nome' => 'Pizza Quatro Queijos',
        'preco' => 47.50,
        'imagem' => 'https://images.unsplash.com/photo-1594007654729-407eedc4be65?auto=format&fit=crop&w=600&q=80'
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto_id'])) {
    $produtoId = (int) $_POST['produto_id'];

    $idsValidos = array_column($produtos, 'id');
    if (!in_array($produtoId, $idsValidos, true)) {
        header('Location:dashboard.php');
        exit;
    }

    if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    if (
        count($_SESSION['carrinho']) > 0
        && array_keys($_SESSION['carrinho']) === range(0, count($_SESSION['carrinho']) - 1)
    ) {
        $carrinhoNormalizado = [];

        foreach ($_SESSION['carrinho'] as $idAntigo) {
            $idAntigo = (int) $idAntigo;

            if (in_array($idAntigo, $idsValidos, true)) {
                if (!isset($carrinhoNormalizado[$idAntigo])) {
                    $carrinhoNormalizado[$idAntigo] = 0;
                }

                $carrinhoNormalizado[$idAntigo]++;
            }
        }

        $_SESSION['carrinho'] = $carrinhoNormalizado;
    }

    if (!isset($_SESSION['carrinho'][$produtoId])) {
        $_SESSION['carrinho'][$produtoId] = 0;
    }

    $_SESSION['carrinho'][$produtoId]++;

    header('Location:carrinho.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Produtos</title>
    <link rel="stylesheet" href="dashboard.css" media="all">
</head>
<body class="pagina-app">
    <div class="conteudo">
        <div class="topo">
            <h2>Olá, <?php echo htmlspecialchars($_SESSION['email']); ?></h2>
            <div>
                <a href="carrinho.php">Ver carrinho</a> |
                <a href="logout.php">Sair</a>
            </div>
        </div>

        <div class="produtos">
            <?php foreach ($produtos as $produto): ?>
                <div class="produto">
                    <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                    <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                    <p>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>

                    <form method="post" action="dashboard.php">
                        <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
                        <button type="submit" class="btn-cheio">Comprar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>



