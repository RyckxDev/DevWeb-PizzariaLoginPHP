<?php
//inícia a sessão
session_start();

// apaga as variáveis e encerra a sessão
session_unset();
session_destroy();

//redireciona para o login
header('Location:index.php');
exit;

