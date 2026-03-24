<?php
session_start();
$logado = isset($_SESSION['email']);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="PizzaTech — Pizzas artesanais com ingredientes selecionados, entregues até você.">
  <title>PizzaTech — Pizzaria Artesanal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="index.css">
</head>

<body class="page-home">

  <header class="site-header" role="banner">
    <div class="container header-inner">

      <a href="index.php" class="logo" aria-label="PizzaTech — página inicial">
        <span class="logo-mark" aria-hidden="true">✦</span>
        PizzaTech
      </a>

      <nav class="main-nav" aria-label="Navegação principal">
        <ul role="list">
          <li><a href="#cardapio">Cardápio</a></li>
          <li><a href="#sobre">Sobre</a></li>
          <?php if ($logado): ?>
            <li><a href="dashboard.php" class="nav-cta">Meus pedidos</a></li>
            <li>
              <a href="logout.php" class="nav-ghost">
                Sair <span aria-hidden="true">→</span>
              </a>
            </li>
          <?php else: ?>
            <li>
              <a href="login.php" class="nav-cta">
                Entrar <span aria-hidden="true">→</span>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>

      <button class="menu-toggle" aria-label="Abrir menu" aria-expanded="false" aria-controls="main-nav">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>

  <main id="main-content">

    <section class="hero" aria-labelledby="hero-title">
      <div class="hero-bg" aria-hidden="true">
        <div class="hero-img-wrap">
          <img
            src="https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=1400&q=80"
            alt=""
            width="1400"
            height="900"
            loading="eager">
        </div>
        <div class="hero-overlay"></div>
      </div>

      <div class="container hero-content">
        <p class="eyebrow" aria-hidden="true">Desde 2018 · Praia Grande, SP</p>
        <h1 id="hero-title">
          Feita com<br>
          <em>alma italiana</em>
        </h1>
        <p class="hero-desc">
          Massas de fermentação lenta, molho San Marzano e ingredientes frescos —
          entregues quentes na sua porta.
        </p>

        <div class="hero-actions">
          <?php if ($logado): ?>
            <a href="dashboard.php" class="btn btn-primary">Ver cardápio</a>
          <?php else: ?>
            <a href="login.php" class="btn btn-primary">Pedir agora</a>
            <a href="#cardapio" class="btn btn-ghost">Ver cardápio</a>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <section class="section-cardapio" id="cardapio" aria-labelledby="cardapio-title">
      <div class="container">
        <header class="section-header">
          <span class="section-tag">Cardápio</span>
          <h2 id="cardapio-title">Escolha a sua favorita</h2>
          <p>Cada pizza é preparada na hora, no forno a lenha.</p>
        </header>

        <ul class="pizza-grid" role="list">
          <?php
          $destaques = [
            ['nome' => 'Margherita',     'preco' => '39,90', 'desc' => 'Molho San Marzano, mussarela de búfala, manjericão fresco',       'img' => 'https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?auto=format&fit=crop&w=600&q=80'],
            ['nome' => 'Calabresa',      'preco' => '44,90', 'desc' => 'Calabresa artesanal, cebola roxa, azeitona preta, orégano',       'img' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=600&q=80'],
            ['nome' => 'Quatro Queijos', 'preco' => '47,50', 'desc' => 'Mussarela, gorgonzola, parmesão e catupiry sobre molho branco',   'img' => 'https://images.unsplash.com/photo-1594007654729-407eedc4be65?auto=format&fit=crop&w=600&q=80'],
          ];
          foreach ($destaques as $pizza): ?>
            <li class="pizza-card">
              <figure class="pizza-img-wrap">
                <img
                  src="<?= htmlspecialchars($pizza['img']) ?>"
                  alt="<?= htmlspecialchars($pizza['nome']) ?>"
                  width="600"
                  height="400"
                  loading="lazy">
              </figure>
              <div class="pizza-info">
                <h3><?= htmlspecialchars($pizza['nome']) ?></h3>
                <p><?= htmlspecialchars($pizza['desc']) ?></p>
                <div class="pizza-footer">
                  <strong class="price">R$ <?= $pizza['preco'] ?></strong>
                  <?php if ($logado): ?>
                    <a href="dashboard.php" class="btn btn-sm">Pedir</a>
                  <?php else: ?>
                    <a href="login.php" class="btn btn-sm">Pedir</a>
                  <?php endif; ?>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>

    <section class="section-sobre" id="sobre" aria-labelledby="sobre-title">
      <div class="container sobre-inner">
        <div class="sobre-text">
          <span class="section-tag">Nossa história</span>
          <h2 id="sobre-title">Tradição que<br>você sente no sabor</h2>
          <p>
            A PizzaTech nasceu da obsessão por fazer a pizza certa —
            sem atalhos. Nossa massa fermenta por 48 horas,
            nosso forno chega a 450°C e cada ingrediente é escolhido a dedo.
          </p>
          <p>
            O que começou como um projeto de fim de semana hoje
            entrega centenas de pizzas por semana na região de Campinas.
          </p>
        </div>
        <div class="sobre-visual" aria-hidden="true">
          <div class="sobre-num">
            <strong>48h</strong>
            <span>fermentação da massa</span>
          </div>
          <div class="sobre-num">
            <strong>450°C</strong>
            <span>temperatura do forno</span>
          </div>
          <div class="sobre-num">
            <strong>100%</strong>
            <span>ingredientes frescos</span>
          </div>
        </div>
      </div>
    </section>

  </main>

  <footer class="site-footer" role="contentinfo">
    <div class="container footer-inner">
      <p class="logo">
        <span class="logo-mark" aria-hidden="true">✦</span>
        PizzaTech
      </p>
      <p class="footer-copy">
        &copy; <?= date('Y') ?> PizzaTech · Feito com PHP puro e muito queijo
      </p>
      <nav aria-label="Links do rodapé">
        <a href="index.php">Home</a>
        <a href="login.php">Entrar</a>
      </nav>
    </div>
  </footer>

  <script>
    const toggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.main-nav');
    toggle?.addEventListener('click', () => {
      const open = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!open));
      nav.classList.toggle('is-open');
    });

    const header = document.querySelector('.site-header');
    window.addEventListener('scroll', () => {
      header.classList.toggle('scrolled', window.scrollY > 40);
    }, {
      passive: true
    });
  </script>
</body>

</html>
