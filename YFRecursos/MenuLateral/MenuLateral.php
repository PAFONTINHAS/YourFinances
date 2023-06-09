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
     <link rel="stylesheet" href="MenuLateral.css">
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
          <i class='bx bx-menu' ></i>
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
