<?php

require 'conexao/banco.php'; // inclui o arquivo que faz a conexão com o banco de dados

if(isset($_POST['Registrar'])){ // verifica se o botão de cadastro foi acionado

    $nome = $_POST['nome']; // recebe o valor do campo 'nome' do formulário enviado via POST
    $email = $_POST['email']; // recebe o valor do campo 'sobrenome' do formulário enviado via POST
    $senha = $_POST['senha']; // recebe o valor do campo 'email' do formulário enviado via POST
    $confirSenha = $_POST ['confirSenha']; // recebe o valor do campo 'senha' do formulário enviado via POST
    $criptSenha = password_hash($senha, PASSWORD_DEFAULT); // criptografa a senha com um hash seguro
    $criptConfirSenha =  password_hash($confirSenha, PASSWORD_DEFAULT);

    // Verificar se o e-mail já está registrado
        $sql = "SELECT COUNT(*) AS count FROM usuario WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // verifica se algum dos campos está vazio
    if(empty($nome) or empty($email) or empty($criptSenha) or empty($criptConfirSenha))
    {
        // exibe um alerta e redireciona para a página de cadastro
        print "<script>alert('certifique-se que todas as informacoes foram inseridas corretamente');</script>";
        print "<script>location.href='../RegisterPage.php';</script>";
    }

    elseif($result['count'] > 0){

        print "<script>alert('Desculpe, esse e-mail já está registrado. Por favor, use outro endereço de e-mail para se cadastrar.');</script>";
        print "<script>location.href='../RegisterPage.php';</script>";
        exit;
    }
    else // caso contrário, prossegue com o cadastro
    {

        // prepara a query de inserção
        $stmt = $conn->prepare("INSERT INTO usuario (nome, email, senha, confirSenha) VALUES (:nome, :email, :criptSenha, :criptConfirSenha)");

        // vincula os valores dos parâmetros na query
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':criptSenha', $criptSenha);
        $stmt->bindParam(':criptConfirSenha', $criptConfirSenha);


        // executa a query
        $stmt->execute();

        // exibe uma mensagem de sucesso
        echo "Usuário cadastrado com sucesso!";

        // redireciona para a página de login
        header("location:../index.php");
    }

    // encerra a conexão com o banco de dados
    $conn= null;
}

