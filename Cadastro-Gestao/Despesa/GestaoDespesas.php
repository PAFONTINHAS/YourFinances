<?php

session_start();

if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {

    header('Location: ../../index.php'); // Redireciona para a página de login
    exit();
}

$id_usuario = $_SESSION['id_usuario'];


echo '<script>';
echo 'var id_usuario = ' . json_encode($id_usuario) .';';
echo '</script>';

// require __DIR__ . "/../../conexao/banco.php";
include ("../../PHP/classes/Despesa.php");


$despesa = new Despesa($db);


$dadosTabela = $despesa->verDespesa($id_usuario);


if ($dadosTabela->rowCount() > 0) {
$contagem = 0;

?>

<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Your Finances</title>
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" type="image/png" href="../YFRecursos/Logo/YourFinancesLogo.jpg">
     <link rel="stylesheet" href="GestaoDespesas.css">
    </head>

   <header>
    <h1>Conta:</h1>
    <h1>Your Finances</h1>
    <h1>Mês:</h1>
</header>
<body>
  <div class="sidebar close">
    <div class="logo-details">
        <i class='bx bx-wallet' ></i>
      <span class="logo_name">Menu</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="#">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Início</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../Home/HomePage.php">Início</a></li>
        </ul>
      </li>
      <div class="RD">
      <li>
              <div class="iocn-link">
                <a href="#">
                  <i class='bx bx-collection' ></i>
                  <span class="link_name">Receitas e Despesas</span>
                </a>
                <i class='bx bxs-chevron-down arrow' ></i>
              </div>
              <ul class="sub-menu">
                <li><a class="link_name" href="#">Receitas e Despesas</a></li>
                <li><a href="../Cadastro/GestaoReceitas.php">Gestão de Receitas</a></li>
                <li><a href="../DespesaReceita/CadastroReceitas.php">Cadastro de Receitas</a></li>
                <li><a href="../GestDespesas.php">Gestão de Despesas</a></li>
                <li><a href="../DespesaReceita/CadastroDespesas.php">Cadastro de Despesas</a></li>

              </ul>
            </li>

      </div>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="link_name">Orçamento Mensal</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Orçamento Mensal</a></li>
          <li><a href="../Orcamento/cadastrarOrcamento.php">Definir Novo Orçamento</a></li>
          <li><a href="../Orcamento/VerOrcamentos.php">Visualizar Orçamentos</a></li>
        </ul>
      </li>
      <li>


        <a href="#">
          <i class='bx bx-cog' ></i>
          <span class="link_name">Setting</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Setting</a></li>
        </ul>
      </li>
      <li>
      <div class="logout" onclick="location.href='../PHP/logout.php'">
        <a href="#">
          <i class='bx bx-log-out'></i>
          <span class="link_name">Sair</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Sair</a></li>
        </ul>
      </li>
      <li>
      </div>
  </li>
</ul>
  </div>
  <section class="home-section">



    <div class="home-content">
    <h1 class = "tituloDespesa">Gestao De Despesas</h1>
    <div class="conteiner">

      <table class='tabela-despesas'>
        <tr>
          <th>Nome da Despesa</th>
          <th>Categoria</th>
          <th>Valor</th>
          <th>Parcela</th>
          <th>Forma de Pagamento</th>
          <th>Imóvel Associado</th>
          <th>Data de Vencimento</th>
          <th>Pago</th>
          <th>Informações Complementares</th>
        </tr>
        <?php

    while ($row = $dadosTabela->fetch(PDO::FETCH_ASSOC)) {

        $pago = $row["pago"];
        $infocomp = $row["infocomp"];

        $contagem ++;


        $pagoClass = ($row["pago"] == 1) ? "Sim" : "Não";


        [$categoria, $pagamento, $parcela, $imovelAssoc, $valorDespFormatado, $vencimentoBR  ] = $despesa->organizacao($row["categoria"],$row["formapag"],  $row["parcela"], $row["imovelassoc"] , $row["valor"], $row['vencimento']);


        date_default_timezone_set('America/Sao_Paulo'); // Definindo o fuso horário como São Paulo

        $id = $row['id'];
        $dataAtual  = date("Y-m-d");




        $despesa->atualizarPagamento($id, $id_usuario, $dataAtual, $vencimentoBR);

        echo "<tr id='linha' onclick=\"abrirModal(this)\" class=\"$pagoClass\" data-id=\"" . $id. "\">
            <td>" . $row["nome"] . "</td>
            <td>" . $categoria . "</td>
            <td> R$ " . $valorDespFormatado . "</td>
            <td>" . $parcela . "</td>
            <td>" . $pagamento. "</td>
            <td>" . $imovelAssoc . "</td>
            <td>" . $vencimentoBR . "</td>
            <td class=\"pago-col\">" . $pagoClass . "</td>
            <td>" . $row["infocomp"] . "</td>
        </tr>";




    }

    echo "</tr>";
    echo"</table>";
    echo"<hr>";



    // if($contagem == 1){
    //     $Cadastrados = " Despesa Cadastrada";

    // }
    // else{
    //     $Cadastrados = " Despesas Cadastradas";
    // }

    // $dadosCalculados = $despesa->calcularValores($id_usuario);

    // // Atribua os valores calculados a variáveis individuais
    // $valorTotal = $dadosCalculados['valorTotal'];
    // $valorAPagarBR = $dadosCalculados['valorAPagar'];
    // $saldo = $dadosCalculados['saldo'];

    // echo "<h2>Valor de Todas as Despesas: R$ " . $valorTotal . "</h2>";
    // echo "<h2>Valor de Todas as Despesas Pendentes: R$ " . $valorAPagarBR   . "</h2>";
    // echo "<h2>Número de Registros: " . $contagem . $Cadastrados . "</h2>";
    // echo "<h2>Saldo da sua conta: R$ " . $saldo . "</h2>";


    // echo '<button class="botao-cadastro" onclick="location.href=\'../Cadastro/cadastroDespesa.php\'">Cadastrar nova despesa</button>';
    // echo '<button class="botao-cadastro" onclick="location.href=\'../../PaginaInicial.php\'">Página Inicial</button>';

?>


<!-- Modal para despesas pagas -->
<div id="modalDespesaPaga" class="modal" data-id="">
<div class="modal-conteudo">
    <span class="fechar" onclick="fecharModalDP()">&times;</span>
    <h2 id="modalTituloPaga"></h2>
    <p>Categoria: <span id="modalCategoriaPaga"></span></p>
    <p>Valor: R$ <span id="modalValorPaga"></span></p>
    <p>Parcela: <span id="modalParcelaPaga"></span></p>
    <p>Forma de Pagamento: <span id="modalFormaPagamentoPaga"></span></p>
    <p>Imóvel Associado: <span id="modalImovelAssociadoPaga"></span></p>
    <p>Data de Vencimento: <span id="modalDataVencimentoPaga"></span></p>
    <p>Pago: <span id="modalPagoPaga"></span></p>
    <p>Data de Pagamento: <span id="modalDataPagamentoPaga"></span></p>
    <p>Próxima Parcela Liberada Dia:<span id="modalNovaParcela"></span></p>
    <p>Informações Complementares: <span id="modalInformacoesComplementaresPaga"></span></p>
    <button class="botao-excluir" name="excluir" onclick="excluirDespesa()">Excluir</button>
</div>
</div>

<!-- Modal para despesas não pagas -->
<div id="modalDespesaNaoPaga" class="modal" data-id="">
<div class="modal-conteudo">
    <span class="fechar" onclick="fecharModalDNP()">&times;</span>
    <h2 id="modalTituloNaoPaga"></h2>
    <p>Categoria: <span id="modalCategoriaNaoPaga"></span></p>
    <p>Valor: R$ <span id="modalValorNaoPaga"></span></p>
    <p>Parcela: <span id="modalParcelaNaoPaga"></span></p>
    <p>Forma de Pagamento: <span id="modalFormaPagamentoNaoPaga"></span></p>
    <p>Imóvel Associado: <span id="modalImovelAssociadoNaoPaga"></span></p>
    <p>Data de Vencimento: <span id="modalDataVencimentoNaoPaga"></span></p>
    <p>Pago: <span id="modalPagoNaoPaga"></span></p>
    <p>Quer pagar ou já pagou? Insira a data aqui: <input id="modalDataPagamentoNaoPaga" class="calendario" type="text" name="dataPagamento" onclick="exibirCalendario()" autocomplete="off"></p>
    <p>Informações Complementares: <span id="modalInformacoesComplementaresNaoPaga"></span></p>
    <button class="botao-pagar" name="pagar" onclick="pagarDespesa()">Pagar</button>
    <button class="botao-excluir" name="excluir" onclick="excluirDespesa()">Excluir</button>
</div>
</div>

<?php
}
else {
echo "Nenhum registro encontrado.";
echo '<button class="botao-cadastro" onclick="location.href=\'../Cadastro/cadastroDespesa.php\'">Cadastrar nova despesa</button>';

}

