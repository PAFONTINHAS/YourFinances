<?php
// Inicia e valida a sessão do PHP
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}
// Encerra a sessão atual
session_destroy();

// Redireciona o usuário para a página inicial (index.php)
header("location:../index.php");

// Finaliza a execução do script
exit;
