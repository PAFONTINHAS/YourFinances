<?php
session_start();

if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {

    header('Location: ../../index.php'); // Redireciona para a página de login
    exit();
}

$id_usuario = $_SESSION['id_usuario'];


include('../../PHP/classes/Despesa.php');
$database = new Conexao();
$db = $database->getConnection();
$despesa = new Despesa($db);


if (isset($_POST['Cadastrar'])){

  print "<script>alert('Senha Incorreta')</script>";

    $nomeDespesa = $_POST["nome"];
    $categoria = $_POST["categoria"];
    $valor = $_POST["valor"];
    $dataVencimento = $_POST["dataVencimento"];
    $formaPagamento = $_POST["formaPagamento"];
    $imovelAssociado = $_POST["imovelAssociado"];
    $parcela = $_POST["parcelas"];
    $infocomp = $_POST["infoComplementares"];

    if ($despesa->cadastrarDespesa($id_usuario,$nomeDespesa,$categoria,$valor,$dataVencimento,$formaPagamento,$imovelAssociado,$parcela,$infocomp) == TRUE){

        return true;

    }
    else{
        echo "Erro ao cadastrar";
    }
}


$umAnoAtras = date('Y-m-d', strtotime('-1 year'));
$cinquentaAnosAFrenteFrente = date('Y-m-d', strtotime('+50 years'));

?>




<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Your Finances</title>
    <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
    <link rel="stylesheet" href="CadastroDespesas.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="../mascaraMoeda.js"></script>
     <link rel="shortcut icon" type="image/png" href="../Logo/YourFinancesLogo.jpg">

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
          <li><a class="link_name" href="../HTML/HomePage.html">Início</a></li>
        </ul>
      </li>
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
          <li><a href="#">Gestão de Receitas</a></li>
          <li><a href="/HTML/CadastroReceitas.html">Cadastro de Receitas</a></li>
          <li><a href="#">Gestão de Despesas</a></li>
          <li><a href="/HTML/CadastroDespesas.html">Cadastro de Despesas</a></li>

        </ul>
      </li>
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
          <li><a href="#">Definir Novo Orçamento</a></li>
          <li><a href="#">Visualizar Orçamentos</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-pie-chart-alt-2' ></i>
          <span class="link_name">Analytics</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Analytics</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-line-chart' ></i>
          <span class="link_name">Chart</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Chart</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-plug' ></i>
            <span class="link_name">Extratos</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Plugins</a></li>
          <li><a href="#">Ver Extrato</a></li>
          <li><a href="#">Importar Extratos</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-compass' ></i>
          <span class="link_name">Explore</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Explore</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-history'></i>
          <span class="link_name">History</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">History</a></li>
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
    <div class="profile-details">
      <div class="profile-content">
        <!--<img src="image/profile.jpg" alt="profileImg">-->
      </div>
      <!-- <div class="name-job">
        <div class="profile_name">Prem Shahi</div>
        <div class="job">Web Desginer</div>
      </div>
      <i class='bx bx-log-out' ></i>
    </div> -->
  </li>
</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>

      <!-- FORMULARIO-->
      <div class="container">
        <h1 class ="tituloDespesa" id="titulo">Cadastro de Despesas </h1>
        <form method = "POST">
          <div class="form-group">
            <label id="nomelabel" for="name">Nome da despesa:</label>
            <input type="text" name="nome" id="name"  placeholder="Nome da Despesa" required>
          </div>
          <div class="form-group">
            <label id="despesalabel" for="valordesp">Valor da despesa:</label>
            <input type="text" class = "decimal-input" onInput = "mascaraMoeda(event)" id="valordesp" name="valor" placeholder="Valor" required>
          </div>
          <div class="form-group">
          <label for="dataVencimento">Data de vencimento:</label>
  <input type="date" id="dataVencimento" name="dataVencimento" min="<?php echo $doisAnosAtras; ?>" max="<?php echo $cemAnosFrente; ?>" required>

          </div>
          <div class="form-group">
            <label id="categorialabel" for="message">Categoria:</label>
            <select id="Categoria" name="categoria" required>
              <option disabled selected>Selecionar</option>
              <option value="Acessorios">Acessórios</option>
              <option value="Alimentacao">Alimentação</option>
              <option value="CuidadosPessoais">Cuidados Pessoais</option>
              <option value="Doacoes-Caridade">Doações/Caridade</option>
              <option value="Educacao">Educação</option>
              <option value="Eletronicos">Eletrônicos</option>
              <option value="Entretenimento">Entretenimento</option>
              <option value="Impostos">Impostos</option>
              <option value="Moradia">Moradia</option>
              <option value="Saude">Saúde</option>
              <option value="Seguros">Seguros</option>
              <option value="ServicoPublico">Servico Público</option>
              <option value="SuperMecado">Super Mercado</option>
              <option value="Viagens">Viagens</option>
              <option value="Vestuario">Vestuário</option>
            </select>
          </div>


        <div class="Orgoniza">
              <div class="form-group2">
                <h1>Organização</h1>
                <label id="paglabel" for="formapagamento">Forma pagamento:</label>
                <select name="formaPagamento" id="formapagamento" placeholder="Forma de Pagamento" required>
                  <option disabled selected>Selecionar</option>
                  <option value="Dinheiro">Dinheiro</option>
                  <option value="CartaoCredito">Cartão de Crédito</option>
                  <option value="CartaoDebito">Cartão de Débito</option>
                  <option value="Cheque">Cheque</option>
                  <option value="Transferencia">Transferência Bancária</option>
                  <option value="Boleto">Boleto Bancário</option>
                  <option value="PayPal">PayPal</option>
                  <option value="Pix">Pix</option>
                </select>
              </div>
              <div class="form-group2">
                <label id="parcelaslabel" for="parcelas">Parcelas:</label>
                <select id="parcelas" name="parcelas">
                  <option disabled selected>Selecionar</option>
                  <option value='1'>Valor único</option>
                  <?php

                  $parcela = 1;

                  for ($i=0; $i < 119; $i++) {

                    $parcela ++;

                    echo "<option value='$parcela'>$parcela vezes</option>";
                  }

                  ?>
                </select>
              </div>
              <div class="form-group2">
                <label id="associaçaolabel" for="associaçao">Imovel Associado:</label>
                <select id="associaçao" name="imovelAssociado">
                  <option disabled selected>Selecionar</option>
                  <option value="Casa">Casa</option>
                  <option value="Apartamento">Apartamento</option>
                  <option value="Terreno">Terreno</option>
                  <option value="SalaComercial">Sala Comercial</option>
                  <option value="Loja">Loja</option>
                  <option value="Galpao-Armazem">Galpão/Armazém</option>
                  <option value="Sitio-Fazenda">Sítio/Fazenda</option>
                  <option value="Chacara">Chácara</option>
                  <option value="PredioComercial">Prédio Comercial</option>
                </select>
              </div>
              <div class="form-group2">
                <h1 id="h1observaçoes" for="observaçoes" >Dados Complementares</h1>
                <textarea name="infoComplementares" id="observaçoes" cols="210" rows="12" placeholder="Observações" ></textarea>

              </div>
        </div>
        <!-- BOTOES-->
        <div class="botao">
            <button type="submit" name ="Cadastrar">Cadastrar</button>

        </form>

            <button type="submit">Gestao de Despesas</button>
        </div>
        <!-- FIM DOS BOTOES-->
    </div>
  </section>
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
