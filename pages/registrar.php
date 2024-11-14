<div class="container-fluid py-2">
  <div class="row">
    <!-- Coluna para "Últimos processos" -->
    <div class="col-xl-6 col-sm-12 mb-xl-0 mb-4 card-background">
      <div class="card-2">
        <div class="card-header p-2 ps-3">
          <div
            class="card-4 shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
            <h5 class="text-white text-capitalize ps-3">Adicionar Cargos de sua empresa</h5>
          </div>
          <div class="container-fluid py-2">
            <div class="row">
              <div>
                <form id="formProfissoes" class="row g-3" method="post"
                  action="../includes/_scripts/repository/profissao/save.php">
                  <div class="col-md-12">
                    <label for="inputNomeProfissao" class="form-label">Nome</label>
                    <div class="input-group input-group-outline">
                      <input type="text" class="form-control" name="inputNomeProfissao" id="inputNomeProfissao" required>
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Adicionar novo cargo</button>
                  </div>
                </form>
                <?php include "../includes/tables/profissao.php"; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Coluna para "Finalizados processos" -->
    <div class="col-xl-6 col-sm-12 mb-xl-0 mb-4 card-background">
      <div class="card-2">
        <div class="card-header p-2 ps-3">
          <div
            class="card-4 shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
            <h5 class="text-white text-capitalize ps-3">Adicionar Clientes</h5>
          </div>
          <div class="container-fluid py-2">
            <div class="row">
              <div>
                <form id="formClientes" class="row g-3" method="post"
                  action="../includes/_scripts/repository/Logoff.php">
                  
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SweetAlert2 e scripts de carregamento -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  async function handleFormSubmit(event, formId, actionUrl, redirectUrl) {
    event.preventDefault();
    const form = document.getElementById(formId);
    const formData = new FormData(form);

    try {
      const response = await fetch(actionUrl, {
        method: 'POST',
        body: formData
      });

      const result = await response.json();

      Swal.fire({
        icon: result.status === 'success' ? 'success' : 'error',
        title: result.status === 'success' ? 'Sucesso!' : 'Erro!',
        text: result.message
      }).then((swalResult) => {
        if (swalResult.isConfirmed) {
          window.location.href = redirectUrl;
        }
      });
    } catch (error) {
      console.error('Erro ao processar o formulário:', error);
      Swal.fire({
        icon: 'error',
        title: 'Erro!',
        text: 'Ocorreu um erro ao processar o formulário.'
      });
    }
  }

  document.getElementById('formProfissoes').onsubmit = (event) => 
    handleFormSubmit(event, 'formProfissoes', '../includes/_scripts/repository/profissao/save.php', './dashboard.php?r=resgistrar');


</script>
