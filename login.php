<?php
session_start();

if (isset($_SESSION['email'])) {
  header('Location: dashboard.php');
  exit;
}

$user = $_COOKIE['email_user'] ?? '';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['txtemail'] ?? '');
  $senha = trim($_POST['txtsenha'] ?? '');

  if (empty($email) || empty($senha)) {
    $erro = 'Preencha e-mail e senha para continuar.';
  } else {
    $_SESSION['email'] = $email;

    if (isset($_POST['txtlembre'])) {
      setcookie('email_user', $email, time() + (60 * 60 * 24 * 30), '/');
    }

    header('Location: dashboard.php');
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Entre na sua conta PizzaTech para fazer seu pedido.">
  <title>Entrar — PizzaTech</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="login.css">
</head>

<body class="page-login">

  <main id="main-content">
    <div class="login-layout">
      <div class="login-visual" aria-hidden="true">
        <img
          src="https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?auto=format&fit=crop&w=900&q=80"
          alt=""
          width="900"
          height="1200"
          loading="eager">
        <div class="login-visual-overlay">
          <blockquote>
            <p>"A pizza perfeita não é<br><em>comida — é memória."</em></p>
          </blockquote>
        </div>
      </div>

      <div class="login-panel">

        <nav class="breadcrumb" aria-label="Você está em">
          <ol role="list">
            <li><a href="index.php">Home</a></li>
            <span aria-hidden="true" class="breadcrumb-sep">›</span>
            <li aria-current="page">Entrar</li>
          </ol>
        </nav>

        <div class="login-form-wrap">
          <header class="login-header">
            <h1>Bem-vindo de volta</h1>
            <p>Entre para fazer seu pedido favorito.</p>
          </header>

          <?php if ($erro): ?>
            <div class="alert alert-error" role="alert" aria-live="polite">
              <span aria-hidden="true">!</span>
              <?= htmlspecialchars($erro) ?>
            </div>
          <?php endif; ?>

          <form
            action="login.php"
            method="POST"
            class="login-form"
            novalidate
            aria-label="Formulário de login">
            <div class="field-group">
              <label for="txtemail">E-mail</label>
              <input
                type="email"
                id="txtemail"
                name="txtemail"
                value="<?= htmlspecialchars($user) ?>"
                placeholder="seu@email.com"
                autocomplete="email"
                required
                aria-required="true">
            </div>

            <div class="field-group">
              <div class="field-label-row">
                <label for="txtsenha">Senha</label>
              </div>
              <div class="input-wrap">
                <input
                  type="password"
                  id="txtsenha"
                  name="txtsenha"
                  placeholder="••••••••"
                  autocomplete="current-password"
                  required
                  aria-required="true">
                <button
                  type="button"
                  class="toggle-pass"
                  aria-label="Mostrar senha"
                  aria-pressed="false"
                  data-target="txtsenha">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                    <circle cx="12" cy="12" r="3" />
                  </svg>
                </button>
              </div>
            </div>

            <div class="field-check">
              <input
                type="checkbox"
                id="txtlembre"
                name="txtlembre"
                <?= $user ? 'checked' : '' ?>>
              <label for="txtlembre">Lembrar meu e-mail neste dispositivo</label>
            </div>

            <button type="submit" class="btn btn-primary btn-full">
              Entrar <span aria-hidden="true">→</span>
            </button>
          </form>

          <p class="login-back">
            Não tem conta ainda?
            <a href="index.php">Voltar para a home</a>
          </p>
        </div>

      </div>
    </div>
  </main>

  <script>
    document.querySelectorAll('.toggle-pass').forEach(btn => {
      btn.addEventListener('click', () => {
        const input = document.getElementById(btn.dataset.target);
        const isPass = input.type === 'password';
        input.type = isPass ? 'text' : 'password';
        btn.setAttribute('aria-pressed', String(isPass));
        btn.setAttribute('aria-label', isPass ? 'Ocultar senha' : 'Mostrar senha');
      });
    });
  </script>
</body>

</html>
