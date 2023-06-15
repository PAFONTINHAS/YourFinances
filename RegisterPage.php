<?php
include('PHP/conexao/banco.php');
include ('PHP/classes/Usuario.php');

$database = new Conexao();
$db = $database->getConnection();

$usuario = new Usuario($db);


    if (isset($_POST['Registrar'])){
    $nome= $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirSenha = $_POST['confirSenha'];

    // verifica se algum dos campos está vazio
    if($senha != $confirSenha){
        echo "<script>alert('As Senhas não coincidem.');</script>";

    }
    elseif( strlen($senha) < 8){

        echo "<script>alert('A senha deve ter pelo menos 8 caracteres');</script>";

    }

    elseif (empty($nome) || empty($email) || empty($senha) || empty($confirSenha)) {
        // exibe um alerta e redireciona para a página de cadastro
        echo "<script>alert('Certifique-se de que todas as informações foram inseridas corretamente');</script>";
        exit;

    }
    else{

        if ($usuario->cadastrar($nome, $email, $senha, $confirSenha)){

            echo "<script>alert('Usuario Cadastrado Com Sucesso');</script>";
        }
        else{
            echo "Erro ao cadastrar";
        }
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
    <link rel="stylesheet" href="CSS_LoginRegistro/LoginPage.css">
    <link rel="stylesheet" href="CSS_LoginRegistro/RegisterPage.css">


</head>
<body>

    <main class="conteiner">

    <!-- Elemento principal do site -->
        <h1>Your Finances</h1>

    <form method = "POST">

        <div class="RegisterConteiner">
            <div class="RegisterCard">
                <h3>Registrar-se</h3>

                <div class="Campos">
                    <input type="text" name = "nome" id="usuario" placeholder="Nome">
                </div>

                <div>
                    <input type="email" id="email" name = "email" placeholder="Email">
                </div>

                <div>
                    <input type="password" id="senha" name = "senha" placeholder="Senha">
                </div>

                <div>
                    <input type="password" id="repetirSenha" name = "confirSenha" placeholder="Confirmar senha">
                </div>

                <button type="submit" id = "Botao" name = "Registrar">Registrar-se</button>

            </div>

            <div class="Login">

                <h3>Você já possui uma conta? <a href="./index.php" id="Logar">Logar</a> </h3>

            </div>
        </div>
    </form>

    </main>


</body>
</html>
