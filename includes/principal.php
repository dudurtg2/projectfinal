<h4?php include("../includes/_scripts/repository/processos/findAllTable.php"); ?>

  <div class="container-fluid py-2">
    <div class="row">
      <!-- Coluna para "Últimos processos" -->
      <div class="col-xl-6 col-sm-12 mb-xl-0 mb-4 card-background">
        <div class="card-2">
          <div class="card-2">
            <div class="container-fluid py-2">
              <div class="row">
                <div
                  class="card-4 shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                  <h4 class="text-white text-capitalize ps-3">Últimos Processos</h4>
                </div>
              </div>
            </div>
            <?php if (is_array($processos_view)):
              $ultimos_processos = array_slice($processos_view, -10);
              $ultimos_processos = array_reverse($ultimos_processos);
              ?>

              <?php foreach ($ultimos_processos as $processo): ?>
                <div class="container-fluid py-2">
                  <div class="row">
                    <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 card-background caixa">
                      <div class="card">
                        <div class="card-header p-2 ps-3">
                          <div class="d-flex justify-content-between">
                            <div>
                              <p class="text-sm mb-0 text-capitalize"> <?php echo htmlspecialchars($processo['codigo']); ?>
                                - <?php echo htmlspecialchars($processo['documentoProcessos']['status']) ?></p>
                              <h4 class="mb-0"><?php echo htmlspecialchars($processo['clientes']['nome']); ?></h4>
                            </div>
                            <div class="icon icon-md icon-shape icon-card shadow-dark shadow text-center border-radius-lg">
                              <i class="material-symbols-rounded opacity-10">person</i>
                            </div>
                          </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-2 ps-3">
                          <p class="mb-0 text-sm"><span
                              class="text-success font-weight-bolder"><?php echo htmlspecialchars($processo['data']); ?>
                            </span><?php echo htmlspecialchars($processo['funcionarios']['nome']); ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5">Nenhum funcionário encontrado.</td>
              </tr>
            <?php endif; ?>


          </div>
        </div>
      </div>

      <!-- Coluna para "Finalizados processos" -->
      <div class="col-xl-6 col-sm-12 mb-xl-0 mb-4 card-background">
        <div class="card-2">
          <div class="card-body">
            <div class="container-fluid py-2">
              <div class="row">
                <div
                  class="card-4 shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                  <h4 class="text-white ps-3">Processos Finalizados</h4>
                </div>
              </div>
            </div>

            <?php if (is_array($processos_view)): ?>
              <?php foreach ($processos_view as $processo):
                if ($processo['documentoProcessos']['status'] == 'Concluído') { ?>
                  <div class="container-fluid py-2">
                    <div class="row">
                      <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 card-background caixa" id="caixa">
                        <div class="card">
                          <div class="card-header p-2 ps-3">
                            <div class="d-flex justify-content-between">
                              <div>
                                <p class="text-sm mb-0 text-capitalize">
                                  <?php echo htmlspecialchars($processo['codigo']); ?> -
                                  <?php echo htmlspecialchars($processo['documentoProcessos']['status']) ?>
                                </p>
                                <h4 class="mb-0"><?php echo htmlspecialchars($processo['clientes']['nome']); ?></h4>
                              </div>
                              <div class="icon icon-md icon-shape icon-card shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">person</i>
                              </div>
                            </div>
                          </div>
                          <hr class="dark horizontal my-0">
                          <div class="card-footer p-2 ps-3">
                            <p class="mb-0 text-sm">
                              <span class="text-success font-weight-bolder"><?php echo htmlspecialchars($processo['data']); ?>
                              </span><?php echo htmlspecialchars($processo['funcionarios']['nome']); ?>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php }endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5">Nenhum funcionário encontrado.</td>
              </tr>
            <?php endif; ?>



          </div>
        </div>
        <h6> ‎ </h6>
        <div class="card-2">
          <div class="card-body">
            <div class="container-fluid py-2">
              <div class="row">
                <div
                  class="card-4 shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
                  <h4 class="text-white ps-3">Processos Perdidos</h4>
                </div>
              </div>
            </div>

            <?php if (is_array($processos_view)): ?>
              <?php foreach ($processos_view as $processo):
                if ($processo['documentoProcessos']['status'] == 'Perdido') { ?>
                  <div class="container-fluid py-2">
                    <div class="row">
                      <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4 card-background caixa" id="caixa">
                        <div class="card">
                          <div class="card-header p-2 ps-3">
                            <div class="d-flex justify-content-between">
                              <div>
                                <p class="text-sm mb-0 text-capitalize">
                                  <?php echo htmlspecialchars($processo['codigo']); ?> -
                                  <?php echo htmlspecialchars($processo['documentoProcessos']['status']) ?>
                                </p>
                                <h4 class="mb-0"><?php echo htmlspecialchars($processo['clientes']['nome']); ?></h4>
                              </div>
                              <div class="icon icon-md icon-shape icon-card shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">person</i>
                              </div>
                            </div>
                          </div>
                          <hr class="dark horizontal my-0">
                          <div class="card-footer p-2 ps-3">
                            <p class="mb-0 text-sm">
                              <span class="text-success font-weight-bolder"><?php echo htmlspecialchars($processo['data']); ?>
                              </span><?php echo htmlspecialchars($processo['funcionarios']['nome']); ?>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php }endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5">Nenhum funcionário encontrado.</td>
              </tr>
            <?php endif; ?>



          </div>
        </div>
      </div>
    </div>
  </div>