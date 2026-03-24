<?php

session_start();

if (!isset($_SESSION['email'])) {
	header('Location:login.php');
	exit;
}

$produtos = [
	1 => [
		'id' => 1,
		'nome' => 'Pizza Margherita',
		'preco' => 39.90,
		'imagem' => 'https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?auto=format&fit=crop&w=600&q=80'
	],
	2 => [
		'id' => 2,
		'nome' => 'Pizza Calabresa',
		'preco' => 44.90,
		'imagem' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=600&q=80'
	],
	3 => [
		'id' => 3,
		'nome' => 'Pizza Quatro Queijos',
		'preco' => 47.50,
		'imagem' => 'https://images.unsplash.com/photo-1594007654729-407eedc4be65?auto=format&fit=crop&w=600&q=80'
	]
];

$itensCarrinho = [];
$total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['limpar_carrinho'])) {
	$_SESSION['carrinho'] = [];
	header('Location:carrinho.php');
	exit;
}

if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
	$idsValidos = array_keys($produtos);

	if (array_keys($_SESSION['carrinho']) === range(0, count($_SESSION['carrinho']) - 1)) {
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

	foreach ($_SESSION['carrinho'] as $produtoId => $quantidade) {
		$produtoId = (int) $produtoId;
		$quantidade = (int) $quantidade;

		if (isset($produtos[$produtoId]) && $quantidade > 0) {
			$item = $produtos[$produtoId];
			$item['quantidade'] = $quantidade;
			$item['subtotal'] = $item['preco'] * $quantidade;
			$itensCarrinho[] = $item;
			$total += $item['subtotal'];
		}
	}
}

?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="login.css">
	<link rel="stylesheet" href="response.css">
	<title>Carrinho</title>
</head>
<body class="pagina-app">
	<div class="conteudo">
		<div class="topo">
			<h2>Olá, <?php echo htmlspecialchars($_SESSION['email']); ?></h2>
			<div>
				<a href="dashboard.php">Produtos</a> |
				<a href="logout.php">Sair</a>
			</div>
		</div>

		<h3>Seu carrinho</h3>

		<?php if (count($itensCarrinho) === 0): ?>
			<p>Carrinho vazio</p>
		<?php else: ?>
			<?php foreach ($itensCarrinho as $item): ?>
				<div class="cartao">
					<strong><?php echo htmlspecialchars($item['nome']); ?></strong>
					<p>Preço: R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></p>
					<p>Quantidade: <?php echo $item['quantidade']; ?></p>
				</div>
			<?php endforeach; ?>

			<p class="total">Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
			<div class="acoes-carrinho">
				<a href="dashboard.php" class="botao-link">Adicionar mais itens</a>
				<form method="post" action="carrinho.php">
					<button type="submit" name="limpar_carrinho" value="1">Limpar carrinho</button>
				</form>
			</div>
		<?php endif; ?>
	</div>
</body>
</html>
