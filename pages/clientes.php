<?php
include "includes/tables/clientes.php";
?>

<div class="container-fluid py-2">
  <div class="row">
    <div class="col-xl-12">
      <div class="card-2">
        <div class="card-header p-2 ps-3">
          <div>
            <form id="myForm" class="row g-3" method="post" action="includes/_scripts/repository/funcionario.php">
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
                <label for="inputEmail" class="form-label">Email</label>
                <div class="input-group input-group-outline">
                  <input type="email" class="form-control" name="email" id="inputEmail" required>
                </div>
              </div>
              <div class="col-md-6">
                <label for="inputPassword" class="form-label">Senha</label>
                <div class="input-group input-group-outline">
                  <input type="password" class="form-control" name="password" id="inputPassword" required>
                </div>
              </div>
              <div class="col-md-6">
                <label for="inputCPF" class="form-label">CPF</label>
                <div class="input-group input-group-outline">
                  <input type="text" class="form-control" name="cpf" id="inputCPF" required>
                </div>
              </div>
              <div class="col-md-6">
                <label for="inputTelefone" class="form-label">Telefone</label>
                <div class="input-group input-group-outline">
                  <input type="text" class="form-control" name="phone" id="inputTelefone" required>
                </div>
              </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