?>


      </div>

    </div>

    <div class="valores">

<?php
    echo "</tr>";
    echo"</table>";
    echo"<hr>";



    if($contagem == 1){
        $Cadastrados = " Despesa Cadastrada";

    }
    else{
        $Cadastrados = " Despesas Cadastradas";
    }

    $dadosCalculados = $despesa->calcularValores($id_usuario);

    // Atribua os valores calculados a variáveis individuais
    $valorTotal = $dadosCalculados['valorTotal'];
    $valorAPagarBR = $dadosCalculados['valorAPagar'];
    $saldo = $dadosCalculados['saldo'];

    echo "<h2>Valor de Todas as Despesas: R$ " . $valorTotal . "</h2>";
    echo "<h2>Valor de Todas as Despesas Pendentes: R$ " . $valorAPagarBR   . "</h2>";
    echo "<h2>Número de Registros: " . $contagem . $Cadastrados . "</h2>";


    echo '<button class="botao-cadastro" onclick="location.href=\'../Cadastro/cadastroDespesa.php\'">Cadastrar nova despesa</button>';
    echo '<button class="botao-cadastro" onclick="location.href=\'../../PaginaInicial.php\'">Página Inicial</button>';
?>
    </div>

  </section>
    </div>

  <script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
  </script>
</body>
</html>
