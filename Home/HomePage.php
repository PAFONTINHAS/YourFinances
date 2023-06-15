<?php
    session_start();
    if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
        header('Location: ../index.php'); // Redireciona para a página de login
        exit;
    }

    include ('../PHP/classes/Usuario.php');

    $usuario = new Usuario($db);

    $id_usuario = $_SESSION['id_usuario'];


    $usuario->obterDados($id_usuario, $nome, $email, $saldo);


    echo '<script>';
    echo 'var saldo = ' . json_encode($saldo) . ';';
    echo 'var id_usuario = ' . json_encode($id_usuario) .';';
    echo '</script>';

    if ($saldo != NULL) {
        $saldo = number_format($saldo, 2, ',', '.');
    } else {
        $saldo = NULL;
    }

?>

<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Your Finances</title>
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" type="image/png" href="../YFRecursos/Logo/YourFinancesLogo.jpg">
     <script src="pegarSaldo.js"></script>
     <link rel="stylesheet" href="HomePage.css">
   </head>

<body>


<!-- MODAL DO SALDO -->
<div id="modalSaldoInicial" class="modal" data-id="">
    <div class="modal-conteudo">
        <h2 id="modalTituloPaga">Saldo Inicial</h2>
        <P>Notamos que é a primeira vez que acessa esse site: Antes de prosseguir insira o saldo inicial da sua conta:
            <input type="text" id="pegarSaldo" class="decimal-input" onInput="mascaraMoeda(event)" name="SaldoInicial">
        </P>
        <p>Você também poderá optar por não inserir o valor. Se fizer, as informações e cálculos sobre as suas receitas, despesas e orçamentos poderão ficar imprecisas.</p>

        <p>Você não verá essa tela novamente.</p>
        <button class="botao-adicionar" name="enviar" onclick="adicionarSaldo()">Adicionar Saldo</button>
        <button class="botao-fechar" name="enviar" onclick="adicionarSaldo()">Fechar Sem Inserir o Valor</button>

    </div>
</div>

</body>
</html>
