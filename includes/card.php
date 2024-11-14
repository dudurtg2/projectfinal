<?php
include("_scripts/repository/processos/findBySeach.php");
?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
  data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <ul class="navbar-nav d-flex align-items-center justify-content-end">
        <!-- Sidenav Toggler -->
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid py-2">
  <div class="row">
    <div class="d-flex align-items-center justify-content-between ms-3">

      <div id="title">
        <h3 class="mb-0 h4 font-weight-bolder">Advocatos</h3>
        <p class="mb-0">
          Seu sistema de gestão de processos
        </p>
      </div>


      <div class="d-flex align-items-center ms-auto">

        <div class="me-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </div>


        

      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 card-background">
      <div class="card-2">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 ">Processos para hoje</p>
              <h4 class="mb-0"><?php echo $aberto; ?> Processos</h4>
            </div>
            <div class="icon icon-md icon-shape shadow-dark shadow text-center border-radius-lg icon-card">
              <i class="material-symbols-rounded opacity-10">weekend</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">♛ </span> Dia
            <?php echo date('d/m/Y'); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 card-background">
      <div class="card-2">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 ">Total de processos</p>
              <h4 class="mb-0"><?php echo $total; ?> Processos</h4>
            </div>
            <div class="icon icon-md icon-shape icon-card shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">person</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">♜ </span>Desde 2022</p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 card-background">
      <div class="card-2">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Ganhos</p>
              <h4 class="mb-0"><?php echo $vencido; ?>  Processos</h4>
            </div>
            <div class="icon icon-md icon-shape icon-card shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">weekend</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">♕ </span>Últimos de ontem</p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6">
      <div class="card-2">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 ">Processos perdidos</p>
              <h4 class="mb-0"><?php echo $perdido; ?> Processos</h4>
            </div>
            <div class="icon icon-md icon-shape icon-card shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">leaderboard</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">♟ </span>Últimos de 2023</p>
        </div>
      </div>
    </div>

  </div>

</div>

