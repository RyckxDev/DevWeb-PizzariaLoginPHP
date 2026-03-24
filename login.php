<?php

    //inícia a sessão
    session_start();

    //verifica se o cookie existe e recupera seu valor
    if(isset($_COOKIE['email_user'])){
        $user = $_COOKIE['email_user'];
    }else{
        $user = "";
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $email = trim($_POST['txtemail'] ?? '');
        $senha = trim($_POST['txtsenha'] ?? '');
       
        //verifica se existe e não é nula
        if(!empty($email) && !empty($senha)){

             //cria a variável de sessão
            $_SESSION['email'] = $email;

            //verifica se o lembre-me foi selecionado
            if(isset($_POST['txtlembre'])){
                setcookie('email_user', $email, time() + (60*60*24*30), '/');
            }

            //redireciona para a página dashboard.php
            header('Location:dashboard.php');
            exit;
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
    <title>Login</title>
</head>
<body class="pagina-login">
    <main>
        <h1>Login</h1>
        <form action="login.php" method="post" class="form-login">
            <label>E-mail</label>

            <!-- Exibe o e-mail do usuário se o cookie foi criado -->
            <input type="email" 
                name="txtemail" 
                value="<?php echo htmlspecialchars($user); ?>"
                required
            >

            <label>Senha</label>

            <input type="password" name="txtsenha" required>

            <div class="lembre">
                <input type="checkbox" name="txtlembre">
                <span>Lembre-me</span>
            </div>

            <input type="submit" value="Entrar">

        </form>
    </main>
</body>
</html>