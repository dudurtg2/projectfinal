<?php
include("includes/_scripts/repository/findprocessos.php");
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


        <div class="flex-grow-1 me-3 d-flex align-items-center">
          <span class="me-2">
            <i class="fas fa-search"></i>
          </span>
          <form action="dashboard.php?r=tarefas" method="POST">
            <div class="input-group input-group-outline w-100">
              <label class="form-label">Pesquise por clientes ou código...</label>
              <input type="text" class="form-control" name="busca" required>
            </div>
          </form>

        </div>

      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 card-background">
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Processos para hoje</p>
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
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Total de processos</p>
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
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Ganhos</p>
              <h4 class="mb-0"><?php echo $vencido; ?> processos</h4>
            </div>
            <div class="icon icon-md icon-shape icon-card shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">weekend</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">♕ </span>Ultimo ontem</p>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Não ganho</p>
              <h4 class="mb-0"><?php echo $perdido; ?> Processos</h4>
            </div>
            <div class="icon icon-md icon-shape icon-card shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">leaderboard</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
          <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">♟ </span>Ultimo em 2023</p>
        </div>
      </div>
    </div>

  </div>

</div>


<?php if ($processosEncontrados !== null): ?>
  <h3>Resultados encontrados:</h3>
  <?php if (!empty($processosEncontrados)): ?>
    <div class="list-group">
      <?php
      // Se for um único processo (por código), exibe as informações
      if (isset($processosEncontrados['codigo'])) {
        echo "<a href='dashboard.php?r=acompanhamento&codigo=" . urlencode($processosEncontrados['codigo']) . "' class='list-group-item list-group-item-action'>";
        echo "<div class='process-box'>";
        echo "<h5>Código: " . htmlspecialchars($processosEncontrados['codigo']) . "</h5>";
        echo "<h5>Data: " . htmlspecialchars($processosEncontrados['data']) . "</h5>";
        echo "<p><strong>Cliente:</strong> " . htmlspecialchars($processosEncontrados['clientes']['nome']) . "</p>";
        echo "<p><strong>Funcionario:</strong> " . htmlspecialchars($processosEncontrados['funcionarios']['nome']) . "</p>";
        echo "<p><strong>Status:</strong> " . htmlspecialchars($processosEncontrados['documentoProcessos']['status']) . "</p>";
        echo "<p><strong>Descrição:</strong> " . htmlspecialchars($processosEncontrados['documentoProcessos']['descrisao']) . "</p>";
        echo "</div>";
        echo "</a>";
      } else {
        foreach ($processosEncontrados as $processo) {
          echo "<a href='dashboard.php?r=acompanhamento&codigo=" . urlencode($processo['codigo']) . "' class='list-group-item list-group-item-action'>";
          echo "<div class='process-box'>";
          echo "<h5>Código: " . htmlspecialchars($processo['codigo']) . "</h5>";
          echo "<h5>Data: " . htmlspecialchars($processo['data']) . "</h5>";
          echo "<p><strong>Cliente:</strong> " . htmlspecialchars($processo['clientes']['nome']) . "</p>";
          echo "<p><strong>Funcionario:</strong> " . htmlspecialchars($processo['funcionarios']['nome']) . "</p>";
          echo "<p><strong>Status:</strong> " . htmlspecialchars($processo['documentoProcessos']['status']) . "</p>";
          echo "<p><strong>Descrição:</strong> " . htmlspecialchars($processo['documentoProcessos']['descrisao']) . "</p>";
          echo "</div>";
          echo "</a>";
        }
      }
      ?>
    </div>
  <?php else: ?>
    <p>Nenhum processo encontrado.</p>
  <?php endif; ?>
<?php endif; ?>