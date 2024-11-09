<?php
include "../includes/tables/clientes.php";
?>

<div class="container-fluid py-2">
  <div class="row">
    <div class="col-xl-12">
      <div class="card-2">
        <div class="card-header p-2 ps-3">
          <div
            class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between">
            <h5 class="text-white text-capitalize ps-3"> Novo Cliente</h5>
          </div>
          <div class="container-fluid py-2">
            <div class="row">
              <div>
                <form id="myForm" class="row g-3" method="post" action="includes/_scripts/repository/clientes/save.php">
                  <div class="col-md-6">
                    <label for="inputNome" class="form-label">Nome</label>
                    <div class="input-group input-group-outline">
                      <input type="text" class="form-control" name="nome" id="inputNome" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="inputSobrenome" class="form-label">Sobrenome</label>
                    <div class="input-group input-group-outline">
                      <input type="text" class="form-control" name="sobrenome" id="inputSobrenome" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="inputSobrenome" class="form-label">Nascionalidade</label>
                    <div class="input-group input-group-outline">
                      <input type="text" class="form-control" name="nascionalidade" id="inputNascionalidade" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="inputSobrenome" class="form-label">Profissão</label>
                    <div class="input-group input-group-outline">
                      <input type="text" class="form-control" name="proficao" id="inputProfissao" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="inputCPF" class="form-label">CPF</label>
                    <div class="input-group input-group-outline">
                      <input type="text" class="form-control" name="cpf" id="inputCPF" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="inputData" class="form-label">Data de Nascimento</label>
                    <div class="input-group input-group-outline">
                      <input type="date" class="form-control" name="dataNascimento" id="inputData" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="civilSelect" class="form-label">Estado Civil</label>
                    <div class="input-group input-group-outline">
                      <select id="civilSelect" class="form-select" name="estadoCivil" onchange="toggleOABField()">
                        <option value="" disabled selected>Selecione seu Estado Civil</option>
                        <option value="Solteiro">Solteiro</option>
                        <option value="Casado">Casado</option>
                        <option value="Viuvo">Viuvo</option>
                        <option value="Divorciado">Divorciado</option>
                        <option value="Outro">Outro</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="inputSobrenome" class="form-label">Endereço</label>
                    <div class="input-group input-group-outline">
                      <input type="text" class="form-control" name="endereco" id="inputSobrenome" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="inputEmail" class="form-label">Email</label>
                    <div class="input-group input-group-outline">
                      <input type="email" class="form-control" name="emailaaaa" id="inputEmail" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="inputTelefone" class="form-label">Telefone</label>
                    <div class="input-group input-group-outline">
                      <input type="text" class="form-control" name="telefone" id="inputTelefone" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="inputTelefone" class="form-label">Telefone Fixo</label>
                    <div class="input-group input-group-outline">
                      <input type="text" class="form-control" name="telefoneFixo" id="inputTelefone">
                    </div>
                  </div>
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.getElementById('myForm').onsubmit = async function (event) {
    event.preventDefault();
    const formData = new FormData(this);

    try {
      const response = await fetch(this.action, {
        method: 'POST',
        body: formData
      });

      const result = await response.json();

      Swal.fire({
        icon: result.status === 'success' ? 'success' : 'error',
        title: result.status === 'success' ? 'Sucesso!' : 'Erro!',
        text: result.message
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = './dashboard.php?r=clientes';
        }
      });
    } catch (error) {
      console.error('Erro ao processar o formulário:', error);
    }
  }
</script>

<link rel="stylesheet" href="assets/css/custom-styles-civil.css">