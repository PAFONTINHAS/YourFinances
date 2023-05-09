<?php

require 'PHP/conexao/banco.php';
require 'PHP/registro.php';

if (isset($_POST['Logar'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Busca no banco de dados pelo email informado
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


    // Verifica se o usuário foi encontrado e se a senha corresponde
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        // Login bem sucedido - redireciona para a página de perfil do usuário
        session_start();
        $_SESSION['id_usuario'] = $usuario['id'];
        header("Location: Home/HomePage.php");
        exit();
    } else if(empty($email) or empty($criptSenha))
    {
        print "<script>alert('certifique-se que todas as informacoes foram inseridas corretamente')</script>";
        print "<script>location.href='index.php';</script>";
    }else {
        // Login falhou - exibe uma mensagem de erro
        $mensagem_erro = "Email ou senha incorretos.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Finances</title>
    <link rel="shortcut icon" type="image/png" href="./Logo/YourFinancesLogo.jpg">
    <link rel="stylesheet" href="CSS/LoginRegistro/LoginPage.css">

</head>
<body>

    <main class="conteiner">

    <!-- Elemento principal do site -->

        <h1>Your Finances</h1>

    <form method = "POST">

        <div class="login-conteiner">

            <div class="Logincard">

                <h3>Login</h3>

                <div class="campos">


                    <input type="text" id="usuario" placeholder="Insira o Email" name = "email">

                </div>

                <div class="underline"></div>

                <div class="campos">

                    <input type="password" id="senha" placeholder="Insira a Senha" name = "senha">

                </div>

                <div class="underline"></div>

                <button type="submit" id = "Botao" name = "Logar">Logar</button>

            </div>

            <div class="Register">

                <h3>Não está registrado ainda? <a href="./RegisterPage.php" id="registrar">Registre-se</a> </h3>

            </div>

        </div>

    </form>

    </main>


</body>
</html>
