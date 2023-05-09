<?php

    // Definição das credenciais de conexão com o banco de dados
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "yourfinances";

    try {
        // Criação de uma nova conexão PDO com o banco de dados utilizando as credenciais definidas acima
        $conn = new PDO("mysql:host=$host;dbname=$database", $user, $pass);
        // Define o modo de erro como lançamento de exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Imprime mensagem de sucesso se a conexão for bem sucedida (linha comentada)
        // echo "Conexão bem sucedida";
    } catch(PDOException $e) {
        // Em caso de erro, imprime a mensagem de erro na conexão
        echo "Erro na conexão: " . $e->getMessage();
    }
